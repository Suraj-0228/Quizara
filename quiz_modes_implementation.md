# Quiz Difficulty Modes & Premium "High" Tier Implementation Plan

This document outlines the changes required to implement three tiered difficulty modes (Low, Medium, High) for a single quiz, where progression is sequential and the "High" mode is locked behind a premium paywall.

## 1. Database Schema Changes

### `questions` Table Update
We need to assign a difficulty level to each question.

```sql
ALTER TABLE questions 
ADD COLUMN difficulty_level ENUM('low', 'medium', 'high') NOT NULL DEFAULT 'low' AFTER question_text;
```

*(Optional)* You might also want to add `points` or `marks` relative to the difficulty level:
- Low = 1 pt each
- Medium = 3 pts each
- High = 5 pts each

### `quiz_attempts` Table Expansion
We need to track user progression per quiz.

```sql
ALTER TABLE quiz_attempts
ADD COLUMN highest_mode_completed ENUM('none', 'low', 'medium', 'high') NOT NULL DEFAULT 'none' AFTER score;
```

### `payments` or `subscriptions` Table (New)
To track which users have unlocked the premium "High" mode for a quiz.

```sql
CREATE TABLE user_quiz_purchases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    transaction_id VARCHAR(255) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    purchased_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

## 2. Server-Side Logic (PHP)

### `student/quizzes.php` (Listing Quizzes)
*   When a user clicks "Start Quiz," check `quiz_attempts` to find their `highest_mode_completed` for that specific quiz.
*   **Routing Logic:** If they haven't started -> redirect to `take-quiz.php?id=X&mode=low`.
*   If they finished 'low' -> direct to 'medium'.
*   If they finished 'medium' -> check `user_quiz_purchases` table.
    *   If purchased: grant access to 'high'.
    *   If not purchased: redirect to a `checkout.php` or `upgrade.php` page.

### `student/take-quiz.php` (Playing the Quiz)
*   The page must accept a `?mode=` parameter (e.g., `?mode=medium`).
*   **Security Validation:** 
    1. Before showing questions, strictly query the database: "Did user finish the *previous* mode?" If they try to access `?mode=medium` without finishing `low`, block them and redirect.
    2. If `?mode=high`, check if `isPurchased(User, Quiz)` is true.
*   Fetch questions based on BOTH `quiz_id` AND `difficulty_level`.

```php
// Example Query
// SELECT * FROM questions WHERE quiz_id = ? AND difficulty_level = ?
```

### `student/submit-quiz.php` (Handling Submissions)
*   When a user submits "Low" and scores above the `passing_score`:
    *   Update their attempt record: `UPDATE quiz_attempts SET highest_mode_completed = 'low' WHERE ...`
    *   Show a success screen granting them the "Key" or "Pass" to the Medium mode.

### `admin/add-question.php` & `admin/edit-question.php`
*   Add a dropdown `<select>` element to the form allowing the admin to set the difficulty (`Low`, `Medium`, `High`) when adding/editing questions.

---

## 3. UI/UX Journey

1. **Dashboard/Browse:** The user clicks on a quiz (e.g., "Python Basics").
2. **Quiz Overview Page:** Instead of just "Start Quiz," display a progressive timeline or map showing 3 steps (Low, Medium, High).
   *   Step 1 (Low): Unlocked.
   *   Step 2 (Medium): Padlock icon. "Complete Low to unlock."
   *   Step 3 (High): Golden Padlock or "Premium" badge.
3. **Completion Screen:** When finishing "Low," trigger confetti and a big button: "Unlock Medium Challenge!"
4. **Paywall Screen:** When they finish "Medium," display a sales page. "You've mastered the basics and intermediates! Are you ready for the Ultimate Challenge? Unlock the Premium High Mode for $X.XX and get an Elite Certificate."

---

## 4. Payment Integration

*   **Stripe or PayPal Checkout:** Create a `checkout.php` file processing the payment via the Stripe/PayPal APIs.
*   **Webhook Listener:** (Crucial for live apps). Set up `webhook.php` to listen for "Payment Successful" events from Stripe and insert the record into `user_quiz_purchases`.

---

## Summary of Files to Modify/Create

### Modify
1. `quiz_system.sql`
2. `student/take-quiz.php`
3. `controllers/student_quiz_process.php` (or wherever submission goes)
4. `admin/add-question.php`
5. `admin/questions.php`
6. `student/quizzes.php` (Overview page)

### Create
1. `checkout.php`
2. `upgrade-premium.php`
3. `webhook.php` (Payment gateway)
