<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

if (!isset($_GET['id']) || !isset($_GET['quiz_id'])) {
    redirect('quizzes.php');
}

$question_id = $_GET['id'];
$quiz_id = $_GET['quiz_id'];

// Check if quiz exists
$stmt = $pdo->prepare("SELECT title FROM quizzes WHERE id = ?");
$stmt->execute([$quiz_id]);
$quiz = $stmt->fetch();

if (!$quiz) {
    redirect('quizzes.php');
}

// Fetch existing question
$stmt = $pdo->prepare("SELECT * FROM questions WHERE id = ? AND quiz_id = ?");
$stmt->execute([$question_id, $quiz_id]);
$question = $stmt->fetch();

if (!$question) {
    flash('message', 'Question not found.', 'danger');
    redirect("questions.php?quiz_id=$quiz_id");
}

// Fetch existing options
$stmt = $pdo->prepare("SELECT * FROM options WHERE question_id = ?");
$stmt->execute([$question_id]);
$existing_options = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question_text = sanitize($_POST['question_text']);
    $difficulty_level = isset($_POST['difficulty_level']) ? sanitize($_POST['difficulty_level']) : 'low';
    $marks = (int)$_POST['marks'];
    $correct_option_index = (int)$_POST['correct_option']; // 1-indexed
    $options_input = $_POST['options'];

    try {
        $pdo->beginTransaction();

        // Update Question
        $stmt = $pdo->prepare("UPDATE questions SET question_text = ?, difficulty_level = ?, marks = ? WHERE id = ?");
        $stmt->execute([$question_text, $difficulty_level, $marks, $question_id]);

        // Delete old options and insert new ones (simpler than updating matching IDs)
        $stmt = $pdo->prepare("DELETE FROM options WHERE question_id = ?");
        $stmt->execute([$question_id]);

        // Insert Options
        foreach ($options_input as $index => $option_text) {
            if (!empty(trim($option_text))) {
                $is_correct = ($index + 1) === $correct_option_index ? 1 : 0;
                $stmt = $pdo->prepare("INSERT INTO options (question_id, option_text, is_correct) VALUES (?, ?, ?)");
                $stmt->execute([$question_id, sanitize($option_text), $is_correct]);
            }
        }

        $pdo->commit();
        flash('message', 'Question updated successfully', 'success');
        redirect("questions.php?quiz_id=$quiz_id");
    } catch (Exception $e) {
        $pdo->rollBack();
        flash('message', 'Error: ' . $e->getMessage(), 'danger');
    }
}

$pageTitle = 'Edit Question';
include_once '../includes/header.php';
