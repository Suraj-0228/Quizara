<?php include_once 'controllers/dash-process.php'; ?>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
    <div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2">Admin Dashboard</h1>
        <p class="text-slate-500 text-sm md:text-base mb-0">Overview of system performance, student purchases, and platform activity.</p>
    </div>
    <div class="flex flex-wrap items-center gap-3">
        <a href="purchases.php" class="border-2 border-primary-600 text-primary-600 hover:bg-primary-50 font-bold px-5 py-2.5 rounded-full shadow-sm text-sm transition-all focus:outline-none flex items-center">
            <i class="fas fa-shopping-cart mr-2 text-xs"></i>Manage Purchases (<?php echo $stats['purchases']; ?>)
        </a>
        <a href="add-quiz.php" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-6 py-3 rounded-full shadow-md text-sm transition-all focus:outline-none hover:scale-105 flex items-center">
            <i class="fas fa-plus mr-2 text-xs"></i>Create New Quiz
        </a>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 md:gap-6 mb-8">
    <!-- Stat Item 1 -->
    <div class="bg-white border border-slate-200 p-5 rounded-2xl shadow-sm relative overflow-hidden group flex items-center justify-between">
        <div>
            <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Total Students</div>
            <div class="text-2xl font-black text-slate-800"><?php echo number_format($stats['students']); ?></div>
        </div>
        <div class="w-10 h-10 rounded-2xl flex items-center justify-center text-base bg-primary-50 text-primary-600 border border-primary-100/30">
            <i class="fas fa-users"></i>
        </div>
    </div>

    <!-- Stat Item 2 -->
    <div class="bg-white border border-slate-200 p-5 rounded-2xl shadow-sm relative overflow-hidden group flex items-center justify-between">
        <div>
            <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Active Quizzes</div>
            <div class="text-2xl font-black text-slate-800"><?php echo number_format($stats['quizzes']); ?></div>
        </div>
        <div class="w-10 h-10 rounded-2xl flex items-center justify-center text-base bg-emerald-50 text-emerald-600">
            <i class="fas fa-clipboard-check"></i>
        </div>
    </div>

    <!-- Stat Item 3 -->
    <div class="bg-white border border-slate-200 p-5 rounded-2xl shadow-sm relative overflow-hidden group flex items-center justify-between">
        <div>
            <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Question Bank</div>
            <div class="text-2xl font-black text-slate-800"><?php echo number_format($stats['questions']); ?></div>
        </div>
        <div class="w-10 h-10 rounded-2xl flex items-center justify-center text-base bg-amber-50 text-amber-500">
            <i class="fas fa-database"></i>
        </div>
    </div>

    <!-- Stat Item 4 -->
    <div class="bg-white border border-slate-200 p-5 rounded-2xl shadow-sm relative overflow-hidden group flex items-center justify-between">
        <div>
            <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Attempts</div>
            <div class="text-2xl font-black text-slate-800"><?php echo number_format($stats['attempts']); ?></div>
        </div>
        <div class="w-10 h-10 rounded-2xl flex items-center justify-center text-base bg-sky-50 text-sky-600">
            <i class="fas fa-history"></i>
        </div>
    </div>

    <!-- Stat Item 5: Revenue -->
    <div class="bg-white border border-slate-200 p-5 rounded-2xl shadow-sm relative overflow-hidden group flex items-center justify-between">
        <div>
            <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">High Revenue</div>
            <div class="text-2xl font-black text-slate-800">₹<?php echo number_format($stats['revenue'], 2); ?></div>
        </div>
        <div class="w-10 h-10 rounded-2xl flex items-center justify-center text-base bg-indigo-50 text-indigo-600">
            <i class="fas fa-shopping-cart"></i>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="bg-white border border-slate-200 rounded-3xl shadow-premium overflow-hidden mb-8">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
        <h5 class="font-extrabold text-slate-900 text-base flex items-center">
            <i class="fas fa-clock mr-2.5 text-primary-600"></i>Recent Student Activity
        </h5>
        <a href="reports.php" class="text-sm text-primary-600 hover:text-primary-700 font-bold border border-primary-200 hover:bg-primary-50/50 px-3.5 py-1.5 rounded-full transition-all">View Reports</a>
    </div>
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left text-sm text-slate-600 border-collapse">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider">Student</th>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider">Quiz</th>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider">Score</th>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($recent_attempts) > 0): ?>
                    <?php foreach ($recent_attempts as $attempt): ?>
                        <?php
                        $percentage = ($attempt['score'] / $attempt['total_questions']) * 100;
                        $is_passed = $percentage >= 50;
                        ?>
                        <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-primary-50 border border-slate-100 flex items-center justify-center font-bold text-primary-600 mr-3 text-xs select-none">
                                        <?php echo strtoupper(substr($attempt['username'], 0, 1)); ?>
                                    </div>
                                    <span class="font-bold text-slate-800"><?php echo sanitize($attempt['username']); ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-500 font-semibold"><?php echo sanitize($attempt['quiz_title']); ?></td>
                            <td class="px-6 py-4 text-slate-800">
                                <span class="font-extrabold"><?php echo round($percentage); ?>%</span>
                                <span class="text-slate-400 text-sm ml-1">(<?php echo $attempt['score']; ?>/<?php echo $attempt['total_questions']; ?>)</span>
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-sm font-semibold"><?php echo date('M d, H:i', strtotime($attempt['completed_at'])); ?></td>
                            <td class="px-6 py-4">
                                <?php if ($is_passed): ?>
                                    <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider inline-flex items-center">
                                        <i class="fas fa-check-circle mr-1"></i> Passed
                                    </span>
                                <?php else: ?>
                                    <span class="bg-rose-50 text-rose-600 border border-rose-100 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider inline-flex items-center">
                                        <i class="fas fa-times-circle mr-1"></i> Failed
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-8 text-slate-400 italic">No recent activity found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>