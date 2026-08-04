<?php include_once '../controllers/results-process.php'; ?>

<style>
    /* Circular Chart SVG styles */
    .circle-bg {
        fill: none;
        stroke: #F1F5F9;
        stroke-width: 2.8;
    }
    .circle {
        fill: none;
        stroke-width: 2.8;
        stroke-linecap: round;
        transition: stroke-dasharray 1s ease-in-out;
    }
</style>

<div class="max-w-2xl mx-auto py-12 relative">
    <?php if ($passed): ?>
        <canvas id="confetti" class="absolute top-0 left-0 w-full h-full pointer-events-none z-[999]"></canvas>
    <?php endif; ?>

    <div class="bg-white border border-slate-200 rounded-[32px] shadow-premium p-8 md:p-12 text-center relative overflow-hidden">
        <div class="pb-6 border-b border-slate-100 mb-8">
            <span class="bg-primary-50 text-primary-600 text-sm font-bold px-3.5 py-1.5 rounded-full mb-3 inline-block uppercase tracking-wider">Quiz Results</span>
            <h2 class="text-2xl md:text-3xl font-extrabold text-slate-900 mb-0"><?php echo sanitize($attempt['title']); ?></h2>
        </div>

        <!-- Circular Progress Bar -->
        <div class="relative w-48 h-48 mx-auto mb-8">
            <svg viewBox="0 0 36 36" class="w-full h-full">
                <path class="circle-bg"
                    d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831" />
                <path class="circle"
                    stroke-dasharray="<?php echo $percentage; ?>, 100"
                    stroke="<?php echo $passed ? '#10b981' : '#ef4444'; ?>"
                    d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831" />
            </svg>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                <div class="text-4xl md:text-5xl font-black text-slate-900 leading-none mb-1"><?php echo round($percentage); ?>%</div>
                <div class="text-xs font-bold uppercase tracking-wider <?php echo $passed ? 'text-emerald-500' : 'text-rose-500'; ?>">
                    <?php echo $passed ? 'PASSED' : 'FAILED'; ?>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <?php if ($passed): ?>
                <h2 class="text-xl font-bold text-slate-900 mb-3">Excellent Job!</h2>
                <p class="text-slate-500 text-sm leading-relaxed max-w-md mx-auto">You've mastered this topic with flying colors. Your performance shows a strong understanding of the material.</p>
            <?php else: ?>
                <h2 class="text-xl font-bold text-slate-900 mb-3">Don't Give Up!</h2>
                <p class="text-slate-500 text-sm leading-relaxed max-w-md mx-auto">Progress is a journey, not a destination. Review your answers and sharpen your knowledge for the next round!</p>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-3 gap-4 mb-8">
            <!-- Score box -->
            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl text-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-base mx-auto mb-2 bg-primary-50 border border-primary-100/30 text-primary-600">
                    <i class="fas fa-bullseye"></i>
                </div>
                <h3 class="text-slate-800 mb-0.5 font-extrabold text-base"><?php echo $attempt['score']; ?>/<?php echo $attempt['total_questions']; ?></h3>
                <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">Score</div>
            </div>
            <!-- Correct box -->
            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl text-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-base mx-auto mb-2 bg-emerald-50 text-emerald-500">
                    <i class="fas fa-check"></i>
                </div>
                <h3 class="text-slate-800 mb-0.5 font-extrabold text-base"><?php echo $attempt['correct_answers']; ?></h3>
                <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">Correct</div>
            </div>
            <!-- Wrong box -->
            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl text-center">
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-base mx-auto mb-2 bg-rose-50 text-rose-500">
                    <i class="fas fa-times"></i>
                </div>
                <h3 class="text-slate-800 mb-0.5 font-extrabold text-base"><?php echo $attempt['total_questions'] - $attempt['correct_answers']; ?></h3>
                <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">Wrong</div>
            </div>
        </div>

        <div class="space-y-4">
            <a href="review.php?attempt_id=<?php echo $attempt_id; ?>" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-sm flex items-center justify-center focus:outline-none">
                <span>Explore Answer Review</span> <i class="fas fa-arrow-right ml-2 text-xs"></i>
            </a>

            <div class="grid grid-cols-2 gap-4">
                <a href="quizzes.php" class="border border-slate-200 text-slate-500 hover:bg-primary-50 hover:border-primary-500 hover:text-primary-600 font-bold py-2.5 rounded-full text-sm transition-all text-center focus:outline-none">
                    <i class="fas fa-redo mr-2 text-xs"></i>New Challenge
                </a>
                <a href="dashboard.php" class="border border-slate-200 text-slate-500 hover:bg-primary-50 hover:border-primary-500 hover:text-primary-600 font-bold py-2.5 rounded-full text-sm transition-all text-center focus:outline-none">
                    <i class="fas fa-home mr-2 text-xs"></i>Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<?php if ($passed): ?>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <script>
        // Celebration Confetti
        var duration = 3 * 1000;
        var animationEnd = Date.now() + duration;
        var defaults = {
            startVelocity: 30,
            spread: 360,
            ticks: 60,
            zIndex: 0
        };

        function random(min, max) {
            return Math.random() * (max - min) + min;
        }

        var interval = setInterval(function() {
            var timeLeft = animationEnd - Date.now();

            if (timeLeft <= 0) {
                return clearInterval(interval);
            }

            var particleCount = 50 * (timeLeft / duration);
            confetti(Object.assign({}, defaults, {
                particleCount,
                origin: {
                    x: random(0.1, 0.3),
                    y: Math.random() - 0.2
                }
            }));
            confetti(Object.assign({}, defaults, {
                particleCount,
                origin: {
                    x: random(0.7, 0.9),
                    y: Math.random() - 0.2
                }
            }));
        }, 250);
    </script>
<?php endif; ?>

<?php include_once '../includes/footer.php'; ?>