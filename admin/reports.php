<?php include_once 'controllers/reports-process.php'; ?>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
    <div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2">Result Reports</h1>
        <p class="text-slate-505 text-sm mb-0">Analytics and performance overview.</p>
    </div>
    <div class="flex-shrink-0 print:hidden">
        <button onclick="window.print()" class="border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-5 py-2.5 rounded-full shadow-sm text-xs transition-all flex items-center focus:outline-none">
            <i class="fas fa-print mr-2 text-[10px]"></i>Print Report
        </button>
    </div>
</div>

<!-- Stats Dashboard -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 print:hidden">
    <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm text-center">
        <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-2">Total Attempts</div>
        <div class="text-4xl font-extrabold text-slate-800"><?php echo $total_attempts; ?></div>
    </div>
    <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm text-center">
        <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-2">Average Score</div>
        <div class="text-4xl font-extrabold text-sky-500"><?php echo $avg_score; ?>%</div>
    </div>
    <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm text-center">
        <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-2">Pass Rate</div>
        <div class="text-4xl font-extrabold text-emerald-500"><?php echo $pass_rate; ?>%</div>
    </div>
</div>

<!-- Results Table -->
<div class="bg-white border border-slate-200 rounded-3xl shadow-premium overflow-hidden mb-8">
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left text-sm text-slate-600 border-collapse">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Student</th>
                    <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Quiz Title</th>
                    <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Score</th>
                    <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Status</th>
                    <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($attempts) > 0): ?>
                    <?php foreach ($attempts as $attempt): ?>
                        <?php
                        $q_total = $attempt['total_questions'];
                        $percentage = $q_total > 0 ? ($attempt['score'] / $q_total) * 100 : 0;
                        $is_passed = $percentage >= 50;
                        ?>
                        <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50/30 transition-colors">
                            <td class="px-6 py-4 font-bold text-slate-800">
                                <?php echo sanitize($attempt['username']); ?>
                            </td>
                            <td class="px-6 py-4 text-slate-550 font-semibold">
                                <?php echo sanitize($attempt['quiz_title']); ?>
                            </td>
                            <td class="px-6 py-4 text-slate-800">
                                <span class="font-extrabold"><?php echo $attempt['score']; ?>/<?php echo $q_total; ?></span>
                                <small class="text-slate-400 text-xs ml-1">(<?php echo round($percentage); ?>%)</small>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php if ($is_passed): ?>
                                    <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider inline-flex items-center">
                                        Passed
                                    </span>
                                <?php else: ?>
                                    <span class="bg-rose-50 text-rose-600 border border-rose-100 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider inline-flex items-center">
                                        Failed
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-right text-slate-400 text-xs font-semibold">
                                <?php echo date('M d, Y H:i', strtotime($attempt['completed_at'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-12">
                            <div class="mb-4">
                                <i class="fas fa-chart-bar text-slate-300 text-5xl"></i>
                            </div>
                            <h5 class="font-bold text-slate-800 text-base mb-1">No results found</h5>
                            <p class="text-slate-400 text-xs">Students haven't completed any quizzes yet.</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>