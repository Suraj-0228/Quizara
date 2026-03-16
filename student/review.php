<?php include_once '../controllers/review-process.php'; ?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Header & Nav -->
        <div class="mb-5 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
            <div>
                <span class="badge bg-indigo-50 text-indigo-700 px-3 py-2 rounded-pill small fw-bold mb-2">REVIEW MODE</span>
                <h1 class="fw-extrabold text-slate-900 mb-0"><?php echo sanitize($attempt['title']); ?></h1>
            </div>
            <div class="d-flex gap-2">
                <?php if (isAdmin()): ?>
                    <a href="../admin/student-details.php?id=<?php echo $attempt['user_id']; ?>" class="btn btn-premium-nav rounded-pill px-4">
                        <i class="fas fa-arrow-left me-2"></i>Back to Student
                    </a>
                <?php else: ?>
                    <a href="results.php?attempt_id=<?php echo $attempt_id; ?>" class="btn btn-premium-nav rounded-pill px-4">
                        <i class="fas fa-poll me-2"></i>Results
                    </a>
                    <a href="dashboard.php" class="btn btn-indigo border border-1 rounded-pill px-4 shadow-premium">
                        <i class="fas fa-home me-2"></i>Dashboard
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Summary Stats Grid -->
        <?php
        $percentage = ($attempt['total_questions'] > 0) ? ($attempt['score'] / $attempt['total_questions']) * 100 : 0;
        $passed = $percentage >= $attempt['passing_score'];
        ?>
        <div class="row g-4 mb-5">
            <div class="col-6 col-md-3">
                <div class="report-summary-card">
                    <i class="fas fa-star text-primary"></i>
                    <div class="val"><?php echo $attempt['score']; ?></div>
                    <div class="label">Points Earned</div>
                    <div class="report-progress-bottom">
                        <div class="bar bg-primary" style="width: 100%"></div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="report-summary-card">
                    <i class="fas fa-percentage text-<?php echo $passed ? 'success' : 'danger'; ?>"></i>
                    <div class="val <?php echo $passed ? 'text-success' : 'text-danger'; ?>"><?php echo round($percentage); ?>%</div>
                    <div class="label">Total Accuracy</div>
                    <div class="report-progress-bottom">
                        <div class="bar <?php echo $passed ? 'bg-success' : 'bg-danger'; ?>" style="width: <?php echo $percentage; ?>%"></div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="report-summary-card">
                    <i class="fas fa-check-circle text-success"></i>
                    <div class="val text-success"><?php echo $attempt['correct_answers']; ?></div>
                    <div class="label">Correct Solving</div>
                    <div class="report-progress-bottom">
                        <div class="bar bg-success" style="width: 70%"></div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="report-summary-card">
                    <i class="fas fa-history text-danger"></i>
                    <div class="val text-danger"><?php echo $attempt['total_questions'] - $attempt['correct_answers']; ?></div>
                    <div class="label">Incorrect Ones</div>
                    <div class="report-progress-bottom">
                        <div class="bar bg-danger" style="width: 30%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Questions List -->
        <div class="mb-4">
            <h4 class="fw-bold text-slate-800 mb-4 px-1">Detailed Analysis</h4>
            <?php foreach ($questions as $index => $q): ?>
                <div class="results-card-premium review-card-premium card-texture-subtle mb-4">
                    <div class="review-status-bar <?php echo $q['user_is_correct'] ? 'bg-check-gradient' : 'bg-cross-gradient'; ?>"></div>
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-3 mb-4">
                            <h5 class="fw-bold text-slate-900 lh-base mb-0">
                                <span class="badge bg-slate-100 text-dark fw-bold me-2 rounded-3 px-3">Q<?php echo $index + 1; ?>.</span>
                                <?php echo sanitize($q['question_text']); ?>
                            </h5>
                            <?php if ($q['user_is_correct']): ?>
                                <span class="badge bg-success-subtle text-success review-badge rounded-pill">
                                    <i class="fas fa-check-circle me-1"></i> Correct
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger-subtle text-danger review-badge rounded-pill">
                                    <i class="fas fa-times-circle me-1"></i> Incorrect
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="row g-4 ps-md-5 ms-md-2">
                            <div class="col-md-6">
                                <div class="answer-block <?php echo $q['user_is_correct'] ? 'answer-block-correct' : 'answer-block-incorrect'; ?>">
                                    <p class="mb-2 small fw-bold text-uppercase tracking-wider opacity-75">Your Answer</p>
                                    <div class="fw-bold fs-5">
                                        <?php if ($q['selected_option_id']): ?>
                                            <?php echo sanitize($q['user_answer_text']); ?>
                                        <?php else: ?>
                                            <em class="opacity-75">No answer selected</em>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <?php if (!$q['user_is_correct']): ?>
                                <div class="col-md-6">
                                    <div class="answer-block answer-block-info">
                                        <p class="mb-2 small fw-bold text-uppercase tracking-wider opacity-75">Correct Answer</p>
                                        <?php
                                        $stmt_c = $pdo->prepare("SELECT option_text FROM options WHERE question_id = ? AND is_correct = 1");
                                        $stmt_c->execute([$q['id']]);
                                        $correct_opt = $stmt_c->fetch();
                                        ?>
                                        <div class="fw-bold fs-5">
                                            <i class="fas fa-check-circle me-1"></i>
                                            <?php echo $correct_opt ? sanitize($correct_opt['option_text']) : 'N/A'; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>


<?php include_once '../includes/footer.php'; ?>