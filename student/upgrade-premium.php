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

<div class="max-w-xl mx-auto py-12 px-4 text-center">
    <div class="mb-8">
        <i class="fas fa-crown text-6xl text-amber-500 mb-6 drop-shadow-md filter"></i>
        <h1 class="text-3xl font-black text-slate-900 leading-tight mb-3">Unlock Premium High Mode</h1>
        <p class="text-slate-550 text-xs md:text-sm leading-relaxed max-w-md mx-auto">Take your skills to the ultimate level with the hardest questions in <strong class="text-primary-600 font-bold"><?php echo sanitize($quiz['title']); ?></strong>.</p>
    </div>

    <div class="bg-white border-2 border-amber-400 rounded-[32px] p-8 md:p-12 shadow-premium relative overflow-hidden mb-8">
        <!-- Most Popular tag badge -->
        <div class="absolute top-0 right-0 bg-amber-400 text-slate-900 px-4 py-1.5 text-[10px] font-bold rounded-bl-2xl uppercase tracking-wider">Most Popular</div>

        <h2 class="text-4xl md:text-5xl font-black text-slate-900 mt-4">$4.99 <span class="text-xs text-slate-400 font-semibold block mt-1">/ one-time purchase</span></h2>
        <p class="text-slate-400 text-[10px] mt-2 mb-8">Permanent lifetime access to this quiz difficulty level.</p>

        <ul class="list-none text-left space-y-4 my-8 max-w-xs mx-auto">
            <li class="flex items-center text-slate-655 text-xs font-semibold">
                <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mr-3 flex-shrink-0 border border-emerald-100/50"><i class="fas fa-check text-[10px]"></i></div>
                <span>Access to 'High' difficulty mode</span>
            </li>
            <li class="flex items-center text-slate-655 text-xs font-semibold">
                <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mr-3 flex-shrink-0 border border-emerald-100/50"><i class="fas fa-check text-[10px]"></i></div>
                <span>Exclusive Premium Certificate</span>
            </li>
            <li class="flex items-center text-slate-655 text-xs font-semibold">
                <div class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mr-3 flex-shrink-0 border border-emerald-100/50"><i class="fas fa-check text-[10px]"></i></div>
                <span>Support the creators</span>
            </li>
        </ul>

        <a href="checkout.php?quiz_id=<?php echo $quiz_id; ?>" class="w-full bg-amber-400 hover:bg-amber-500 text-slate-900 font-bold py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-xs flex items-center justify-center focus:outline-none pulse-animation">
            <i class="fas fa-lock-open mr-2 text-[10px]"></i> Get Premium Access
        </a>
    </div>

    <a href="quizzes.php" class="text-slate-400 hover:text-slate-600 text-xs font-bold transition-all border-b border-transparent hover:border-slate-400 pb-0.5"><i class="fas fa-arrow-left mr-1.5"></i> Maybe Later</a>
</div>

<style>
    .pulse-animation {
        animation: pulse-button 2s infinite;
    }

    @keyframes pulse-button {
        0% {
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4);
        }
        70% {
            box-shadow: 0 0 0 15px rgba(245, 158, 11, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
        }
    }
</style>

<?php include_once '../includes/footer.php'; ?>