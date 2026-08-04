<?php
/* Set timezone to local time (IST) */
date_default_timezone_set("Asia/Kolkata");

// Auto-detect environment (Local XAMPP vs Production Live Host)
$isLocal = in_array($_SERVER['HTTP_HOST'] ?? '', ['localhost', '127.0.0.1', '::1']) || strpos($_SERVER['HTTP_HOST'] ?? '', 'localhost:') === 0;

if ($isLocal) {
    // Local XAMPP Environment
    $host = 'localhost';
    $db   = 'quiz_system';
    $user = 'root';
    $pass = '';
} else {
    // Production Live Environment (InfinityFree)
    $host = 'sql108.infinityfree.com';
    $db   = 'if0_42575304_quiz_system';
    $user = 'if0_42575304';
    $pass = 'wXuTQPXKJ3';
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}