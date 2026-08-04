<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quiz_id = isset($_POST['quiz_id']) ? (int)$_POST['quiz_id'] : 0;
    $amount = isset($_POST['amount']) ? (float)$_POST['amount'] : 149.00;
    $user_id = $_SESSION['user_id'];
    $payment_method = isset($_POST['payment_method']) ? sanitize($_POST['payment_method']) : 'card';

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

    // Server-Side Validation based on selected payment method
    if ($payment_method === 'card') {
        $card_name = isset($_POST['card_name']) ? trim($_POST['card_name']) : '';
        $card_number = isset($_POST['card_number']) ? preg_replace('/\s+/', '', $_POST['card_number']) : '';
        $card_expiry = isset($_POST['card_expiry']) ? trim($_POST['card_expiry']) : '';
        $card_cvv = isset($_POST['card_cvv']) ? trim($_POST['card_cvv']) : '';

        if (empty($card_name) || strlen($card_name) < 3) {
            flash('message', 'Invalid cardholder name. Minimum 3 characters required.', 'danger');
            redirect("../student/checkout.php?quiz_id=$quiz_id");
        }
        if (!preg_match('/^\d{15,16}$/', $card_number)) {
            flash('message', 'Invalid card number. Please enter a 16-digit card number.', 'danger');
            redirect("../student/checkout.php?quiz_id=$quiz_id");
        }
        if (!preg_match('/^(0[1-9]|1[0-2])\/(\d{2})$/', $card_expiry)) {
            flash('message', 'Invalid expiry date format. Use MM/YY format.', 'danger');
            redirect("../student/checkout.php?quiz_id=$quiz_id");
        } else {
            $parts = explode('/', $card_expiry);
            $expMonth = (int)$parts[0];
            $expYear = (int)('20' . $parts[1]);
            $curMonth = (int)date('n');
            $curYear = (int)date('Y');
            if ($expYear < $curYear || ($expYear === $curYear && $expMonth < $curMonth)) {
                flash('message', 'Card has expired.', 'danger');
                redirect("../student/checkout.php?quiz_id=$quiz_id");
            }
        }
        if (!preg_match('/^\d{3,4}$/', $card_cvv)) {
            flash('message', 'Invalid CVV code. 3 or 4 digits required.', 'danger');
            redirect("../student/checkout.php?quiz_id=$quiz_id");
        }

        $transaction_id = 'tok_card_' . bin2hex(random_bytes(8));
    } else if ($payment_method === 'gpay') {
        $gpay_vpa = isset($_POST['gpay_vpa']) ? trim($_POST['gpay_vpa']) : '';
        if (!preg_match('/^([a-zA-Z0-9.\-_]{2,256}@[a-zA-Z]{2,64}|[6-9]\d{9})$/', $gpay_vpa)) {
            flash('message', 'Invalid GPay UPI ID or phone number format.', 'danger');
            redirect("../student/checkout.php?quiz_id=$quiz_id");
        }

        $transaction_id = 'tok_gpay_' . bin2hex(random_bytes(8));
    } else {
        flash('message', 'Invalid payment method selected.', 'danger');
        redirect("../student/checkout.php?quiz_id=$quiz_id");
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO user_quiz_purchases (user_id, quiz_id, transaction_id, amount) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $quiz_id, $transaction_id, $amount]);

        // Fetch User and Quiz details for Email Receipt
        $u_stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
        $u_stmt->execute([$user_id]);
        $user = $u_stmt->fetch();

        $q_stmt = $pdo->prepare("SELECT title FROM quizzes WHERE id = ?");
        $q_stmt->execute([$quiz_id]);
        $quiz = $q_stmt->fetch();

        $method_label = ($payment_method === 'gpay') ? 'Google Pay (GPay)' : 'Credit / Debit Card';

        if ($user && $quiz) {
            require_once '../includes/mail_helper.php';
            sendPurchaseReceipt($user['email'], $user['username'], $quiz['title'], $amount, $transaction_id, $method_label);
        }

        $receipt_link = "receipt.php?transaction_id=" . urlencode($transaction_id);
        flash('message', 'Payment successful! High Mode is now unlocked. A receipt has been sent to ' . sanitize($user['email']) . '. <a href="' . $receipt_link . '" class="underline font-bold ml-1 hover:text-emerald-900"><i class="fas fa-file-invoice mr-1"></i>View Receipt</a>', 'success');
        redirect("../student/take-quiz.php?id=$quiz_id&mode=high");
    } catch (Exception $e) {
        flash('message', 'An error occurred during payment processing: ' . $e->getMessage(), 'danger');
        redirect("../student/upgrade-premium.php?quiz_id=$quiz_id");
    }
} else {
    redirect('../student/quizzes.php');
}
