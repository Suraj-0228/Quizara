<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

if (!isset($_GET['quiz_id'])) {
    redirect('quizzes.php');
}

$quiz_id = (int)$_GET['quiz_id'];
$user_id = $_SESSION['user_id'];

// Check if already purchased
$pstmt = $pdo->prepare("SELECT id FROM user_quiz_purchases WHERE user_id = ? AND quiz_id = ?");
$pstmt->execute([$user_id, $quiz_id]);
if ($pstmt->fetch()) {
    flash('message', 'You already own the Premium High Mode for this quiz!', 'info');
    redirect("take-quiz.php?id=$quiz_id&mode=high");
}

// Fetch Quiz
$stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id = ?");
$stmt->execute([$quiz_id]);
$quiz = $stmt->fetch();

if (!$quiz) {
    redirect('quizzes.php');
}

$pageTitle = 'Unlock Premium Mode';
include_once '../includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6 text-center">

            <div class="mb-4">
                <i class="fas fa-crown fa-4x text-warning mb-3" style="filter: drop-shadow(0 0 15px rgba(255,193,7,0.5));"></i>
                <h1 class="display-5 fw-bold">Unlock Premium High Mode</h1>
                <p class="lead text-muted">Take your skills to the ultimate level with the hardest questions in <strong class="text-indigo-600"><?php echo sanitize($quiz['title']); ?></strong>.</p>
            </div>

            <div class="card glass-card border-warning border-opacity-50 border-2 shadow-lg mb-4 overflow-hidden position-relative">
                <div class="position-absolute top-0 end-0 bg-warning text-dark px-3 py-1 fw-bold rounded-start-pill shadow-sm mt-3" style="z-index: 10;">Most Popular</div>

                <div class="card-body p-5">
                    <h2 class="display-4 font-monospace text-warning mb-1">$4.99 <span class="fs-5 text-muted">/ one-time</span></h2>
                    <p class="text-light mb-4 text-opacity-75">Permanent access for this quiz.</p>

                    <ul class="list-unstyled text-start mb-5 mx-auto" style="max-width: 300px;">
                        <li class="mb-3 d-flex align-items-center">
                            <div class="me-3 rounded-circle bg-success bg-opacity-20 p-1 d-flex align-items-center justify-content-center text-success" style="width: 24px; height: 24px;"><i class="fas fa-check small"></i></div>
                            <span>Access to 'High' difficulty mode</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <div class="me-3 rounded-circle bg-success bg-opacity-20 p-1 d-flex align-items-center justify-content-center text-success" style="width: 24px; height: 24px;"><i class="fas fa-check small"></i></div>
                            <span>Exclusive Premium Certificate</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <div class="me-3 rounded-circle bg-success bg-opacity-20 p-1 d-flex align-items-center justify-content-center text-success" style="width: 24px; height: 24px;"><i class="fas fa-check small"></i></div>
                            <span>Support the creators</span>
                        </li>
                    </ul>

                    <a href="checkout.php?quiz_id=<?php echo $quiz_id; ?>" class="btn btn-warning btn-lg rounded-pill px-5 fw-bold shadow-lg w-100 py-3 text-dark hover-scale pulse-animation">
                        <i class="fas fa-lock-open me-2"></i> Get Premium Access
                    </a>
                </div>
            </div>

            <a href="quizzes.php" class="text-muted text-decoration-none hover-opacity-100 border-bottom border-secondary pb-1"><i class="fas fa-arrow-left me-2"></i> Maybe Later</a>
        </div>
    </div>
</div>

<style>
    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.4);
        }

        70% {
            box-shadow: 0 0 0 15px rgba(255, 193, 7, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 193, 7, 0);
        }
    }
</style>

<?php include_once '../includes/footer.php'; ?>