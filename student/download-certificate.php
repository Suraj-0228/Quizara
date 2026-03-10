<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
require_once '../includes/fpdf/fpdf.php';

requireLogin();

if (!isset($_GET['attempt_id'])) {
    redirect('history.php');
}

$attempt_id = (int)$_GET['attempt_id'];

// Fetch attempt details, ensuring it belongs to the logged-in user
$stmt = $pdo->prepare("
    SELECT qa.*, q.title as quiz_title, u.username 
    FROM quiz_attempts qa
    JOIN quizzes q ON qa.quiz_id = q.id
    JOIN users u ON qa.user_id = u.id
    WHERE qa.id = ? AND qa.user_id = ? AND qa.completed_at IS NOT NULL
");
$stmt->execute([$attempt_id, $_SESSION['user_id']]);
$attempt = $stmt->fetch();

if (!$attempt) {
    // Attempt not found or doesn't belong to the user
    flash('message', 'Attempt not found or unauthorized access.', 'danger');
    redirect('history.php');
    exit;
}

// Calculate score percentage
$percentage = ($attempt['total_questions'] > 0) ? ($attempt['score'] / $attempt['total_questions']) * 100 : 0;

// Security check: Only allow downloads if they passed with 75% or more
if ($percentage < 75) {
    flash('message', 'Certificates are only available for scores of 75% or higher.', 'warning');
    redirect("results.php?attempt_id=" . $attempt_id);
    exit;
}

// Ensure no output has been sent before PDF generation
if (ob_get_length()) ob_clean();

require_once '../includes/certificate_helper.php';

$fileName = 'Certificate_' . preg_replace('/[^a-zA-Z0-9]+/', '_', $attempt['quiz_title']) . '.pdf';
generateCertificatePDF($attempt, $percentage, 'D', $fileName);
exit;
