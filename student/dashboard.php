<?php include_once '../controllers/dashboard-process.php'; ?>

<!-- Welcome Banner -->
<div class="relative rounded-[32px] bg-primary-600 p-8 md:p-10 overflow-hidden mb-8 shadow-md">
    <!-- Decorative shapes -->
    <div class="absolute -top-16 -right-16 w-36 h-36 rounded-full bg-primary-500 opacity-20"></div>
    <div class="absolute -bottom-16 -left-16 w-48 h-48 rounded-full bg-primary-700 opacity-30"></div>

    <div class="relative z-1 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <span class="inline-flex items-center bg-white/20 text-white border-0 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-4">
                <i class="fas fa-sparkles mr-2 text-xs"></i> Dashboard Overview
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2">Welcome back, <?php echo sanitize($_SESSION['username']); ?>!</h1>
            <p class="text-white/80 text-sm">You've completed <?php echo $total_attempts; ?> quizzes so far. Keep up the great work!</p>
        </div>
        <div class="flex-shrink-0">
            <div class="bg-white/10 p-4 rounded-2xl backdrop-blur-md border border-white/5">
                <div class="text-white/60 text-xs uppercase font-bold tracking-wider mb-1">Today's Date</div>
                <div class="text-white font-bold text-xs md:text-sm"><?php echo date('l, M j'); ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Stat Item 1 -->
    <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-lg mb-4 bg-amber-50 text-amber-500">
            <i class="fas fa-trophy"></i>
        </div>
        <div class="text-3xl font-extrabold text-slate-800 mb-1"><?php echo $total_attempts; ?></div>
        <div class="text-slate-400 text-sm font-bold uppercase tracking-wider">Quizzes Completed</div>
        <div class="absolute right-4 bottom-4 text-5xl text-slate-100/50 group-hover:scale-110 transition-transform -z-10"><i class="fas fa-trophy"></i></div>
    </div>

    <!-- Stat Item 2 -->
    <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-lg mb-4 bg-sky-50 text-sky-500">
            <i class="fas fa-chart-line"></i>
        </div>
        <div class="text-3xl font-extrabold text-slate-800 mb-1"><?php echo $avg_score; ?>%</div>
        <div class="text-slate-400 text-sm font-bold uppercase tracking-wider">Average Accuracy</div>
        <div class="absolute right-4 bottom-4 text-5xl text-slate-100/50 group-hover:scale-110 transition-transform -z-10"><i class="fas fa-chart-line"></i></div>
    </div>

    <!-- Stat Item 3 -->
    <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-lg mb-4 bg-primary-50 text-primary-500 border border-primary-100/30">
            <i class="fas fa-star"></i>
        </div>
        <div class="text-3xl font-extrabold text-slate-800 mb-1"><?php echo $total_attempts * 10; ?></div>
        <div class="text-slate-400 text-sm font-bold uppercase tracking-wider">Total Experience (XP)</div>
        <div class="absolute right-4 bottom-4 text-5xl text-slate-100/50 group-hover:scale-110 transition-transform -z-10"><i class="fas fa-star"></i></div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Recent Activity -->
    <div class="lg:col-span-8">
        <div class="flex justify-between items-center mb-6">
            <h4 class="font-extrabold text-slate-900 text-xl flex items-center">
                <i class="fas fa-history mr-2.5 text-primary-600"></i>Recent Activity
            </h4>
            <a href="history.php" class="text-sm text-primary-600 hover:text-primary-700 font-bold border border-primary-200 hover:bg-primary-50/50 px-3.5 py-1.5 rounded-full transition-all shadow-sm">View All</a>
        </div>

        <?php if (count($recent_history) > 0): ?>
            <div class="space-y-4">
                <?php foreach ($recent_history as $history): ?>
                    <?php
                    $score_pct = ($history['total_questions'] > 0) ? ($history['score'] / $history['total_questions']) : 0;
                    $is_passed = $score_pct >= 0.5;
                    $pct_value = round($score_pct * 100);
                    $status_color = $is_passed ? 'emerald' : 'rose';
                    $status_icon = $is_passed ? 'fa-check-circle' : 'fa-times-circle';
                    ?>
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                        <div class="flex items-center min-w-0">
                            <!-- Status Indicator Icon -->
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-lg mr-4 flex-shrink-0 bg-<?php echo $status_color; ?>-50 text-<?php echo $status_color; ?>-500">
                                <i class="fas <?php echo $status_icon; ?>"></i>
                            </div>
                            <div class="min-w-0">
                                <h6 class="font-bold text-slate-800 text-sm truncate"><?php echo sanitize($history['title']); ?></h6>
                                <div class="flex items-center text-slate-400 text-sm mt-1 space-x-3">
                                    <span class="flex items-center"><i class="far fa-calendar-alt mr-1.5"></i> <?php echo date('M d', strtotime($history['completed_at'])); ?></span>
                                    <span class="flex items-center"><i class="far fa-clock mr-1.5"></i> <?php echo date('h:i A', strtotime($history['completed_at'])); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right flex-shrink-0 ml-4">
                            <div class="font-extrabold text-sm text-<?php echo $status_color; ?>-600 mb-0.5"><?php echo $pct_value; ?>%</div>
                            <a href="review.php?attempt_id=<?php echo $history['id']; ?>" class="text-xs text-slate-400 hover:text-primary-600 font-bold transition-all inline-flex items-center">
                                Details <i class="fas fa-chevron-right ml-1 text-xs"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-10 text-center">
                <div class="w-16 h-16 rounded-full bg-slate-50 text-slate-400 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clipboard-list text-2xl"></i>
                </div>
                <h4 class="font-bold text-slate-800 text-base mb-1">No Recent Activity</h4>
                <p class="text-slate-400 text-sm mb-6">You haven't taken any quizzes yet. Start your journey now!</p>
                <a href="quizzes.php" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-bold px-6 py-2.5 rounded-full shadow-md text-sm transition-all hover:scale-105">
                    Browse Quizzes
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Quick Actions -->
    <div class="lg:col-span-4 space-y-6">
        <!-- New Challenge Action Card -->
        <div class="bg-primary-600 text-white rounded-[32px] p-6 shadow-md relative overflow-hidden group">
            <div class="absolute -top-10 -right-10 w-28 h-28 rounded-full bg-primary-550 opacity-20 group-hover:scale-125 transition-transform duration-500"></div>
            
            <div class="relative z-10">
                <i class="fas fa-rocket text-2xl text-primary-200 mb-4 block"></i>
                <h4 class="font-bold text-base text-white mb-1.5">New Challenge?</h4>
                <p class="text-primary-200 text-sm mb-6">Level up your skills by taking a new quiz today.</p>
                <a href="quizzes.php" class="block text-center w-full bg-white hover:bg-slate-50 text-primary-600 font-bold py-2.5 rounded-xl text-sm transition-all shadow-sm">
                    Browse Library <i class="fas fa-arrow-right ml-1 text-xs"></i>
                </a>
            </div>
        </div>

        <!-- Performance Insights Info Card -->
        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
            <h6 class="font-bold text-slate-800 text-sm mb-6">Performance Insights</h6>

            <div class="mb-5">
                <div class="flex justify-between items-center mb-1.5">
                    <span class="text-slate-400 text-sm font-semibold">Overall Completion</span>
                    <span class="font-bold text-sm text-primary-600">75%</span>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-primary-600 h-full rounded-full" style="width: 75%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center mb-1.5">
                    <span class="text-slate-400 text-sm font-semibold">Accuracy Rate</span>
                    <span class="font-bold text-sm text-emerald-600"><?php echo $avg_score; ?>%</span>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                    <div class="bg-emerald-500 h-full rounded-full" style="width: <?php echo $avg_score; ?>%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>