<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quiz_id = isset($_POST['quiz_id']) ? (int)$_POST['quiz_id'] : 0;
    $amount = isset($_POST['amount']) ? (float)$_POST['amount'] : 4.99;
    $user_id = $_SESSION['user_id'];

    if ($quiz_id <= 0) {
        redirect('../student/quizzes.php');
    }

    // Check if already purchased
    $pstmt = $pdo->prepare("SELECT id FROM user_quiz_purchases WHERE user_id = ? AND quiz_id = ?");
    $pstmt->execute([$user_id, $quiz_id]);
    if ($pstmt->fetch()) {
        flash('message', 'You already own this premium mode!', 'info');
        redirect("../student/take-quiz.php?id=$quiz_id&mode=high");
    }

    // Fake a transaction ID
    $transaction_id = 'tok_fake_' . bin2hex(random_bytes(8));

    try {
        $stmt = $pdo->prepare("INSERT INTO user_quiz_purchases (user_id, quiz_id, transaction_id, amount) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $quiz_id, $transaction_id, $amount]);

        flash('message', 'Payment successful! High Mode is now unlocked. Good luck!', 'success');
        redirect("../student/take-quiz.php?id=$quiz_id&mode=high");
    } catch (Exception $e) {
        flash('message', 'An error occurred during payment processing: ' . $e->getMessage(), 'danger');
        redirect("../student/upgrade-premium.php?quiz_id=$quiz_id");
    }
} else {
    redirect('../student/quizzes.php');
}
