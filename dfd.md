# Data Flow Diagram (DFD) Details for QuizMaster

This document provides a structured breakdown of the Data Flow Diagrams for the QuizMaster system. These details are organized to assist you in **hand-drawing** the diagrams at all levels.

---

## 🎨 Symbol Legend for Hand-Drawing

| Symbol | Representation | Hand-Drawing Tip |
| :--- | :--- | :--- |
| **Rectangle** | External Entity (Source/Sink) | Draw a simple box. These represent people/systems outside "QuizMaster". |
| **Circle** | Process | Draw a circle. Represents an action or transformation of data. |
| **Open Rectangle**| Data Store | Draw two parallel horizontal lines. Represents a database table. |
| **Arrow** | Data Flow | Draw an arrow indicating the direction of information movement. |

---

## 📍 Level 0: Context Diagram
*Goal: Show the entire system as a single process and its interaction with external users.*

### 🛠 Components
1.  **Main Process:** [0] QuizMaster System (Central Circle)
2.  **External Entities:** 
    *   **Student** (Box on the left)
    *   **Administrator** (Box on the right)

### ➡️ Data Flows (The Arrows)
*   **Student ➔ System:** Registration Info, Login Credentials, Quiz Search/Filters, Quiz Answers.
*   **System ➔ Student:** Login Success/Failure, Quiz Questions, Instant Scores, PDF Certificates.
*   **Admin ➔ System:** Admin Credentials, Quiz Content (Categories/Questions/Options), System Settings.
*   **System ➔ Admin:** Performance Reports, Support Message Notifications.

---

## 📍 Level 1: System Decomposition (Vertical Layout)
*Goal: Break the central system into major functional blocks, matching your requested vertical layout.*

### 🛠 Layout Guide
| Left (Entities) | Middle (Processes) | Right (Data Stores) |
| :--- | :--- | :--- |
| **Admin** & **Client** | **[1.0] User Authentication** | **D1: Users Table** |
| **Admin** | **[2.0] Quiz Management** | **D2: Quizzes & Questions** |
| **Client** | **[3.0] Assessment Engine** | **D3: Attempts & Answers** |
| **Admin** & **Client** | **[4.0] Support & Reports** | **D4: Settings & Messages** |

---

### ➡️ Detailed Data Flows (Follow the Layout)

#### 1.0 Manage Users / Authentication
*   **Entities (Left) ➔ [1.0]:** Login/Reg. Request (Client & Admin)
*   **[1.0] ➔ Entities (Left):** Success/Fail Response
*   **[1.0] ➔ D1 (Right):** Create/Verify User Data
*   **D1 (Right) ➔ [1.0]:** User Profile Info

#### 2.0 Manage Quiz Content
*   **Admin (Left) ➔ [2.0]:** Create/Edit/Delete Quiz Request
*   **[2.0] ➔ Admin (Left):** Update Status (Success/Error)
*   **[2.0] ➔ D2 (Right):** Store Quiz Questions & Options
*   **D2 (Right) ➔ [2.0]:** Fetch Quiz List for Editing
 
#### 3.0 Manage Quiz Attempts (Assessment)
*   **Client (Left) ➔ [3.0]:** Answer Submission / Quiz Entry
*   **[3.0] ➔ Client (Left):** Instant Score / Questions Display
*   **D2 (Right) ➔ [3.0]:** Fetch Questions to display to Client
*   **[3.0] ➔ D3 (Right):** Store User Attempts & Scores

#### 4.0 Manage Support & Reports
*   **Client (Left) ➔ [4.0]:** Support Inquiry / Contact Request / **Report & Certificate Request**
*   **Admin (Left) ➔ [4.0]:** View Performance Reports / Performance Inquiry
*   **[4.0] ➔ Admin (Left):** Display Analytics & Support Messages
*   **[4.0] ➔ Client (Left):** **Download High-Fidelity PDF Report / Download Achievement Certificate**
*   **D3 (Right) ➔ [4.0]:** Fetch Score Data & Attempt History for Analytics
*   **[4.0] ➔ D4 (Right):** Store/Retrieve Contact Messages & Settings

---

## 📍 Level 2: Quiz Management Detail (Process 2.0)
*Goal: Breakdown the administrative process of creating and maintaining quizzes.*

### 🛠 Sub-Processes
1.  **[2.1] Quiz Metadata Handler:** Manages title, category, and time limit settings.
2.  **[2.2] Question Management:** Processes the individual question text and associations.
3.  **[2.3] Options & Answers CRUD:** Handles the 4 multiple-choice options and marks the correct answer.
4.  **[2.4] Validation Engine:** Ensures every quiz has enough questions and exactly one correct answer per question.

### ➡️ Internal Data Flows
*   **Creation:** Admin ➔ [2.1] "New Quiz" ➔ [2.1] writes Header info to **D2**.
*   **Question Entry:** Admin ➔ [2.2] sends Question Text ➔ [2.2] links to Quiz ID in **D2**.
*   **Answer Setup:** Admin ➔ [2.3] sends Option texts + "Correct Answer" flag ➔ [2.3] writes to Options table in **D2**.
*   **Audit:** [2.4] reads from **D2** to verify quiz completeness before making it "Live" for students.

---

## 📍 Level 2: Assessment Engine Detail (Process 3.0)
*Goal: Show exactly how a quiz is processed from start to finish.*

### 🛠 Sub-Processes (Small Circles)
1.  **[3.1] Quiz Initializer:** Fetches questions and starts the session timer.
2.  **[3.2] Answer Collector:** Captures student interactions (clicks/radio selections) from the UI.
3.  **[3.3] Grading Logic:** Compares user answers with the "is_correct" flag in the DB.
4.  **[3.4] Result Processor:** Calculates final percentage, determines pass/fail, and calculates XP.

### ➡️ Internal Data Flows
*   **Initialization:** Student ➔ [3.1] "Start Quiz" Command ➔ Fetches from **D2**.
*   **Interaction:** [3.2] receives a stream of "Choice IDs" from the Student.
*   **Validation:** [3.2] sends data to [3.3] ➔ [3.3] checks against **D2** (Options table).
*   **Finalization:** [3.3] sends "Correct Count" to [3.4] ➔ [3.4] writes final score/status to **D3**.

---

## 📍 Level 2: Support & Reports Detail (Process 4.0)
*Goal: Detailed flow of performance analytics and messaging.*

### 🛠 Sub-Processes
1.  **[4.1] Data Aggregator:** Fetches and groups raw score data from various attempts.
2.  **[4.2] Statistics Calculator:** Computes averages, pass/fail ratios, and XP totals.
3.  **[4.3] Report Generator:** Formats the statistics into the visual table and premium PDF layout.
4.  **[4.4] Message Router:** Handles the transmission of support inquiries between Student and Admin.

### ➡️ Internal Data Flows
*   **Analytics:** Student/Admin ➔ [4.1] Request Report ➔ [4.1] pulls data from **D3**.
*   **Computation:** [4.1] sends raw counts to [4.2] ➔ [4.2] sends calculated % values to [4.3].
*   **Visualization:** [4.3] displays the styled report to the User and generates PDF stream.
*   **Communication:** Student ➔ [4.4] "Contact Support" ➔ [4.4] writes to **D4** ➔ Admin fetches from **D4**.

---

## 🎨 Visual Layout Guide: Level 2.1 (Admin Quiz & Question Entry)
*Goal: Replicate the layout from your reference image but with specific "QuizMaster" detail.*

### 📍 Hand-Drawing Structural Layout
*   **Left Side (Entity):** Draw one large **Oval** labeled **Admin**.
*   **Middle (Processes):** Draw four **Ovals** stacked vertically (2.1, 2.2, 2.3, 2.4).
*   **Right Side (Data Store):** Draw one **Open Rectangle** (parallel lines) labeled **D2: Quiz & Question Data**.

### ➡️ Arrow Legend (The Flows)
1.  **Process 2.1 (Add Quiz Metadata):**
    *   Admin ➔ [2.1]: "Quiz Title, Category, Time Limit"
    *   [2.1] ➔ Admin: "Quiz ID Generated"
    *   [2.1] ➔ D2: "Store Header Record"
2.  **Process 2.2 (Question Entry):**
    *   Admin ➔ [2.2]: "Question Text, Quiz ID"
    *   [2.2] ➔ Admin: "Question ID Confirmation"
    *   [2.2] ➔ D2: "Add Question to Quiz"
3.  **Process 2.3 (Option & Answer Setup):**
    *   Admin ➔ [2.3]: "Choice A, B, C, D + Correct Flag"
    *   [2.3] ➔ Admin: "Options Saved Successfully"
    *   [2.3] ➔ D2: "Store Choices in Options Table"
4.  **Process 2.4 (Quiz Modification/Removal):**
    *   Admin ➔ [2.4]: "ID of Quiz to Edit/Delete"
    *   D2 ➔ [2.4]: "Fetch Record for Deletion/Edit"
    *   [2.4] ➔ Admin: "Action Success Message"
    *   [2.4] ➔ D2: "Update/Remove Record"

---

## 🎨 Visual Layout Guide: Level 3.1 (Student Assessment)
*Goal: A similar layout but for the Student interaction.*

### 📍 Hand-Drawing Structural Layout
*   **Left Side (Entity):** Draw one large **Oval** labeled **Student**.
*   **Middle (Processes):** Draw four **Ovals** stacked vertically (3.1, 3.2, 3.3, 3.4).
*   **Right Side (Data Store):** Draw two **Open Rectangles**: **D2: Questions** and **D3: Attempts**.

### ➡️ Arrow Legend (The Flows)
1.  **Process 3.1 (Start Quiz):**
    *   Student ➔ [3.1]: "Selection / Quiz ID"
    *   D2 ➔ [3.1]: "Fetch Questions"
    *   [3.1] ➔ Student: "Quiz Display"
2.  **Process 3.2 (Submit Answers):**
    *   Student ➔ [3.2]: "Option Selection"
    *   [3.2] ➔ Student: "Next Question"
3.  **Process 3.3 (Save & Show):**
    *   [3.2] ➔ [3.3]: "Final Score"
    *   [3.3] ➔ D3: "Store Attempt Record"
    *   [3.3] ➔ Student: "Instant Score / Performance"

---

## 🎨 Visual Layout Guide: Level 4.1 (Support & Reports)
*Goal: Detailed drawing guide for Analytics and Communication flows.*

### 📍 Hand-Drawing Structural Layout
*   **Left Side (Entities):** Draw two **Ovals** labeled **Admin** and **Student**.
*   **Middle (Processes):** Draw four **Ovals** stacked vertically (4.1, 4.2, 4.3, 4.4).
*   **Right Side (Data Stores):** Draw two **Open Rectangles**: **D3: Attempts** and **D4: Messages**.

### ➡️ Arrow Legend (The Flows)
1.  **Process 4.1 (Data Aggregator):**
    *   Student/Admin ➔ [4.1]: "View Report Request"
    *   D3 ➔ [4.1]: "Attempt History / Raw Scores"
2.  **Process 4.2 (Statistics Calculator):**
    *   [4.1] ➔ [4.2]: "Grouped Raw Data"
    *   [4.2] ➔ [4.3]: "Calculated % / Avg Score / Pass Ratio"
3.  **Process 4.3 (Report Generator):**
    *   [4.3] ➔ Student/Admin: "Styled Performance Table"
    *   [4.3] ➔ Student: "Generated PDF (Report/Certificate)"
4.  **Process 4.4 (Message Router):**
    *   Student ➔ [4.4]: "Support Inquiry"
    *   [4.4] ➔ D4: "Store Message"
    *   D4 ➔ [4.4]: "Fetch Message"
    *   [4.4] ➔ Admin: "Display Support Chat"

---

## 📝 Tips for your Hand-Drawn Diagrams
1.  **Level 0:** Keep it clean. Only one circle in the middle.
2.  **Level 1:** Try to place the **Data Stores** in the center and the **Processes** around them to keep arrows from crossing too much.
3.  **Level 2:** Use labels like `Selected_Option_ID` and `Question_ID` on your arrows to be highly specific.
4.  **Uniformity:** Make sure your entity names (Student/Admin) remain consistent across all levels.
