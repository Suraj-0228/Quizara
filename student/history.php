<?php include_once '../controllers/history-process.php'; ?>

<!-- History Header -->
<div class="relative rounded-[32px] bg-primary-600 p-8 md:p-10 overflow-hidden mb-8 shadow-md">
    <!-- Decorative shapes -->
    <div class="absolute -top-16 -right-16 w-36 h-36 rounded-full bg-primary-500 opacity-20"></div>
    <div class="absolute -bottom-16 -left-16 w-48 h-48 rounded-full bg-primary-700 opacity-30"></div>

    <div class="relative z-1 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <span class="inline-flex items-center bg-white/20 text-white border-0 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                <i class="fas fa-clock-rotate-left mr-2 text-xs"></i> Progress Tracker
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2">Learning <span class="text-primary-250 opacity-95">Timeline</span></h1>
            <p class="text-white/80 text-sm mb-0">A detailed journey of your achievements and challenges.</p>
        </div>
        <div class="flex-shrink-0 flex gap-2">
            <a href="reports.php" class="bg-white hover:bg-slate-50 text-primary-600 font-bold px-5 py-2.5 rounded-full shadow-sm text-sm flex items-center transition-all">
                <i class="fas fa-chart-pie mr-2"></i>Analytics
            </a>
            <a href="quizzes.php" class="bg-primary-700 hover:bg-primary-800 text-white font-bold px-5 py-2.5 rounded-full shadow-sm text-sm flex items-center border border-white/10 transition-all">
                <i class="fas fa-plus mr-2 text-xs"></i>New Quiz
            </a>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto py-6">
    <?php if (count($history) > 0): ?>
        <div class="relative border-l-2 border-slate-200 ml-4 md:ml-32 space-y-8 pb-4">
            <?php foreach ($history as $item): ?>
                <?php
                $percentage = ($item['total_questions'] > 0) ? ($item['score'] / $item['total_questions']) * 100 : 0;
                $passed = $percentage >= $item['passing_score'];
                $statusColor = $passed ? 'emerald' : 'rose';
                $dotColor = $passed ? 'bg-emerald-500' : 'bg-rose-500';
                ?>

                <div class="relative pl-8">
                    <!-- Date Marker (Desktop) -->
                    <div class="absolute right-full top-1 mr-8 hidden md:block text-right w-24">
                        <div class="font-extrabold text-slate-800 text-sm"><?php echo date('M d, Y', strtotime($item['completed_at'])); ?></div>
                        <small class="text-slate-400 text-xs font-bold uppercase tracking-wider"><?php echo date('h:i A', strtotime($item['completed_at'])); ?></small>
                    </div>
                    
                    <!-- Timeline dot marker -->
                    <span class="absolute -left-2.5 top-2.5 w-5 h-5 rounded-full border-4 border-white <?php echo $dotColor; ?> shadow-sm"></span>

                    <!-- Timeline Content Card -->
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                            <div class="flex-grow min-w-0">
                                <div class="flex flex-wrap items-center gap-3 mb-3">
                                    <?php if ($passed): ?>
                                        <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider flex items-center">
                                            <i class="fas fa-check-circle mr-1"></i> Passed
                                        </span>
                                    <?php else: ?>
                                        <span class="bg-rose-50 text-rose-600 border border-rose-100 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider flex items-center">
                                            <i class="fas fa-times-circle mr-1"></i> Failed
                                        </span>
                                    <?php endif; ?>
                                    <div class="text-slate-400 text-sm font-semibold">
                                        <i class="fas fa-bullseye mr-1"></i> Target: <?php echo $item['passing_score']; ?>%
                                    </div>
                                </div>

                                <h4 class="font-extrabold text-slate-900 text-base mb-1.5"><?php echo sanitize($item['title']); ?></h4>

                                <!-- Mobile Date (visible only on small screens) -->
                                <div class="md:hidden text-slate-400 text-sm mb-3 font-semibold">
                                    <i class="far fa-calendar-alt mr-1"></i> <?php echo date('M d, Y • h:i A', strtotime($item['completed_at'])); ?>
                                </div>

                                <div class="flex items-center gap-3 mt-4">
                                    <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden max-w-[200px]">
                                        <div class="h-full rounded-full <?php echo $passed ? 'bg-emerald-500' : 'bg-rose-500'; ?>" style="width: <?php echo $percentage; ?>%"></div>
                                    </div>
                                    <span class="font-bold text-sm <?php echo $passed ? 'text-emerald-600' : 'text-rose-600'; ?>">
                                        <?php echo round($percentage); ?>% Accuracy
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2 items-center flex-shrink-0 mt-4 lg:mt-0 w-full lg:w-auto justify-end">
                                <?php if ($percentage >= 75): ?>
                                    <a href="download-certificate.php?attempt_id=<?php echo $item['id']; ?>" class="w-10 h-10 border border-amber-200 hover:border-transparent text-amber-500 hover:bg-amber-500 hover:text-white rounded-full flex items-center justify-center transition-all focus:outline-none shadow-sm" title="Achievement Certificate" target="_blank">
                                        <i class="fas fa-award"></i>
                                    </a>
                                <?php endif; ?>

                                <a href="results.php?attempt_id=<?php echo $item['id']; ?>" class="border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-4 py-2.5 rounded-full text-sm transition-all focus:outline-none flex items-center shadow-sm" title="View Detailed Analysis">
                                    <i class="fas fa-chart-bar mr-1.5"></i> Stats
                                </a>
                                <a href="review.php?attempt_id=<?php echo $item['id']; ?>" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-5 py-2.5 rounded-full shadow-md text-sm transition-all focus:outline-none hover:scale-105 flex items-center">
                                    Review <i class="fas fa-chevron-right ml-1.5 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-3xl border border-slate-200 shadow-premium text-center py-12 px-4 mt-8 max-w-xl mx-auto">
            <div class="w-20 h-20 rounded-full bg-slate-50 text-slate-300 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-clock-rotate-left text-3xl"></i>
            </div>
            <h3 class="font-extrabold text-slate-800 text-lg mb-2">No Journey Logged Yet</h3>
            <p class="text-slate-400 text-sm mb-6 max-w-xs mx-auto leading-relaxed">Your learning timeline is waiting for its first record. Start a challenge and begin building your history today!</p>
            <a href="quizzes.php" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3 rounded-full shadow-md text-sm transition-all hover:scale-105">
                <i class="fas fa-rocket mr-2"></i>Start Your First Quiz
            </a>
        </div>
    <?php endif; ?>
</div>

<?php include_once '../includes/footer.php'; ?>