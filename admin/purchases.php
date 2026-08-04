<?php
require_once '../config/database.php';
require_once '../includes/functions.php';
requireAdmin();

$pageTitle = 'Manage Purchases';
include_once '../includes/header.php';

// Fetch Purchases with User & Quiz details
$stmt = $pdo->prepare("
    SELECT p.*, u.username, u.email, u.profile_pic, q.title AS quiz_title, c.name AS category_name
    FROM user_quiz_purchases p
    JOIN users u ON p.user_id = u.id
    JOIN quizzes q ON p.quiz_id = q.id
    LEFT JOIN categories c ON q.category_id = c.id
    ORDER BY p.purchased_at DESC
");
$stmt->execute();
$purchases = $stmt->fetchAll();

// Calculate Stats
$total_purchases = count($purchases);
$total_revenue = 0;
$card_count = 0;
$gpay_count = 0;
$admin_granted_count = 0;

foreach ($purchases as $p) {
    $total_revenue += (float)$p['amount'];
    if (strpos($p['transaction_id'], 'card') !== false) {
        $card_count++;
    } else if (strpos($p['transaction_id'], 'gpay') !== false) {
        $gpay_count++;
    } else {
        $admin_granted_count++;
    }
}

// Fetch all students for Grant Access modal dropdown
$students_stmt = $pdo->query("SELECT id, username, email FROM users WHERE role = 'student' ORDER BY username ASC");
$all_students = $students_stmt->fetchAll();

// Fetch all quizzes for Grant Access modal dropdown
$quizzes_stmt = $pdo->query("SELECT id, title FROM quizzes ORDER BY title ASC");
$all_quizzes = $quizzes_stmt->fetchAll();
?>

<div class="max-w-7xl mx-auto py-6 px-2 md:px-4">
    <!-- Page Header & Actions -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl md:text-3xl font-black text-slate-900 flex items-center">
                <i class="fas fa-shopping-cart text-primary-600 mr-3"></i> High Mode Purchases Management
            </h2>
            <p class="text-slate-500 text-sm font-semibold mt-1">Monitor student payment transactions, view digital receipts, and grant or revoke High Mode access.</p>
        </div>
        <div>
            <button type="button" onclick="openGrantModal()" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-6 py-3 rounded-full shadow-md text-sm transition-all focus:outline-none hover:scale-105 flex items-center">
                <i class="fas fa-plus-circle mr-2"></i> Grant High Mode Access
            </button>
        </div>
    </div>

    <!-- Metrics Bar -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <!-- Stat 1: Total Purchases -->
        <div class="bg-white border border-slate-200 p-5 rounded-3xl shadow-sm relative overflow-hidden group">
            <div class="w-10 h-10 rounded-2xl bg-primary-50 border border-primary-100/40 text-primary-600 flex items-center justify-center text-base mb-3 shadow-sm">
                <i class="fas fa-receipt"></i>
            </div>
            <div class="text-2xl font-black text-slate-900 mb-0.5"><?php echo number_format($total_purchases); ?></div>
            <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">Total Purchases</div>
        </div>

        <!-- Stat 2: Total Revenue -->
        <div class="bg-white border border-slate-200 p-5 rounded-3xl shadow-sm relative overflow-hidden group">
            <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base mb-3 shadow-sm">
                <i class="fas fa-wallet"></i>
            </div>
            <div class="text-2xl font-black text-slate-900 mb-0.5">₹<?php echo number_format($total_revenue, 2); ?></div>
            <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">Total Revenue</div>
        </div>

        <!-- Stat 3: Card Transactions -->
        <div class="bg-white border border-slate-200 p-5 rounded-3xl shadow-sm relative overflow-hidden group">
            <div class="w-10 h-10 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-base mb-3 shadow-sm">
                <i class="fas fa-credit-card"></i>
            </div>
            <div class="text-2xl font-black text-slate-900 mb-0.5"><?php echo number_format($card_count); ?></div>
            <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">Card Payments</div>
        </div>

        <!-- Stat 4: GPay Transactions -->
        <div class="bg-white border border-slate-200 p-5 rounded-3xl shadow-sm relative overflow-hidden group">
            <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center text-base mb-3 shadow-sm">
                <i class="fab fa-google-pay text-lg"></i>
            </div>
            <div class="text-2xl font-black text-slate-900 mb-0.5"><?php echo number_format($gpay_count); ?></div>
            <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">Google Pay</div>
        </div>
    </div>

    <!-- Main Table Container -->
    <div class="bg-white border border-slate-200 rounded-[32px] shadow-premium overflow-hidden">
        <!-- Table Filter Controls -->
        <div class="p-5 md:p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row gap-4 items-center justify-between">
            <div class="relative w-full sm:w-80">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" id="purchaseSearch" onkeyup="filterPurchasesTable()" class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-primary-600 transition-all text-slate-800 font-medium shadow-sm" placeholder="Search student, quiz, or ref...">
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                <div class="relative w-full sm:w-auto">
                    <select id="methodFilter" onchange="filterPurchasesTable()" class="appearance-none w-full bg-white border border-slate-200 rounded-full pl-5 pr-10 py-2.5 text-xs font-bold text-slate-700 focus:outline-none focus:border-primary-600 shadow-sm cursor-pointer transition-all">
                        <option value="ALL">All Payment Methods</option>
                        <option value="CARD">Credit / Debit Card</option>
                        <option value="GPAY">Google Pay (GPay)</option>
                        <option value="ADMIN">Admin Granted</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="purchasesTable">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="px-6 py-4">Student</th>
                        <th class="px-6 py-4">Quiz Purchased</th>
                        <th class="px-6 py-4">Transaction Ref</th>
                        <th class="px-6 py-4">Payment Method</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Date & Time</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm font-medium text-slate-700">
                    <?php if (empty($purchases)): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-400 italic">
                                <i class="fas fa-receipt block mb-3 text-3xl opacity-30"></i>
                                No High Mode purchases recorded yet.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($purchases as $p): 
                            $method_tag = 'CARD';
                            $method_badge_class = 'bg-sky-50 text-sky-700 border-sky-200/60';
                            $method_icon = '<i class="fas fa-credit-card mr-1.5"></i> Card';

                            if (strpos($p['transaction_id'], 'gpay') !== false) {
                                $method_tag = 'GPAY';
                                $method_badge_class = 'bg-amber-50 text-amber-700 border-amber-200/60';
                                $method_icon = '<i class="fab fa-google-pay mr-1.5 text-base"></i> GPay';
                            } else if (strpos($p['transaction_id'], 'admin') !== false) {
                                $method_tag = 'ADMIN';
                                $method_badge_class = 'bg-purple-50 text-purple-700 border-purple-200/60';
                                $method_icon = '<i class="fas fa-user-shield mr-1.5"></i> Granted';
                            }
                        ?>
                            <tr class="hover:bg-slate-50/70 transition-colors purchase-row" data-method="<?php echo $method_tag; ?>">
                                <!-- Student Column -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-9 h-9 rounded-full bg-primary-50 border border-slate-200 flex items-center justify-center text-primary-600 font-bold text-xs flex-shrink-0 overflow-hidden shadow-sm">
                                            <?php if (!empty($p['profile_pic']) && file_exists('../assets/images/profiles/' . $p['profile_pic'])): ?>
                                                <img src="../assets/images/profiles/<?php echo sanitize($p['profile_pic']); ?>" alt="Student" class="w-full h-full object-cover">
                                            <?php else: ?>
                                                <span><?php echo strtoupper(substr($p['username'], 0, 1)); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <strong class="text-slate-900 font-extrabold block text-sm mb-0.5"><?php echo sanitize($p['username']); ?></strong>
                                            <span class="text-slate-400 text-xs block"><?php echo sanitize($p['email']); ?></span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Quiz Purchased -->
                                <td class="px-6 py-4">
                                    <strong class="text-slate-900 font-extrabold block text-sm mb-0.5"><?php echo sanitize($p['quiz_title']); ?></strong>
                                    <span class="bg-slate-100 text-slate-600 text-[10px] font-bold px-2 py-0.5 rounded-full inline-block">
                                        <?php echo sanitize($p['category_name'] ?? 'General'); ?>
                                    </span>
                                </td>

                                <!-- Transaction Ref -->
                                <td class="px-6 py-4">
                                    <code class="text-slate-800 font-mono text-xs bg-slate-100 px-2.5 py-1 rounded-lg border border-slate-200/70 inline-block font-bold" title="<?php echo sanitize($p['transaction_id']); ?>">
                                        <?php echo sanitize($p['transaction_id']); ?>
                                    </code>
                                </td>

                                <!-- Payment Method -->
                                <td class="px-6 py-4">
                                    <span class="border text-xs font-bold px-3 py-1 rounded-full inline-flex items-center <?php echo $method_badge_class; ?>">
                                        <?php echo $method_icon; ?>
                                    </span>
                                </td>

                                <!-- Amount -->
                                <td class="px-6 py-4">
                                    <strong class="text-slate-900 font-black text-sm">₹<?php echo number_format($p['amount'], 2); ?></strong>
                                </td>

                                <!-- Date & Time -->
                                <td class="px-6 py-4 text-xs font-semibold text-slate-500">
                                    <?php echo date('M d, Y', strtotime($p['purchased_at'])); ?><br>
                                    <span class="text-slate-400 text-[10px]"><?php echo date('g:i A', strtotime($p['purchased_at'])); ?></span>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- View Receipt -->
                                        <button type="button" onclick="viewReceipt('<?php echo sanitize($p['transaction_id']); ?>', '<?php echo sanitize(addslashes($p['username'])); ?>', '<?php echo sanitize(addslashes($p['email'])); ?>', '<?php echo sanitize(addslashes($p['quiz_title'])); ?>', '<?php echo number_format($p['amount'], 2); ?>', '<?php echo date('F j, Y, g:i a', strtotime($p['purchased_at'])); ?>', '<?php echo $method_tag; ?>')" class="w-8 h-8 rounded-full border border-slate-200 text-slate-500 hover:text-primary-600 hover:bg-primary-50 flex items-center justify-center transition-all shadow-sm focus:outline-none" title="View Digital Receipt">
                                            <i class="fas fa-file-invoice text-xs"></i>
                                        </button>

                                        <!-- Revoke Access / Delete -->
                                        <button type="button" onclick="confirmDeletePurchase(<?php echo $p['id']; ?>, '<?php echo sanitize(addslashes($p['username'])); ?>', '<?php echo sanitize(addslashes($p['quiz_title'])); ?>')" class="w-8 h-8 rounded-full border border-rose-200 text-rose-600 hover:bg-rose-600 hover:text-white flex items-center justify-center transition-all shadow-sm focus:outline-none" title="Revoke High Mode Access">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal 1: Grant High Mode Access -->
<div class="modal fixed inset-0 z-50 items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden" id="grantModal" aria-hidden="true">
    <div class="bg-white rounded-[32px] shadow-premium max-w-md w-full m-4 relative border border-slate-100 overflow-hidden animate-bounce-in">
        <div class="bg-primary-600 p-6 text-white relative">
            <h4 class="text-xl font-black mb-1 flex items-center">
                <i class="fas fa-plus-circle mr-2 text-amber-400"></i> Grant High Mode Access
            </h4>
            <p class="text-primary-100 text-xs font-medium opacity-80">Manually unlock High Mode for any student</p>
            <button type="button" class="absolute top-6 right-6 text-white/80 hover:text-white text-lg focus:outline-none" onclick="closeGrantModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="controllers/purchases-process.php" method="POST" class="p-6 md:p-8 space-y-5 bg-white">
            <input type="hidden" name="grant_access" value="1">

            <!-- Student Selection -->
            <div>
                <label for="student_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Select Student</label>
                <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all relative">
                    <span class="px-4 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-user font-normal"></i></span>
                    <select id="student_id" name="student_id" class="appearance-none flex-grow pl-4 pr-10 py-3 text-sm bg-white focus:outline-none text-slate-800 font-medium cursor-pointer" required>
                        <option value="">-- Choose Student --</option>
                        <?php foreach ($all_students as $st): ?>
                            <option value="<?php echo $st['id']; ?>"><?php echo sanitize($st['username']); ?> (<?php echo sanitize($st['email']); ?>)</option>
                        <?php endforeach; ?>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <!-- Quiz Selection -->
            <div>
                <label for="quiz_id" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Select Quiz</label>
                <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all relative">
                    <span class="px-4 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-book font-normal"></i></span>
                    <select id="quiz_id" name="quiz_id" class="appearance-none flex-grow pl-4 pr-10 py-3 text-sm bg-white focus:outline-none text-slate-800 font-medium cursor-pointer" required>
                        <option value="">-- Choose Quiz --</option>
                        <?php foreach ($all_quizzes as $qz): ?>
                            <option value="<?php echo $qz['id']; ?>"><?php echo sanitize($qz['title']); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <!-- Amount -->
            <div>
                <label for="grant_amount" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Record Amount (₹)</label>
                <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                    <span class="px-4 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm font-bold">₹</span>
                    <input type="number" step="0.01" class="flex-grow px-4 py-3 text-sm bg-white focus:outline-none text-slate-800 font-medium" id="grant_amount" name="amount" value="0.00">
                </div>
                <small class="text-slate-400 text-xs mt-1 block">Set 0.00 for complimentary/admin granted access.</small>
            </div>

            <div class="flex justify-end space-x-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeGrantModal()" class="border border-slate-200 text-slate-500 hover:bg-slate-50 font-bold px-5 py-2.5 rounded-full text-xs transition-all focus:outline-none">Cancel</button>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-6 py-2.5 rounded-full shadow-md text-xs transition-all focus:outline-none hover:scale-105">Grant High Mode</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal 2: View Digital Receipt -->
<div class="modal fixed inset-0 z-50 items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden" id="receiptModal" aria-hidden="true">
    <div class="bg-white rounded-[32px] shadow-premium max-w-md w-full m-4 relative border border-slate-100 overflow-hidden animate-bounce-in p-6">
        <div class="flex justify-between items-start pb-4 border-b border-slate-100 mb-4">
            <div>
                <div class="flex items-center space-x-2 mb-0.5">
                    <i class="fas fa-graduation-cap text-primary-600 text-xl"></i>
                    <span class="text-lg font-black text-slate-900 tracking-wider">Quizara</span>
                </div>
                <p class="text-slate-400 text-xs font-semibold">Payment Confirmation Receipt</p>
            </div>
            <button type="button" onclick="closeReceiptModal()" class="text-slate-400 hover:text-slate-600 text-lg focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="space-y-4 text-xs font-medium text-slate-700">
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 space-y-2">
                <div class="flex justify-between">
                    <span class="text-slate-400 font-bold uppercase">Billed To:</span>
                    <strong class="text-slate-900 font-bold" id="rcStudentName">-</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400 font-bold uppercase">Email:</span>
                    <span class="text-slate-700" id="rcStudentEmail">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400 font-bold uppercase">Transaction Ref:</span>
                    <code class="text-primary-600 font-mono font-bold" id="rcRef">-</code>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400 font-bold uppercase">Payment Method:</span>
                    <span class="font-bold text-slate-800" id="rcMethod">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400 font-bold uppercase">Date & Time:</span>
                    <span class="text-slate-700" id="rcDate">-</span>
                </div>
            </div>

            <div class="border border-slate-100 rounded-2xl p-4 flex justify-between items-center">
                <div>
                    <strong class="text-slate-900 font-bold block text-sm mb-0.5" id="rcQuizTitle">-</strong>
                    <span class="text-primary-600 text-[11px] font-bold">High Difficulty Mode Access</span>
                </div>
                <div class="text-right">
                    <span class="text-lg font-black text-slate-900" id="rcAmount">₹0.00</span>
                </div>
            </div>
        </div>

        <div class="mt-6 pt-4 border-t border-slate-100 text-center">
            <button type="button" onclick="closeReceiptModal()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-2.5 rounded-full text-xs transition-all focus:outline-none">
                Close Preview
            </button>
        </div>
    </div>
</div>

<!-- Modal 3: Revoke Access Confirmation -->
<div class="modal fixed inset-0 z-50 items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden" id="deletePurchaseModal" aria-hidden="true">
    <div class="bg-white rounded-3xl shadow-premium max-w-sm w-full m-4 relative p-8 border border-slate-100 text-center animate-bounce-in">
        <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-2xl flex items-center justify-center text-xl mx-auto mb-4">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h5 class="text-xl font-black text-slate-900 mb-2">Revoke High Mode?</h5>
        <p class="text-slate-400 text-sm mb-6 leading-relaxed">Are you sure you want to delete purchase record for <strong id="delStudentName" class="text-slate-800">Student</strong> on <strong id="delQuizTitle" class="text-slate-800">Quiz</strong>? High Mode access will be revoked.</p>
        
        <form action="controllers/purchases-process.php" method="POST" class="space-y-3">
            <input type="hidden" name="delete_purchase" value="1">
            <input type="hidden" name="purchase_id" id="delPurchaseId" value="0">

            <div class="flex flex-col space-y-2">
                <button type="submit" class="block w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3.5 rounded-full shadow-md transition-all focus:outline-none text-sm">
                    Confirm & Revoke Access
                </button>
                <button type="button" onclick="closeDeletePurchaseModal()" class="w-full text-slate-400 hover:text-slate-600 text-sm font-bold py-2 focus:outline-none">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function filterPurchasesTable() {
    const searchVal = document.getElementById('purchaseSearch').value.toLowerCase().trim();
    const methodFilter = document.getElementById('methodFilter').value;
    const rows = document.querySelectorAll('#purchasesTable tbody tr.purchase-row');

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        const rowMethod = row.getAttribute('data-method');

        const matchesSearch = text.includes(searchVal);
        const matchesMethod = (methodFilter === 'ALL' || rowMethod === methodFilter);

        if (matchesSearch && matchesMethod) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function openGrantModal() {
    document.getElementById('grantModal').classList.remove('hidden');
    document.getElementById('grantModal').classList.add('flex');
}

function closeGrantModal() {
    document.getElementById('grantModal').classList.add('hidden');
    document.getElementById('grantModal').classList.remove('flex');
}

function viewReceipt(ref, name, email, quiz, amount, date, method) {
    document.getElementById('rcRef').innerText = ref;
    document.getElementById('rcStudentName').innerText = name;
    document.getElementById('rcStudentEmail').innerText = email;
    document.getElementById('rcQuizTitle').innerText = quiz;
    document.getElementById('rcAmount').innerText = '₹' + amount;
    document.getElementById('rcDate').innerText = date;
    
    let methodText = 'Credit / Debit Card';
    if (method === 'GPAY') methodText = 'Google Pay (GPay)';
    if (method === 'ADMIN') methodText = 'Admin Granted Access';
    document.getElementById('rcMethod').innerText = methodText;

    document.getElementById('receiptModal').classList.remove('hidden');
    document.getElementById('receiptModal').classList.add('flex');
}

function closeReceiptModal() {
    document.getElementById('receiptModal').classList.add('hidden');
    document.getElementById('receiptModal').classList.remove('flex');
}

function confirmDeletePurchase(purchaseId, studentName, quizTitle) {
    document.getElementById('delPurchaseId').value = purchaseId;
    document.getElementById('delStudentName').innerText = studentName;
    document.getElementById('delQuizTitle').innerText = quizTitle;

    document.getElementById('deletePurchaseModal').classList.remove('hidden');
    document.getElementById('deletePurchaseModal').classList.add('flex');
}

function closeDeletePurchaseModal() {
    document.getElementById('deletePurchaseModal').classList.add('hidden');
    document.getElementById('deletePurchaseModal').classList.remove('flex');
}
</script>

<?php include_once '../includes/footer.php'; ?>
