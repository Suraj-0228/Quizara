# ⚡ Quizara — Challenge Your Mind

> **A Next-Generation, Premium Web-Based Learning Management System & Assessment Platform**

Quizara is a feature-rich, high-performance web application designed for online learning, interactive quiz assessment, and academic performance tracking. Built with a modern **Glassmorphism UI**, custom **Palette 2 Design System** (*Midnight Charcoal & Sunset Orange*), and isolated portals for **Students** and **Administrators**.

---

## 🎨 Theme & Design System (Palette 2)

Quizara is styled with a custom, tailored color palette designed for high contrast and visual elegance:

| Token Name | Hex Code | Purpose |
| :--- | :--- | :--- |
| **Midnight Charcoal** | `#25343F` | Primary Brand Color, Navigation, Header Bars |
| **Sunset Orange** | `#FF9B51` | Accent Color, Active Badges, Highlight Underlines |
| **Ice Gray** | `#EAEFEF` | Background Fill, Card Tints, Secondary Surfaces |
| **Slate Silver** | `#BFC9D1` | Border Lines, Card Outlines, Muted Separators |

---

## 🚀 Key Features

### 🎓 Student Portal (`/student`)
- 📊 **Academic Dashboard**: 4 key metrics (Total Attempts, Pass Rate %, Average Accuracy %, XP Credits), academic proficiency bar (*Scholar Master*, *Advanced Learner*, *Active Scholar*, *Beginner*), and activity stream.
- ⚡ **Interactive Quiz Engine**: Supports Multiple Choice & True/False questions with timed countdowns, difficulty modes (Low, Medium, High), and instant score calculation.
- 🏆 **Official PDF Certificate Generation**: Automatic issuance of high-resolution PDF certificates (`includes/certificate_helper.php`) for passing scores (≥75%) featuring asymmetric charcoal/orange frames, official seal badge, and GreatVibes authorized signature.
- 📄 **Native Vector PDF Academic Transcript**: Instant server-side FPDF report generator (`student/export-report.php`) producing official academic records with student credentials, performance highlights, assessment history log, center seal badge, and SHA256 security verification hash.
- 💳 **High Mode Premium Unlock (₹149 INR)**: Lifetime access tier unlock via dummy payment checkout (`student/checkout.php`) with digital invoice receipts (`student/receipt.php`) and automated email confirmation.
- 👤 **Redesigned Academic Portfolio & Settings**: Cover header, identity card, bio showcase, honors showcase, account details, and password visibility toggles (`student/profile.php`, `student/settings.php`).
- 📜 **Attempt History & Review**: Detailed history log, step-by-step question review (`student/review.php`), and question breakdown.
- ❓ **Interactive FAQ Accordion**: Smooth JS accordion (`faq.php`) covering platform features, High Mode pricing, certificates, and settings.

### 🛡️ Admin Portal (`/admin`)
- 📈 **Revenue & Health Analytics**: Live overview of total students, active quizzes, question bank stats, and High Mode revenue analytics.
- 💰 **High Mode Purchases Manager**: Dedicated purchase management suite (`admin/purchases.php`) featuring transaction logs, revenue stats, digital receipt modal, manual grant access modal, and access revocation controls.
- 📚 **Quiz & Category Manager**: Full CRUD operations for quizzes and categories with custom font-awesome arrow dropdown controls.
- ❓ **Question Bank Manager**: Manage multiple-choice and true/false questions, option choices, and answer keys.
- 👥 **Student Credentials Manager**: Inspect student accounts, view individual attempt histories, manage access permissions, or block/delete credentials.
- ⚙️ **Global Site Configuration**: Configure site name, contact email, items per page, registration toggles, and site-wide maintenance mode (`admin/settings.php`).
- 📬 **Contact Messages Desk**: Manage contact form inquiries (`admin/messages.php`) with action-based status notifications.

### 🔔 System-Wide Notification & Security Engine
- 🌈 **Action Color-Coded Flash Messages**: Centralized notification helper (`flash()`) with auto-detected action colors:
  - 🟢 **Add / Create / Success / Grant**: Green (`bg-emerald-50 text-emerald-900 border-emerald-200`)
  - 🔵 **Edit / Update / Settings / Modify**: Blue (`bg-sky-50 text-sky-900 border-sky-200`)
  - 🔴 **Delete / Revoke / Danger / Error**: Red (`bg-rose-50 text-rose-900 border-rose-200`)
  - 🟡 **Warning**: Amber (`bg-amber-50 text-amber-900 border-amber-200`)
- ⏱️ **Auto-Disappear Timer (2 Seconds)**: Notifications automatically slide up (`translateY(-10px)`), fade out (`opacity: 0`), and cleanly remove from the DOM after 2000ms.
- 🔒 **Enterprise-Grade Security**: PDO Prepared Statements (SQLi protection), XSS HTML sanitization, `password_hash()` bcrypt encryption, time-limited (15m) password reset tokens, and role-based session guards (`requireAdmin()`, `requireLogin()`).

---

## 🛠️ Technology Stack

| Layer | Technology |
| :--- | :--- |
| **Backend Engine** | Native PHP 8.x (Logic-Separated Multi-Page Application) |
| **Database** | MySQL (PDO Database Abstraction Layer) |
| **Frontend UI** | HTML5, Vanilla CSS3, Tailwind CSS (Play CDN) |
| **Icons & Typography** | FontAwesome 6 Free, Google Fonts (Inter, Outfit, GreatVibes) |
| **Email Delivery** | PHPMailer (SMTP Integration for receipts, resets, welcomes) |
| **PDF Generation** | FPDF 1.84 (Native Vector PDF Reports & Certificates) |

---

## 📂 Project Architecture

```
Quizara/
├── admin/                        # Administrator Portal
│   ├── controllers/              # Admin Backend Process Controllers
│   │   ├── dash-process.php      # Admin Dashboard Metrics & Analytics
│   │   ├── purchases-process.php # High Mode Purchase Operations
│   │   ├── settings-process.php  # Global Configuration Handler
│   │   └── ...
│   ├── dashboard.php             # Admin Stats & Revenue Overview
│   ├── purchases.php             # High Mode Purchases Management System
│   ├── quizzes.php               # Quiz Management
│   ├── questions.php             # Question Bank Manager
│   ├── students.php              # Student Account Manager
│   ├── categories.php            # Category Manager
│   ├── settings.php             # System Settings
│   └── messages.php              # Contact Inquiries Desk
│
├── student/                      # Student Portal
│   ├── checkout.php              # High Mode ₹149 Payment Gateway
│   ├── dashboard.php             # Academic Dashboard & Metric Grid
│   ├── export-report.php         # FPDF Vector PDF Academic Transcript Generator
│   ├── history.php               # Quiz Attempt Log & Timeline
│   ├── profile.php               # Student Academic Portfolio & Bio
│   ├── quizzes.php               # Quiz Directory & Search Filters
│   ├── receipt.php               # Digital Invoice Receipt Page
│   ├── reports.php               # Academic Performance Overview
│   ├── results.php               # Quiz Score & Pass/Fail Screen
│   ├── review.php                # Detailed Question-by-Question Review
│   ├── settings.php              # Student Account Settings & Toggles
│   └── take-quiz.php             # Interactive Quiz Attempt Interface
│
├── controllers/                  # Student & Public Process Controllers
│   ├── dummy-payment-process.php # Payment Verification & Purchase Grant
│   ├── profile-process.php       # Profile Updates & Credentials Validation
│   ├── take-quiz-process.php     # Score Calculation & Certificate Trigger
│   └── ...
│
├── includes/                     # Core Helpers & Global Components
│   ├── admin-header.php          # Admin Portal Navigation Header
│   ├── admin-sidebar.php         # Admin Navigation Sidebar with User Info
│   ├── certificate_helper.php    # FPDF Certificate Generation Engine
│   ├── functions.php             # Central Utility Functions & Flash Message Engine
│   ├── mail_helper.php           # PHPMailer Helper Configuration
│   ├── student-sidebar.php       # Student Navigation Sidebar with User Info
│   └── fpdf/                     # FPDF Library & Font Definitions
│
├── config/                       # Application Configuration
│   └── database.php              # PDO Database Connection
│
├── assets/                       # Static Web Assets
│   ├── css/                      # Custom CSS Stylesheets
│   ├── images/                   # Achievement Badges, Logos & User Avatars
│   └── js/                       # Vanilla JS Components & Auto-Dismiss Script
│
└── quiz_system.sql               # MySQL Database Schema & Seed Data
```

---

## ⚙️ Installation & Local Setup

### 1. Prerequisites
- **Web Server**: XAMPP / WAMP / MAMP / LAMP with Apache & PHP 8.x.
- **Database**: MySQL 5.7+ or MariaDB 10.4+.
- **Browser**: Modern web browser (Chrome, Firefox, Edge, Safari).

### 2. Database Setup
1. Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Create a new database named `quiz_system`.
3. Import the `quiz_system.sql` file located in the root project directory.

### 3. Application Configuration
1. Clone or copy the project into your web server document root (`c:/xampp/htdocs/Quizara`).
2. Verify database credentials in [`config/database.php`](file:///c:/xampp/htdocs/Quizara/config/database.php):
   ```php
   $host = 'localhost';
   $db   = 'quiz_system';
   $user = 'root';
   $pass = '';
   ```
3. (Optional) Configure SMTP email settings inside [`includes/mail_helper.php`](file:///c:/xampp/htdocs/Quizara/includes/mail_helper.php) for password reset emails and purchase receipts.

### 4. Portal Access & Default Credentials
- **Public Website / Student Portal**: `http://localhost/Quizara/`
- **Admin Portal**: `http://localhost/Quizara/login.php`

#### Default Credentials:
| Portal | Username | Password | Role |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin` | `adminPassword` | Admin |
| **Student** | Registered via `/register.php` | Custom Password | Student |

---

## 📄 License & Attribution

Developed for **Quizara LMS Platform**. All rights reserved. Powered by PHP, MySQL, Tailwind CSS, and FPDF.
