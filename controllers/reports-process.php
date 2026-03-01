<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

$user_id = $_SESSION['user_id'];

// 1. Core Summary Stats
$stmt = $pdo->prepare("
    SELECT 
        COUNT(*) as total_attempts,
        SUM(CASE WHEN (score/total_questions * 100) >= q.passing_score THEN 1 ELSE 0 END) as passed_count,
        SUM(CASE WHEN (score/total_questions * 100) < q.passing_score THEN 1 ELSE 0 END) as failed_count,
        AVG((score/total_questions) * 100) as avg_score_pct
    FROM quiz_attempts qa
    JOIN quizzes q ON qa.quiz_id = q.id
    WHERE qa.user_id = ? AND qa.total_questions > 0
");
$stmt->execute([$user_id]);
$summary = $stmt->fetch();

$total_attempts = $summary['total_attempts'] ?? 0;
$passed_count = $summary['passed_count'] ?? 0;
$failed_count = $summary['failed_count'] ?? 0;
$avg_score = round((float)($summary['avg_score_pct'] ?? 0), 1);
$pass_rate = $total_attempts > 0 ? round(($passed_count / $total_attempts) * 100) : 0;

// 2. Category Performance breakdown
$stmt = $pdo->prepare("
    SELECT 
        c.name as category_name,
        COUNT(qa.id) as attempts,
        AVG((qa.score/qa.total_questions) * 100) as avg_pct
    FROM categories c
    JOIN quizzes q ON c.id = q.category_id
    JOIN quiz_attempts qa ON q.id = qa.quiz_id
    WHERE qa.user_id = ? AND qa.total_questions > 0
    GROUP BY c.id
    ORDER BY avg_pct DESC
");
$stmt->execute([$user_id]);
$category_stats = $stmt->fetchAll();

// 3. Score ranges (for a distribution chart idea)
$stmt = $pdo->prepare("
    SELECT 
        SUM(CASE WHEN (score/total_questions * 100) >= 90 THEN 1 ELSE 0 END) as excellent,
        SUM(CASE WHEN (score/total_questions * 100) >= 75 AND (score/total_questions * 100) < 90 THEN 1 ELSE 0 END) as good,
        SUM(CASE WHEN (score/total_questions * 100) >= 50 AND (score/total_questions * 100) < 75 THEN 1 ELSE 0 END) as average,
        SUM(CASE WHEN (score/total_questions * 100) < 50 THEN 1 ELSE 0 END) as poor
    FROM quiz_attempts
    WHERE user_id = ? AND total_questions > 0
");
$stmt->execute([$user_id]);
$distribution = $stmt->fetch();

// 4. Detailed History (for the table report)
$stmt = $pdo->prepare("
    SELECT qa.*, q.title, q.passing_score 
    FROM quiz_attempts qa 
    JOIN quizzes q ON qa.quiz_id = q.id 
    WHERE qa.user_id = ? 
    ORDER BY qa.completed_at DESC
    LIMIT 15
");
$stmt->execute([$user_id]);
$detailed_history = $stmt->fetchAll();

$pageTitle = 'My Progress Report';
include_once '../includes/header.php';
?>
