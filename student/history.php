<?php include_once '../controllers/history-process.php'; ?>

<!-- History Header -->
<div class="history-hero-banner mb-5">
    <div class="hero-shape" style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
    <div class="container-fluid p-0">
        <div class="row align-items-center">
            <div class="col-md-7">
                <span class="badge bg-white bg-opacity-20 text-dark mb-3 badge-premium border-0">
                    <i class="fas fa-clock-rotate-left me-2"></i> Progress Tracker
                </span>
                <h1 class="display-5 fw-bold mb-2 text-white">Learning <span class="text-info">Timeline</span></h1>
                <p class="lead text-white-50 mb-0">A detailed journey of your achievements and challenges.</p>
            </div>
            <div class="col-md-5 text-md-end mt-4 mt-md-0">
                <div class="d-flex gap-2 justify-content-md-end">
                    <a href="reports.php" class="btn btn-light rounded-pill px-4 shadow-sm">
                        <i class="fas fa-chart-pie me-2 text-primary"></i>Analytics
                    </a>
                    <a href="quizzes.php" class="btn btn-primary rounded-pill px-4 shadow-sm border-white border-opacity-25">
                        <i class="fas fa-plus me-2"></i>New Quiz
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 px-lg-5">
        <?php if (count($history) > 0): ?>
            <div class="premium-timeline">
                <?php foreach ($history as $item): ?>
                    <?php
                    $percentage = ($item['total_questions'] > 0) ? ($item['score'] / $item['total_questions']) * 100 : 0;
                    $passed = $percentage >= $item['passing_score'];
                    $statusClass = $passed ? 'success' : 'fail';
                    ?>

                    <div class="premium-timeline-item <?php echo $statusClass; ?>">
                        <div class="history-date-box">
                            <div class="fw-bold text-dark mb-0"><?php echo date('M d, Y', strtotime($item['completed_at'])); ?></div>
                            <small class="text-muted"><?php echo date('h:i A', strtotime($item['completed_at'])); ?></small>
                        </div>

                        <div class="timeline-marker"></div>

                        <div class="timeline-content-card">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-3">
                                        <?php if ($passed): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-1 me-3">
                                                <i class="fas fa-check-circle me-1"></i> Passed
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 rounded-pill px-3 py-1 me-3">
                                                <i class="fas fa-times-circle me-1"></i> Failed
                                            </span>
                                        <?php endif; ?>
                                        <div class="text-muted small">
                                            <i class="fas fa-bullseye me-1"></i> Target: <?php echo $item['passing_score']; ?>%
                                        </div>
                                    </div>

                                    <h4 class="fw-bold mb-2 text-slate-900"><?php echo sanitize($item['title']); ?></h4>

                                    <!-- Mobile Date (visible only on small screens) -->
                                    <div class="d-md-none text-muted small mb-3">
                                        <i class="far fa-calendar-alt me-1"></i> <?php echo date('M d, Y • h:i A', strtotime($item['completed_at'])); ?>
                                    </div>

                                    <div class="d-flex align-items-center gap-3 mt-3">
                                        <div class="progress progress-premium flex-grow-1" style="height: 8px; max-width: 200px;">
                                            <div class="progress-bar <?php echo $passed ? 'bg-success' : 'bg-danger'; ?>" role="progressbar" style="width: <?php echo $percentage; ?>%"></div>
                                        </div>
                                        <span class="fw-bold <?php echo $passed ? 'text-success' : 'text-danger'; ?>">
                                            <?php echo round($percentage); ?>% Accuracy
                                        </span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 align-items-center">
                                    <?php if ($percentage >= 75): ?>
                                        <a href="download-certificate.php?attempt_id=<?php echo $item['id']; ?>" class="btn btn-outline-warning rounded-circle" style="width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;" title="Achievement Certificate" target="_blank">
                                            <i class="fas fa-award"></i>
                                        </a>
                                    <?php endif; ?>

                                    <a href="results.php?attempt_id=<?php echo $item['id']; ?>" class="btn btn-outline-primary rounded-pill px-3" title="View Detailed Analysis">
                                        <i class="fas fa-chart-bar me-1"></i> Stats
                                    </a>
                                    <a href="review.php?attempt_id=<?php echo $item['id']; ?>" class="btn btn-primary rounded-pill px-4 shadow-sm">
                                        Review <i class="fas fa-chevron-right ms-1 small"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="card border-0 shadow-lg rounded-4 text-center py-5 px-4 mt-5">
                <div class="card-body">
                    <div class="bg-slate-50 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 100px; height: 100px;">
                        <i class="fas fa-clock-rotate-left fa-4x text-muted opacity-25"></i>
                    </div>
                    <h3 class="fw-bold mb-3">No Journey Logged Yet</h3>
                    <p class="text-muted mb-4 mx-auto" style="max-width: 400px;">Your learning timeline is waiting for its first record. Start a challenge and begin building your history today!</p>
                    <a href="quizzes.php" class="btn btn-primary rounded-pill px-5 py-3 shadow-premium hover-scale">
                        <i class="fas fa-rocket me-2"></i>Start Your First Quiz
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>



<?php include_once '../includes/footer.php'; ?>