# Physical Database Schema (Crow's Foot Notation) for QuizMaster

You have chosen the **Professional Database Schema** layout. This layout uses boxes for tables and specific symbols on the lines called "Crow's Foot" to show relationships.

---

## 🎨 Symbol Legend for Hand-Drawing

| Symbol | Representation | Meaning |
| :--- | :--- | :--- |
| **Rectangle Box** | Table | Draw a box with a header (Title) and a list of columns below. |
| **||---** | One and Only One | Used on the "Parent" side of the connection. |
| **>|---** | One to Many | The "Fork" or "Crow's Foot" used on the "Child" side. |
| **PK** | Primary Key | Write (PK) next to the unique ID of the table. |
| **FK** | Foreign Key | Write (FK) next to a column that links to another table. |

---

## 🏛 Table Structures (Draw these Boxes)

### 1. Category (The Parent)
*   **id (PK)**
*   name
*   description

### 2. Quiz (The Header)
*   **id (PK)**
*   title
*   time_limit
*   passing_score
*   **category_id (FK)**

### 3. Question
*   **id (PK)**
*   question_text
*   marks
*   **quiz_id (FK)**

### 4. Options
*   **id (PK)**
*   option_text
*   is_correct
*   **question_id (FK)**

### 5. User
*   **id (PK)**
*   username
*   role
*   password

### 6. Quiz_Attempt
*   **id (PK)**
*   score
*   correct_answers
*   completed_at
*   **user_id (FK)**
*   **quiz_id (FK)**

---

## 🔗 Relationship Connections (Crow's Foot)

1.  **Category ➔ Quiz**: 
    - Line starts at Category with `||` (One) and ends at Quiz with `>|` (Many).
2.  **Quiz ➔ Question**: 
    - Line starts at Quiz with `||` and ends at Question with `>|`.
3.  **Question ➔ Options**: 
    - Line starts at Question with `||` and ends at Options with `>|` (usually 4 options).
4.  **User ➔ Quiz_Attempt**: 
    - Line starts at User with `||` and ends at Quiz_Attempt with `>|`.
5.  **Quiz ➔ Quiz_Attempt**: 
    - Line starts at Quiz with `||` and ends at Quiz_Attempt with `>|`.

---

## 📍 Hand-Drawing Layout Guide

1.  **The Spine**: Draw **Category** ➔ **Quiz** ➔ **Question** ➔ **Options** in a vertical line down the left side.
2.  **The User Flow**: Draw **User** ➔ **Quiz_Attempt** on the right side.
3.  **The Link**: Draw a line from the **Quiz** box (left) to the **Quiz_Attempt** box (right).
4.  **Connect FKs**: When drawing a line, make sure it points directly to the **(FK)** column inside the child table for extra professional points!
