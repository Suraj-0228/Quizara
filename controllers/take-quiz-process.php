<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

if (!isset($_GET['id'])) {
    redirect('quizzes.php');
}

$quiz_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch Quiz with Category Name
$stmt = $pdo->prepare("
    SELECT q.*, c.name as category_name 
    FROM quizzes q 
    LEFT JOIN categories c ON q.category_id = c.id 
    WHERE q.id = ?
");
$stmt->execute([$quiz_id]);
$quiz = $stmt->fetch();

if (!$quiz) {
    redirect('quizzes.php');
}

// Fetch Mode & Validate Access
$mode = isset($_GET['mode']) ? strtolower($_GET['mode']) : 'low';
if (!in_array($mode, ['low', 'medium', 'high'])) $mode = 'low';

$astmt = $pdo->prepare("SELECT highest_mode_completed FROM quiz_attempts WHERE user_id = ? AND quiz_id = ? ORDER BY FIELD(highest_mode_completed, 'high', 'medium', 'low', 'none') LIMIT 1");
$astmt->execute([$user_id, $quiz_id]);
$res = $astmt->fetch();
$highest = $res ? $res['highest_mode_completed'] : 'none';

if ($mode == 'medium' && !in_array($highest, ['low', 'medium', 'high'])) {
    flash('message', 'You must complete Low mode first!', 'danger');
    redirect('quizzes.php');
}
if ($mode == 'high') {
    if (!in_array($highest, ['medium', 'high'])) {
        flash('message', 'You must complete Medium mode first!', 'danger');
        redirect('quizzes.php');
    }
    
    // Check purchase
    $pstmt = $pdo->prepare("SELECT id FROM user_quiz_purchases WHERE user_id = ? AND quiz_id = ?");
    $pstmt->execute([$user_id, $quiz_id]);
    if (!$pstmt->fetch()) {
        redirect("upgrade-premium.php?quiz_id=$quiz_id");
    }
}

// Fetch Questions
$stmt = $pdo->prepare("SELECT * FROM questions WHERE quiz_id = ? AND difficulty_level = ? ORDER BY RAND()"); // Randomize order
$stmt->execute([$quiz_id, $mode]);
$questions = $stmt->fetchAll();

if (count($questions) == 0) {
    flash('message', 'This quiz has no questions yet.', 'warning');
    redirect('quizzes.php');
}

// Handle Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answers = isset($_POST['answers']) ? $_POST['answers'] : [];
    $score = 0;
    $total_questions = count($questions);
    $correct_answers_count = 0;
    
    // Start Transaction
    try {
        $pdo->beginTransaction();
        
        // Create Attempt
        $stmt = $pdo->prepare("INSERT INTO quiz_attempts (user_id, quiz_id, total_questions, started_at, completed_at) VALUES (?, ?, ?, NOW(), NOW())");
        $stmt->execute([$user_id, $quiz_id, $total_questions]);
        $attempt_id = $pdo->lastInsertId();
        
        // Process Answers
        foreach ($questions as $q) {
            $qid = $q['id'];
            $selected_option_id = isset($answers[$qid]) ? $answers[$qid] : null;
            $is_correct = 0;
            
            if ($selected_option_id) {
                // Check correctness
                $chk = $pdo->prepare("SELECT is_correct FROM options WHERE id = ? AND question_id = ?");
                $chk->execute([$selected_option_id, $qid]);
                $opt = $chk->fetch();
                if ($opt && $opt['is_correct']) {
                    $is_correct = 1;
                    $score += 1;
                    $correct_answers_count++;
                }
            }
            
            // Save User Answer
            $ans_stmt = $pdo->prepare("INSERT INTO user_answers (attempt_id, question_id, selected_option_id, is_correct) VALUES (?, ?, ?, ?)");
            $ans_stmt->execute([$attempt_id, $qid, $selected_option_id, $is_correct]);
        }
        
        $percentage = ($total_questions > 0) ? round(($score / $total_questions) * 100, 2) : 0;
        
        $mode_completed_val = 'none';
        if ($percentage >= $quiz['passing_score']) {
            $mode_completed_val = $mode; // Passed this mode!
        }

        // Update Attempt with Score and Mode
        $update_stmt = $pdo->prepare("UPDATE quiz_attempts SET score = ?, correct_answers = ?, highest_mode_completed = ? WHERE id = ?");
        $update_stmt->execute([$score, $correct_answers_count, $mode_completed_val, $attempt_id]);
        
        // Fetch User Email
        $user_stmt = $pdo->prepare("SELECT email, username FROM users WHERE id = ?");
        $user_stmt->execute([$user_id]);
        $user = $user_stmt->fetch();
        
        if ($user && $percentage >= 75) {
            // Send Results Email
            require_once __DIR__ . '/../includes/mail_helper.php';
            $subject = "Success! Quiz Results: {$quiz['title']}";
            
            $cat_name = !empty($quiz['category_name']) ? htmlspecialchars($quiz['category_name']) : 'General';
            $mode_display = ucfirst($mode);
            
            $body = '
            <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; background-color: #f9f9f9; padding: 20px; border-radius: 8px;">
                <div style="background-color: #4a90e2; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
                    <h1 style="color: white; margin: 0; font-size: 24px;">Quiz Results Ready!</h1>
                </div>
                <div style="background-color: white; padding: 30px; border-radius: 0 0 8px 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <h2 style="color: #333; margin-top: 0;">Hello ' . $user['username'] . '!</h2>
                    <p style="color: #555; font-size: 16px; line-height: 1.5;">You have successfully completed the quiz: <br><strong style="color: #4a90e2; font-size: 18px;">' . $quiz['title'] . '</strong></p>
                    
                    <div style="background-color: #f0f7ff; border-left: 4px solid #4a90e2; padding: 15px; margin: 25px 0;">
                        <h3 style="margin: 0; color: #333; font-size: 16px;">Your Performance Details</h3>
                        <p style="margin: 10px 0 5px 0; font-size: 15px; color: #555;">
                            <strong>Category:</strong> ' . $cat_name . '<br>
                            <strong>Difficulty Mode:</strong> ' . $mode_display . ' Mode
                        </p>
                        <p style="margin: 10px 0 0 0; font-size: 24px; font-weight: bold; color: #4a90e2;">
                            ' . $score . ' <span style="font-size: 16px; color: #777; font-weight: normal;">/ ' . $total_questions . ' (' . $percentage . '%)</span>
                        </p>
                    </div>
                    
                    <p style="color: #777; font-size: 14px; text-align: center; margin-top: 30px;">Keep up the great work and take more quizzes to improve your skills!</p>
                </div>
            </div>';
            
            // --- GENERATE CERTIFICATE PDF ---
            require_once __DIR__ . '/../includes/certificate_helper.php';
            
            // Build pseudo-attempt array for the helper
            $certificate_data = [
                'username' => $user['username'],
                'quiz_title' => $quiz['title'],
                'completed_at' => date('Y-m-d H:i:s')
            ];
            
            // Save to temp file
            $tmpPdfPath = sys_get_temp_dir() . '/Certificate_' . time() . '.pdf';
            generateCertificatePDF($certificate_data, $percentage, 'F', $tmpPdfPath);
            
            // Send Email with Attachment
            sendEmail($user['email'], $user['username'], $subject, $body, '', $tmpPdfPath, 'Certificate_of_Completion.pdf');
            
            // Clean up temp file
            if (file_exists($tmpPdfPath)) {
                @unlink($tmpPdfPath);
            }
        }
        
        $pdo->commit();
        redirect("results.php?attempt_id=$attempt_id");
        
    } catch (Exception $e) {
        $pdo->rollBack();
        die("Error processing quiz: " . $e->getMessage());
    }
}

$pageTitle = 'Take Quiz';
include_once '../includes/header.php';
?>
