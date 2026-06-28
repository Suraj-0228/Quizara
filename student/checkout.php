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

<div class="max-w-md mx-auto py-12 px-4">
    <h2 class="text-2xl font-black text-slate-900 mb-6 flex items-center">
        <i class="fas fa-lock text-emerald-500 mr-2.5"></i> Secure Checkout
    </h2>

    <div class="bg-white border border-slate-200 rounded-[32px] p-8 shadow-premium">
        <div class="flex justify-between items-center pb-4 border-b border-slate-100 mb-6">
            <div>
                <h5 class="font-extrabold text-slate-800 text-sm mb-0.5"><?php echo sanitize($quiz['title']); ?></h5>
                <p class="text-slate-400 text-xs font-semibold">Premium Mode Unlock</p>
            </div>
            <h4 class="text-xl font-black text-amber-500">$4.99</h4>
        </div>

        <form action="../controllers/dummy-payment-process.php" method="POST" class="space-y-6">
            <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
            <input type="hidden" name="amount" value="4.99">

            <div class="p-4 rounded-2xl bg-sky-50 border border-sky-100 text-sky-700 text-xs font-medium leading-relaxed">
                <i class="fas fa-info-circle mr-1.5"></i> <strong>Notice:</strong> This is a dummy checkout flow. No real credit card is required. Just click pay!
            </div>

            <div class="opacity-60 pointer-events-none">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Name on Card</label>
                <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 font-medium focus:outline-none" value="<?php echo sanitize($_SESSION['username']); ?>" readonly>
            </div>

            <div class="opacity-60 pointer-events-none">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Card Details</label>
                <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 font-mono focus:outline-none" value="**** **** **** 4242" readonly>
            </div>

            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-xs flex items-center justify-center focus:outline-none">
                <i class="fas fa-credit-card mr-2"></i> Process Payment of $4.99
            </button>
        </form>
    </div>

    <div class="text-center mt-6">
        <a href="upgrade-premium.php?quiz_id=<?php echo $quiz_id; ?>" class="text-slate-400 hover:text-slate-600 text-xs font-bold transition-all">Cancel & Return</a>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>