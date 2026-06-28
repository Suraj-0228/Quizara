<?php include_once 'controllers/details.php'; ?>

<!-- Back Navigation -->
<div class="mb-6">
    <a href="students.php" class="inline-flex items-center border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-5 py-2 rounded-full transition-all text-xs focus:outline-none shadow-sm">
        <i class="fas fa-arrow-left mr-2"></i>Back to Students
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Student Profile Card -->
    <div class="lg:col-span-4">
        <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-premium text-center relative overflow-hidden h-full">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-primary-500 to-primary-600"></div>
            
            <div class="pt-4">
                <div class="w-24 h-24 rounded-full bg-primary-50 border border-slate-100 flex items-center justify-center font-bold text-primary-600 mx-auto mb-4 text-3xl select-none shadow-sm">
                    <span><?php echo strtoupper(substr($student['username'], 0, 1)); ?></span>
                </div>

                <h3 class="font-extrabold text-slate-900 text-xl mb-1"><?php echo sanitize($student['username']); ?></h3>
                <p class="text-slate-400 text-xs font-semibold mb-6 flex items-center justify-center">
                    <i class="fas fa-envelope mr-2 text-primary-400"></i><?php echo sanitize($student['email']); ?>
                </p>

                <div class="grid grid-cols-2 gap-4 mt-6 border-t border-slate-100 pt-6 text-left">
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                        <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Quizzes</div>
                        <div class="text-2xl mb-0 font-extrabold text-slate-800"><?php echo count($attempts); ?></div>
                    </div>
                    <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                        <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Joined</div>
                        <div class="text-sm mb-0 font-extrabold text-slate-850 pt-1.5"><?php echo date('M Y', strtotime($student['created_at'])); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quiz History -->
    <div class="lg:col-span-8">
        <div class="bg-white border border-slate-200 rounded-3xl shadow-premium overflow-hidden h-full">
            <div class="p-6 border-b border-slate-100 flex items-center bg-slate-50/50">
                <h5 class="font-extrabold text-slate-900 text-base flex items-center">
                    <i class="fas fa-history mr-2.5 text-primary-600"></i>Quiz History
                </h5>
            </div>
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left text-sm text-slate-600 border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Quiz Title</th>
                            <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Date Taken</th>
                            <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider">Score</th>
                            <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-center">Result</th>
                            <th class="px-6 py-3.5 text-xs font-bold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($attempts) > 0): ?>
                            <?php foreach ($attempts as $attempt): ?>
                                <?php
                                $total_questions = $attempt['quiz_total'];
                                $percentage = $total_questions > 0 ? ($attempt['score'] / $total_questions) * 100 : 0;
                                $passed = $percentage >= 50;
                                ?>
                                <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50/30 transition-colors">
                                    <td class="px-6 py-4 font-bold text-slate-800">
                                        <?php echo sanitize($attempt['title']); ?>
                                    </td>
                                    <td class="px-6 py-4 text-slate-400 text-xs font-semibold">
                                        <?php echo date('M d, Y H:i', strtotime($attempt['started_at'])); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-extrabold text-slate-800"><?php echo $attempt['score']; ?>/<?php echo $total_questions; ?></span>
                                        <small class="text-slate-400 text-xs ml-1">(<?php echo round($percentage); ?>%)</small>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <?php if ($passed): ?>
                                            <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider inline-flex items-center">Passed</span>
                                        <?php else: ?>
                                            <span class="bg-rose-50 text-rose-600 border border-rose-100 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider inline-flex items-center">Failed</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="../student/review.php?attempt_id=<?php echo $attempt['id']; ?>" class="w-8 h-8 rounded-full flex items-center justify-center text-primary-550 hover:bg-primary-50 transition-all" title="Review Attempt">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-12">
                                    <div class="mb-4">
                                        <i class="fas fa-clipboard-list text-slate-300 text-5xl"></i>
                                    </div>
                                    <h5 class="font-bold text-slate-800 text-base mb-1">No quiz attempts yet</h5>
                                    <p class="text-slate-400 text-xs">This student hasn't taken any quizzes.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>