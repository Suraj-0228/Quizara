# Use Case Diagram Details for QuizMaster

A Use Case diagram shows the **High-Level Functions** of the system and which **Actor** (User/Admin) has the authority to perform them.

---

## 🎨 Symbol Legend for Hand-Drawing

| Symbol | Representation | Hand-Drawing Tip |
| :--- | :--- | :--- |
| **Stick Figure** | Actor | Represents a person (Student or Admin). |
| **Oval/Ellipse** | Use Case | Represents a specific feature (e.g., "Start Quiz"). |
| **Lines/Arrows** | Association | Connects the Actor to the Use Case. |
| **Large Box** | System Boundary | Draw a big rectangle around all ovals. Label it **"QuizMaster"**. |

---

## 👥 System Actors

1.  **Student**: The learner participating in assessments.
2.  **Administrator**: The controller managing users and content.

---

## 🛠 Use Case Breakdown

### 🎓 Student Use Cases
*   **Sign Up / Sign In**: Access the personalized dashboard.
*   **Search/Filter Quizzes**: Find specific categories (History, Science, etc.).
*   **Take Quiz**: Interact with the assessment engine and timer.
*   **View Performance Analytics**: See success rates and XP on the Reports page.
*   **Download Certificate**: Export the high-fidelity achievement PDF.
*   **Contact Support**: Send messages to the admin.

### 🔑 Administrator Use Cases
*   **Admin Authentication**: Secure login to the management panel.
*   **Manage Users**: Block/Unblock students or change roles.
*   **Manage Categories**: Create groups for quizzes.
*   **Manage Quiz Content**: 
    *   Create New Quizzes.
    *   Add/Edit Questions & Options.
    *   Set Passing Criteria.
*   **Monitor Analytics**: View all student scores and global statistics.
*   **Read Support Messages**: Access the admin inbox to respond to students.

---

## 📍 Hand-Drawing Layout Guide

### 📐 Positioning
1.  **Left Side**: Draw the **Student** stick figure.
2.  **Right Side**: Draw the **Administrator** stick figure.
3.  **The Center**: Draw a large rectangle (System Boundary).
4.  **Inside the Box**: Stack the **Ovals** (Use Cases) vertically.

### ➡️ Associations (Connections)
*   Draw lines from the **Student** to all Student Use Cases.
*   Draw lines from the **Admin** to all Admin Use Cases.
*   **Note**: Some cases like "Login" belong to **both** actors. You can draw lines from both people to that one oval.

---

## 📝 Tips for your Hand-Drawn Diagrams
1.  **Simplicity**: Don't put "How" a feature works inside an oval. Just put "What" the feature is.
2.  **Verb-First**: Use action words like **"Take"**, **"Manage"**, **"Download"**.
3.  **Boundary**: Make sure the Actors are **Outside** the box and the Ovals are **Inside**.
