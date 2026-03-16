<?php include_once '../controllers/results-process.php'; ?>

<div class="row justify-content-center position-relative">
    <?php if ($passed): ?>
        <canvas id="confetti" class="position-absolute top-0 start-0 w-100 h-100" style="pointer-events: none; z-index: 999;"></canvas>
    <?php endif; ?>

    <div class="col-md-9 col-lg-7 text-center">
        <div class="results-card-premium mb-5">
            <div class="p-4 border-bottom border-slate-50 mt-2">
                <span class="badge bg-indigo-50 text-dark px-3 py-2 rounded-pill small fw-bold mb-2">QUIZ RESULTS</span>
                <h2 class="fw-extrabold text-slate-900 mb-0"><?php echo sanitize($attempt['title']); ?></h2>
            </div>

            <div class="card-body p-4 p-md-5">
                <!-- Circular Progress Bar -->
                <div class="position-relative d-inline-block mb-5">
                    <div class="circular-chart-premium">
                        <svg viewBox="0 0 36 36" class="w-100 h-100">
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
                        <div class="position-absolute top-50 start-50 translate-middle text-center w-100">
                            <div class="fw-black mb-0" style="font-size: 3.5rem; color: var(--slate-900); white-space: nowrap;"><?php echo round($percentage); ?>%</div>
                            <div class="small fw-bold text-uppercase tracking-wider <?php echo $passed ? 'text-success' : 'text-danger'; ?>">
                                <?php echo $passed ? 'PASSED' : 'FAILED'; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <?php if ($passed): ?>
                        <h2 class="fw-bold text-slate-900 mb-3">Excellent Job!</h2>
                        <p class="result-message-premium">You've mastered this topic with flying colors. Your performance shows a strong understanding of the material.</p>
                    <?php else: ?>
                        <h2 class="fw-bold text-slate-900 mb-3">Don't Give Up!</h2>
                        <p class="result-message-premium">Progress is a journey, not a destination. Review your answers and sharpen your knowledge for the next round!</p>
                    <?php endif; ?>
                </div>

                <div class="row text-center mb-5 g-4 px-md-3">
                    <div class="col-4">
                        <div class="result-stat-box">
                            <div class="icon-circle bg-primary bg-opacity-10 text-primary">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <h3 class="text-slate-900 mb-1 fw-black"><?php echo $attempt['score']; ?>/<?php echo $attempt['total_questions']; ?></h3>
                            <div class="text-muted text-uppercase small fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">Score</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="result-stat-box">
                            <div class="icon-circle bg-success bg-opacity-10 text-success">
                                <i class="fas fa-check"></i>
                            </div>
                            <h3 class="text-slate-900 mb-1 fw-black"><?php echo $attempt['correct_answers']; ?></h3>
                            <div class="text-muted text-uppercase small fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">Correct</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="result-stat-box">
                            <div class="icon-circle bg-danger bg-opacity-10 text-danger">
                                <i class="fas fa-times"></i>
                            </div>
                            <h3 class="text-slate-900 mb-1 fw-black"><?php echo $attempt['total_questions'] - $attempt['correct_answers']; ?></h3>
                            <div class="text-muted text-uppercase small fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">Wrong</div>
                        </div>
                    </div>
                </div>

                <div class="px-md-3">
                    <div class="d-grid gap-3 col-lg-12 mx-auto">
                        <a href="review.php?attempt_id=<?php echo $attempt_id; ?>" class="btn btn-primary rounded-pill shadow-premium py-3 hover-scale">
                            <span class="fw-bold">Explore Answer Review</span> <i class="fas fa-arrow-right ms-2 opacity-50"></i>
                        </a>

                        <div class="row g-3">
                            <div class="col-6">
                                <a href="quizzes.php" class="btn btn-outline-slate w-100 rounded-pill py-2 fw-bold text-decoration-none">
                                    <i class="fas fa-redo me-2 small"></i>New Challenge
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="dashboard.php" class="btn btn-outline-slate w-100 rounded-pill py-2 fw-bold text-decoration-none">
                                    <i class="fas fa-home me-2 small px-2"></i>Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-outline-slate {
        border-color: var(--slate-200);
        color: var(--slate-700);
    }

    .btn-outline-slate:hover {
        background-color: var(--indigo-50);
        border-color: var(--indigo-700);
        color: var(--indigo-700);
    }
</style>


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
            // since particles fall down, start a bit higher than random
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