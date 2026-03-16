<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

if (!isset($_GET['quiz_id'])) {
    redirect('quizzes.php');
}

$quiz_id = (int)$_GET['quiz_id'];
$user_id = $_SESSION['user_id'];

// Fetch Quiz
$stmt = $pdo->prepare("SELECT title FROM quizzes WHERE id = ?");
$stmt->execute([$quiz_id]);
$quiz = $stmt->fetch();

if (!$quiz) {
    redirect('quizzes.php');
}

$pageTitle = 'Secure Checkout';
include_once '../includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <h2 class="fw-bold mb-4"><i class="fas fa-lock text-success me-2"></i> Secure Checkout</h2>

            <div class="card glass-card border-0 shadow-lg p-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-light border-opacity-10">
                        <div>
                            <h5 class="fw-bold mb-1">Premium Mode: <?php echo sanitize($quiz['title']); ?></h5>
                            <p class="text-muted small mb-0">One-time payment</p>
                        </div>
                        <h4 class="text-warning fw-bold mb-0">$4.99</h4>
                    </div>

                    <form action="../controllers/dummy-payment-process.php" method="POST">
                        <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
                        <input type="hidden" name="amount" value="4.99">

                        <div class="alert alert-info bg-info bg-opacity-10 border-info border-opacity-25 text-info mb-4">
                            <i class="fas fa-info-circle me-2"></i> <strong>Notice:</strong> This is a dummy checkout flow. No real credit card is required. Just click pay!
                        </div>

                        <div class="mb-4 opacity-75 pe-none">
                            <label class="form-label small fw-bold">Name on Card</label>
                            <input type="text" class="form-control bg-slate-50 border-slate-200" value="<?php echo sanitize($_SESSION['username']); ?>" readonly>
                        </div>

                        <div class="mb-4 opacity-75 pe-none">
                            <label class="form-label small fw-bold">Card Details</label>
                            <input type="text" class="form-control bg-slate-50 border-slate-200 font-monospace" value="**** **** **** 4242" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-lg d-flex justify-content-center align-items-center gap-2">
                            <i class="fas fa-credit-card"></i> Process Payment of $4.99
                        </button>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="upgrade-premium.php?quiz_id=<?php echo $quiz_id; ?>" class="text-muted text-decoration-none">Cancel & Return</a>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>