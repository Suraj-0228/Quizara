<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

if (isLoggedIn()) {
    if (isAdmin()) {
        redirect('admin/dashboard.php');
    } else {
        redirect('student/dashboard.php');
    }
}

$error = '';
if (isset($_GET['error']) && $_GET['error'] === 'session_expired') {
    $error = "Your session has expired or the database was reset. Please login again.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    $user = null; // Initialize
    // if (empty($email) || empty($password)) { $error = ... } REMOVED per user request

    if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/', $email)) {
        $error = "invalid email id";
    }

    if (empty($error)) {
        // Check for blocked status
        $stmt = $pdo->prepare("SELECT id, username, email, password, role, is_blocked FROM users WHERE email = ? OR username = ?");
        $stmt->execute([$email, $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {

            // Check if blocked
            if (isset($user['is_blocked']) && $user['is_blocked'] == 1) {
                $error = "Your account has been suspended by the administrator.";
            } else {
                // Login success
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['login_welcome'] = true;

                // Send Login Alert Email
                require_once __DIR__ . '/../includes/mail_helper.php';
                $userEmail = $user['email'];
                $username = $user['username'];
                $subject = 'New Login Detected - Quizara';
                $time = date('Y-m-d H:i:s');
                $body = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;'>
                    <div style='background: #4A90E2; color: white; padding: 20px; text-align: center;'>
                        <h2>Security Alert</h2>
                    </div>
                    <div style='padding: 30px;'>
                        <p>Hello! <strong>$username</strong>,</p>
                        <p>We have detected a new Login to your Quizara Account on <strong>$time</strong>.</p>
                        <p>If this was you, you can safely ignore this email. If you did not log in, please secure your account immediately by changing your password.</p>
                        <div style='text-align: center; margin-top: 30px;'>
                            <a href='http://" . $_SERVER['HTTP_HOST'] . "/Quizara/login.php' style='background: #4A90E2; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px;'>Secure My Account</a>
                        </div>
                    </div>
                    <div style='background: #f9f9f9; color: #777; padding: 15px; text-align: center; font-size: 12px;'>
                        &copy; " . date('Y') . " Quizara. All rights reserved.
                    </div>
                </div>";
                sendEmail($userEmail, $username, $subject, $body);

                if ($user['role'] === 'admin') {
                    redirect('admin/dashboard.php');
                } else {
                    redirect('student/dashboard.php');
                }
            }
        } else {
            $error = "Invalid credentials";
        }
    }
}

$pageTitle = 'Login';
include_once 'includes/header.php';
