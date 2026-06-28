# Quizara – Challenge Your Mind

Quizara is a dynamic, web-based quiz application designed to facilitate online learning and assessment. It features a modern, glassmorphism-inspired premium user interface and distinct portals for Students and Administrators.

---

## 🚀 How It Works

The application follows a standard **PHP Multi-Page Application (MPA)** architecture:

1.  **Authentication**: Users register or login. The system assigns a role (`admin` or `student`) based on the database record.
2.  **State Management**: PHP `$_SESSION` is used to track logged-in users and enforce access control (e.g., preventing students from accessing `/admin` pages).
3.  **Data Layer**: A `database.php` config file establishes a connection to the MySQL database using **PDO**, ensuring secure data transactions.
4.  **Frontend**: The UI is built with HTML5, CSS3, and styled entirely with **Tailwind CSS (via Play CDN)** using a customized premium **Violet & Emerald Light Theme**. All Bootstrap 5 dependencies and inline styles have been removed.
5.  **Interactive Component Mocking**: Standard Bootstrap JavaScript components (like collapses, dropdowns, alerts, and modals) are handled via a custom, lightweight Vanilla JS mock script (`assets/js/script.js`), keeping the portal fast and dependency-free.

---

## 🛠️ Technology Stack

-   **Backend**: Native PHP (8.x recommended)
-   **Database**: MySQL
-   **Frontend**: HTML5, CSS3, JavaScript (Vanilla JS)
-   **Styling**: Tailwind CSS (Play CDN), FontAwesome (Icons), Custom Violet & Emerald Premium Light Theme
-   **Document Generation**: FPDF (PDF creation)
-   **Architecture**: Logic-Separated Page Model (includes/components pattern)

---

## ✨ Features

### 🎓 Student Portal
-   **Dashboard**: View statistics (Total Attempts, Average Score, XP) and recent activity.
-   **Take Quizzes**: Interactive interface for Multiple Choice and True/False questions with visual options selectors and timers.
-   **Quizzes Browsing**: Server-side pagination, category filtering, and keyword search.
-   **History Timeline**: Visual timeline of past attempts with scores, pass/fail status, and certificate downloads.
-   **Leaderboard**: View top-performing students.
-   **Profile**: Manage account details (Overview, Security, Bio, and custom profile picture uploads).
-   **Certificate Generation**: Downloadable PDF Certificates (via FPDF) and browser previews awarded for scores >= 75% featuring premium asymmetric gold and violet frames.

### 🛡️ Admin Portal
-   **Dashboard**: Overview of system health (Total Students, Active Quizzes, Question Bank).
-   **Quiz Management**: Create, edit, and delete quizzes.
-   **Student Management**: View registered students, view detailed user profiles, block/delete credentials, and view attempt histories.
-   **Reports**: Detailed analytics of student performance and average accuracy.
-   **Settings**: Configure site-wide options and toggle maintenance modes.

### 🔒 Security & System
-   **Authentication**: Secure login, registration, and role-based access control.
-   **Password Reset**: Secure forgot-password flow delivering time-limited (15m) database tokens via email.
-   **Email Integration**: PHPMailer integration for Registration Welcomes, Quiz Results, Password Resets, and Contact Form Admin Notifications.
-   **Form Validation**: Custom validation layer (`validation.js`) with instant parent border highlight indicators and clear error states.

---

## ⚙️ Setup & Installation

1.  **Prerequisites**:
    -   XAMPP/WAMP/MAMP (Apache + MySQL + PHP).
    -   Web Browser.

2.  **Installation**:
    -   Clone or extract the project to your web server root (e.g., `htdocs/Quizara`).
    -   Open `phpMyAdmin` and create a database named `quiz_system`.
    -   Import the `quiz_system.sql` file located in the project root.
    -   Configure database credentials inside `config/database.php` and SMTP email credentials inside `includes/mail_helper.php`.

3.  **Access**:
    -   Public/Student: `http://localhost/Quizara/`
    -   Admin: `http://localhost/Quizara/login.php`
    -   **Default Admin Credentials**:
        -   Username: `admin`
        -   Password: `adminPassword`

---

## 🌐 Deployment (Free Hosting)

To deploy Quizara online for free, we recommend using **InfinityFree**:

1.  **Export database**: Export your local `quiz_system` database using phpMyAdmin.
2.  **Create Host account**: Register at [InfinityFree](https://infinityfree.com/) and create a free subdomain web space.
3.  **Create MySQL DB**: Setup a database inside the InfinityFree client panel and import your SQL file.
4.  **Upload code**: Transfer all project files using **FileZilla** into the remote `/htdocs` folder.
5.  **Edit DB configuration**: Modify `config/database.php` with your online MySQL hostname, DB name, username, and password.
6.  **Setup SSL**: Generate a free SSL certificate from the client portal to serve the site securely via `https://` to protect login data.
