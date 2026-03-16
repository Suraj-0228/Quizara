<?php include_once '../controllers/dashboard-process.php'; ?>

<!-- Welcome Banner -->
<div class="student-hero-banner mb-5">
    <div class="hero-shape-1"></div>
    <div class="hero-shape-2"></div>
    <div class="hero-content container-fluid p-0">
        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="badge bg-white bg-opacity-20 text-primary mb-3 badge-premium border-0">
                    <i class="fas fa-sparkles me-2"></i> Dashboard Overview
                </span>
                <h1 class="display-4 fw-bold mb-2 text-white">Welcome back, <?php echo sanitize($_SESSION['username']); ?>!</h1>
                <p class="lead opacity-75 mb-0">You've completed <?php echo $total_attempts; ?> quizzes so far. Keep up the great work!</p>
            </div>
            <div class="col-md-4 text-md-end mt-4 mt-md-0">
                <div class="d-inline-block bg-white bg-opacity-10 p-3 rounded-4 backdrop-blur">
                    <div class="text-white-50 small mb-1">Today's Date</div>
                    <div class="h5 mb-0 fw-bold text-white"><?php echo date('l, M j'); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="premium-stat-card">
            <div class="icon-box text-warning bg-warning bg-opacity-10">
                <i class="fas fa-trophy"></i>
            </div>
            <div class="stat-value"><?php echo $total_attempts; ?></div>
            <div class="stat-label text-uppercase letter-spacing-1">Quizzes Completed</div>
            <div class="stat-decoration"><i class="fas fa-trophy text-warning"></i></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="premium-stat-card">
            <div class="icon-box text-info bg-info bg-opacity-10">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-value"><?php echo $avg_score; ?>%</div>
            <div class="stat-label text-uppercase letter-spacing-1">Average Accuracy</div>
            <div class="stat-decoration"><i class="fas fa-chart-line text-info"></i></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="premium-stat-card">
            <div class="icon-box text-primary bg-primary bg-opacity-10">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-value"><?php echo $total_attempts * 10; ?></div>
            <div class="stat-label text-uppercase letter-spacing-1">Total Experience (XP)</div>
            <div class="stat-decoration"><i class="fas fa-star text-primary"></i></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Activity -->
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <i class="fas fa-history me-2 text-primary"></i>Recent Activity
            </h4>
            <a href="history.php" class="btn btn-sm btn-outline-primary rounded-pill px-3 transition-all hover-scale">View All</a>
        </div>

        <?php if (count($recent_history) > 0): ?>
            <div class="activity-feed-premium">
                <?php foreach ($recent_history as $history): ?>
                    <?php
                    $score_pct = ($history['total_questions'] > 0) ? ($history['score'] / $history['total_questions']) : 0;
                    $is_passed = $score_pct >= 0.5;
                    $pct_value = round($score_pct * 100);
                    $status_color = $is_passed ? 'success' : 'danger';
                    ?>
                    <div class="activity-item-premium">
                        <div class="activity-icon bg-<?php echo $status_color; ?> bg-opacity-10 text-<?php echo $status_color; ?>">
                            <i class="fas <?php echo $is_passed ? 'fa-check-circle' : 'fa-times-circle'; ?>"></i>
                        </div>
                        <div class="activity-info">
                            <h6 class="mb-1 fw-bold"><?php echo sanitize($history['title']); ?></h6>
                            <div class="d-flex align-items-center text-muted small">
                                <span class="me-3"><i class="far fa-calendar-alt me-1"></i> <?php echo date('M d', strtotime($history['completed_at'])); ?></span>
                                <span><i class="far fa-clock me-1"></i> <?php echo date('h:i A', strtotime($history['completed_at'])); ?></span>
                            </div>
                        </div>
                        <div class="activity-score">
                            <div class="h5 mb-0 fw-bold text-<?php echo $status_color; ?>"><?php echo $pct_value; ?>%</div>
                            <a href="review.php?attempt_id=<?php echo $history['id']; ?>" class="small text-muted text-decoration-none hover-primary">
                                Details <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="card glass-card border-0 shadow-lg text-center py-5">
                <div class="card-body">
                    <div class="bg-slate-100 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-clipboard-list fa-3x text-muted opacity-50"></i>
                    </div>
                    <h4 class="fw-bold">No Recent Activity</h4>
                    <p class="text-muted mb-4">You haven't taken any quizzes yet. Start your journey now!</p>
                    <a href="quizzes.php" class="btn btn-primary rounded-pill px-4 shadow-sm hover-scale">
                        Browse Quizzes
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="action-card-premium mb-4">
            <div class="position-relative z-index-2">
                <i class="fas fa-rocket fa-2x text-primary mb-3"></i>
                <h4 class="fw-bold text-white mb-2">New Challenge?</h4>
                <p class="text-white-50 small mb-4">Level up your skills by taking a new quiz today.</p>
                <a href="quizzes.php" class="btn btn-light w-100 py-2">
                    Browse Library <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
            <div class="hero-shape-2" style="top: -20px; right: -20px; left: auto; opacity: 0.1;"></div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-4">Performance Insights</h6>

                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Overall Completion</span>
                        <span class="fw-bold small text-primary">75%</span>
                    </div>
                    <div class="progress progress-premium">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                    </div>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Accuracy Rate</span>
                        <span class="fw-bold small text-success"><?php echo $avg_score; ?>%</span>
                    </div>
                    <div class="progress progress-premium">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $avg_score; ?>%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once '../includes/footer.php'; ?>