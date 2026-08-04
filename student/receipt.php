<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireLogin();

if (!isset($_GET['transaction_id'])) {
    redirect('quizzes.php');
}

$transaction_id = trim($_GET['transaction_id']);
$user_id = $_SESSION['user_id'];

// Fetch Purchase Record
$stmt = $pdo->prepare("
    SELECT p.*, q.title AS quiz_title, u.username, u.email 
    FROM user_quiz_purchases p 
    JOIN quizzes q ON p.quiz_id = q.id 
    JOIN users u ON p.user_id = u.id 
    WHERE p.transaction_id = ? AND (p.user_id = ? OR ? = 'admin')
");
$stmt->execute([$transaction_id, $user_id, $_SESSION['role'] ?? 'student']);
$purchase = $stmt->fetch();

if (!$purchase) {
    flash('message', 'Receipt not found.', 'danger');
    redirect('quizzes.php');
}

$pageTitle = 'Purchase Receipt';
include_once '../includes/header.php';

// Determine payment method label from transaction_id prefix
$payment_method_label = 'Credit / Debit Card';
if (strpos($purchase['transaction_id'], 'gpay') !== false) {
    $payment_method_label = 'Google Pay (GPay)';
}
?>

<div class="max-w-xl mx-auto py-10 px-4">
    <!-- Back Navigation & Print Button -->
    <div class="flex justify-between items-center mb-6 print:hidden">
        <a href="take-quiz.php?id=<?php echo $purchase['quiz_id']; ?>&mode=high" class="inline-flex items-center border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-5 py-2 rounded-full transition-all text-sm shadow-sm focus:outline-none">
            <i class="fas fa-arrow-left mr-2"></i>Start Quiz (High Mode)
        </a>
        <button onclick="window.print()" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-5 py-2 rounded-full shadow-md text-sm transition-all focus:outline-none hover:scale-105 flex items-center">
            <i class="fas fa-print mr-2 text-xs"></i>Print Receipt
        </button>
    </div>

    <!-- Main Receipt Card -->
    <div class="bg-white border border-slate-200 rounded-[32px] shadow-premium p-6 md:p-10 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary-600 to-amber-500"></div>

        <!-- Header -->
        <div class="flex justify-between items-start pb-6 border-b border-slate-100 mb-6">
            <div>
                <div class="flex items-center space-x-2 mb-1">
                    <i class="fas fa-graduation-cap text-primary-600 text-2xl"></i>
                    <span class="text-xl font-extrabold text-slate-900 tracking-wider">Quizara</span>
                </div>
                <p class="text-slate-400 text-xs font-semibold">Official Payment Receipt</p>
            </div>
            <div class="text-right">
                <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider inline-block mb-1">
                    <i class="fas fa-check-circle mr-1"></i> Paid
                </span>
                <p class="text-slate-400 text-xs font-mono font-semibold"><?php echo date('M d, Y h:i A', strtotime($purchase['purchased_at'])); ?></p>
            </div>
        </div>

        <!-- Order & Customer Meta -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6 bg-slate-50 border border-slate-100 rounded-2xl p-4 text-sm">
            <div>
                <span class="text-slate-400 text-xs font-bold uppercase tracking-wider block mb-1">Billed To</span>
                <strong class="text-slate-800 font-bold block"><?php echo sanitize($purchase['username']); ?></strong>
                <span class="text-slate-500 text-xs block break-all"><?php echo sanitize($purchase['email']); ?></span>
            </div>
            <div class="sm:text-right">
                <span class="text-slate-400 text-xs font-bold uppercase tracking-wider block mb-1">Transaction Ref</span>
                <code class="text-slate-800 font-mono text-xs font-bold block break-all" title="<?php echo sanitize($purchase['transaction_id']); ?>">
                    <?php echo sanitize($purchase['transaction_id']); ?>
                </code>
                <span class="text-slate-500 text-xs block mt-0.5"><?php echo $payment_method_label; ?></span>
            </div>
        </div>

        <!-- Receipt Table -->
        <div class="border border-slate-100 rounded-2xl overflow-hidden mb-6">
            <table class="w-full text-left text-sm text-slate-600 border-collapse">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-5 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Item Description</th>
                        <th class="px-5 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr>
                        <td class="px-5 py-4">
                            <strong class="text-slate-900 font-extrabold block text-sm mb-0.5"><?php echo sanitize($purchase['quiz_title']); ?></strong>
                            <span class="text-primary-600 text-xs font-bold">Premium High Mode Lifetime Access</span>
                        </td>
                        <td class="px-5 py-4 text-right font-extrabold text-slate-900 text-base">
                            ₹<?php echo number_format($purchase['amount'], 2); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Total Row -->
        <div class="flex justify-between items-center pt-4 border-t border-slate-100">
            <span class="text-slate-500 font-extrabold text-base">Total Amount Paid</span>
            <span class="text-3xl font-black text-slate-900">₹<?php echo number_format($purchase['amount'], 2); ?></span>
        </div>

        <!-- Footer Notice -->
        <div class="mt-8 pt-6 border-t border-slate-100 text-center text-xs text-slate-400 leading-relaxed">
            <p class="mb-1"><i class="fas fa-envelope mr-1 text-primary-500"></i> A copy of this receipt has been emailed to <strong><?php echo sanitize($purchase['email']); ?></strong>.</p>
            <p class="mb-0">Thank you for learning with Quizara! If you have any questions, contact us at <strong>support@quizara.com</strong>.</p>
        </div>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>
