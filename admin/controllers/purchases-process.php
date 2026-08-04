<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/functions.php';
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Manually Grant High Mode Access
    if (isset($_POST['grant_access'])) {
        $student_id = (int)$_POST['student_id'];
        $quiz_id = (int)$_POST['quiz_id'];
        $amount = isset($_POST['amount']) ? (float)$_POST['amount'] : 0.00;

        if ($student_id <= 0 || $quiz_id <= 0) {
            flash('message', 'Please select a valid student and quiz.', 'danger');
            redirect('../purchases.php');
        }

        // Check if already has purchase record
        $check = $pdo->prepare("SELECT id FROM user_quiz_purchases WHERE user_id = ? AND quiz_id = ?");
        $check->execute([$student_id, $quiz_id]);
        if ($check->fetch()) {
            flash('message', 'This student already has High Mode access for this quiz.', 'info');
            redirect('../purchases.php');
        }

        $transaction_id = 'tok_admin_granted_' . bin2hex(random_bytes(6));

        try {
            $stmt = $pdo->prepare("INSERT INTO user_quiz_purchases (user_id, quiz_id, transaction_id, amount) VALUES (?, ?, ?, ?)");
            $stmt->execute([$student_id, $quiz_id, $transaction_id, $amount]);

            flash('message', 'High Mode access granted successfully!', 'success');
        } catch (Exception $e) {
            flash('message', 'Error granting access: ' . $e->getMessage(), 'danger');
        }

        redirect('../purchases.php');
        exit;
    }

    // 2. Revoke / Delete Purchase Record
    if (isset($_POST['delete_purchase'])) {
        $purchase_id = (int)$_POST['purchase_id'];

        if ($purchase_id > 0) {
            try {
                $stmt = $pdo->prepare("DELETE FROM user_quiz_purchases WHERE id = ?");
                $stmt->execute([$purchase_id]);

                flash('message', 'Purchase record deleted and access revoked.', 'success');
            } catch (Exception $e) {
                flash('message', 'Error deleting purchase: ' . $e->getMessage(), 'danger');
            }
        }

        redirect('../purchases.php');
        exit;
    }
}

redirect('../purchases.php');
