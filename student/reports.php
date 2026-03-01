<?php include_once '../controllers/reports-process.php'; ?>

<div class="row mb-5">
    <div class="col-md-8">
        <h1 class="display-5 fw-bold text-light">Performance <span class="text-gradient">Report</span></h1>
        <p class="text-muted">A detailed breakdown of your academic progress and quiz history.</p>
    </div>
    <div class="col-md-4 text-md-end">
        <button onclick="downloadReport()" class="btn btn-outline-light rounded-pill px-4 me-2">
            <i class="fas fa-download me-2"></i>Download Report
        </button>
        <a href="dashboard.php" class="btn btn-primary rounded-pill px-4">
            Dashboard
        </a>
    </div>
</div>

<div id="report-content">

<?php if ($total_attempts > 0): ?>
    <!-- Summary Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="report-stat-card glass-card">
                <div class="val"><?php echo $total_attempts; ?></div>
                <div class="label">Total Attempts</div>
                <div class="progress mt-3 bg-dark" style="height: 4px;">
                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="report-stat-card glass-card">
                <div class="val text-success"><?php echo $pass_rate; ?>%</div>
                <div class="label">Pass Rate</div>
                <div class="progress mt-3 bg-dark" style="height: 4px;">
                    <div class="progress-bar bg-success" style="width: <?php echo $pass_rate; ?>%"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="report-stat-card glass-card">
                <div class="val text-info"><?php echo $avg_score; ?>%</div>
                <div class="label">Average Score</div>
                <div class="progress mt-3 bg-dark" style="height: 4px;">
                    <div class="progress-bar bg-info" style="width: <?php echo $avg_score; ?>%"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="report-stat-card glass-card">
                <div class="val text-warning"><?php echo $total_attempts * 10; ?></div>
                <div class="label">Total XP Earned</div>
                <div class="progress mt-3 bg-dark" style="height: 4px;">
                    <div class="progress-bar bg-warning" style="width: 60%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Category Performance -->
        <div class="col-lg-7">
            <div class="card glass-card border-0 h-100">
                <div class="card-header bg-transparent border-secondary border-opacity-10 py-3">
                    <h5 class="text-light mb-0"><i class="fas fa-th-large me-2 text-primary"></i>Performance by Category</h5>
                </div>
                <div class="card-body p-4">
                    <?php foreach($category_stats as $cat): ?>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-light fw-medium"><?php echo sanitize($cat['category_name']); ?></span>
                                <span class="text-muted small"><?php echo $cat['attempts']; ?> Attempts • <?php echo round($cat['avg_pct']); ?>% Avg</span>
                            </div>
                            <div class="progress bg-dark-glass" style="height: 10px; border-radius: 10px;">
                                <?php 
                                    $cat_pct = round($cat['avg_pct']);
                                    $bar_color = $cat_pct >= 75 ? 'bg-success' : ($cat_pct >= 50 ? 'bg-info' : 'bg-danger');
                                ?>
                                <div class="progress-bar <?php echo $bar_color; ?> rounded-pill" role="progressbar" style="width: <?php echo $cat_pct; ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Success Distribution -->
        <div class="col-lg-5">
            <div class="card glass-card border-0 h-100">
                <div class="card-header bg-transparent border-secondary border-opacity-10 py-3">
                    <h5 class="text-light mb-0"><i class="fas fa-chart-pie me-2 text-primary"></i>Score Distribution</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-center">
                    <div class="dist-item d-flex align-items-center mb-3">
                        <div class="dist-circle bg-success shadow-success"></div>
                        <div class="flex-grow-1 ms-3 text-light">Excellent (90%+)</div>
                        <div class="fw-bold text-light"><?php echo $distribution['excellent'] ?? 0; ?></div>
                    </div>
                    <div class="dist-item d-flex align-items-center mb-3">
                        <div class="dist-circle bg-info shadow-info"></div>
                        <div class="flex-grow-1 ms-3 text-light">Good (75-89%)</div>
                        <div class="fw-bold text-light"><?php echo $distribution['good'] ?? 0; ?></div>
                    </div>
                    <div class="dist-item d-flex align-items-center mb-3">
                        <div class="dist-circle bg-warning shadow-warning"></div>
                        <div class="flex-grow-1 ms-3 text-light">Average (50-74%)</div>
                        <div class="fw-bold text-light"><?php echo $distribution['average'] ?? 0; ?></div>
                    </div>
                    <div class="dist-item d-flex align-items-center">
                        <div class="dist-circle bg-danger shadow-danger"></div>
                        <div class="flex-grow-1 ms-3 text-light">Poor (< 50%)</div>
                        <div class="fw-bold text-light"><?php echo $distribution['poor'] ?? 0; ?></div>
                    </div>
                    
                    <div class="mt-4 p-3 rounded-4 bg-dark bg-opacity-25 border border-white border-opacity-5 text-center">
                        <div class="text-muted small mb-1">Pass vs Fail Ratio</div>
                        <div class="h4 text-light fw-bold mb-0"><?php echo $passed_count; ?> <span class="text-muted">/</span> <?php echo $failed_count; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else: ?>
    <div class="glass-card text-center py-5 my-5">
        <div class="bg-dark-glass d-inline-block p-4 rounded-circle mb-3">
            <i class="fas fa-chart-line fa-4x text-muted opacity-25"></i>
        </div>
        <h3 class="text-light">No Data Available</h3>
        <p class="text-muted">Complete at least one quiz to see your performance report.</p>
        <a href="quizzes.php" class="btn btn-gradient-primary rounded-pill px-5 mt-3 shadow">
            Take Your First Quiz
<?php endif; ?>
</div>

<!-- Hidden Table View for PDF Download -->
<div id="report-table-view" style="display: none; background: #fff; color: #1a1a1a; padding: 0; font-family: 'Times New Roman', Times, serif; width: 210mm; height: 296mm; position: relative; box-sizing: border-box; overflow: hidden;">
    <!-- Decorative Border with Margins -->
    <div style="position: absolute; top: 30px; left: 30px; right: 30px; bottom: 30px; border: 2px solid #ce9c3a; pointer-events: none;"></div>
    <div style="position: absolute; top: 35px; left: 35px; right: 35px; bottom: 35px; border: 1px solid #0e1e3b; pointer-events: none;"></div>

    <div style="padding: 20px 80px;">
        <!-- Header Section -->
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="color: #ce9c3a; font-size: 14px; letter-spacing: 4px; text-transform: uppercase; margin-bottom: 10px; margin-top: 40px;">Official Academic Record</div>
            <h1 style="color: #0e1e3b; font-size: 42px; margin: 0; font-weight: normal; text-transform: uppercase;">Student <span style="color: #ce9c3a;">Report</span></h1>
            <div style="width: 100px; height: 2px; background: #ce9c3a; margin: 15px auto;"></div>
            <p style="color: #666; font-size: 16px; font-style: italic;">Presented to: <span style="color: #0e1e3b; font-weight: bold; font-style: normal;"><?php echo sanitize($_SESSION['username']); ?></span></p>
            <p style="color: #888; font-size: 12px;">Issued on: <?php echo date('F j, Y'); ?></p>
        </div>

        <!-- Performance summary with horizontal flex boxes -->
        <div style="margin-bottom: 35px;">
            <h3 style="color: #0e1e3b; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 25px; font-size: 18px; text-transform: uppercase; letter-spacing: 2px;">Overall Achievement</h3>
            <div style="display: flex; gap: 15px; justify-content: space-between;">
                <div style="flex: 1; text-align: center; border: 1px solid #111; padding: 15px; border-radius: 4px; background: #fafafa;">
                    <div style="font-size: 28px; color: #0e1e3b; font-weight: bold;"><?php echo $total_attempts; ?></div>
                    <div style="font-size: 11px; color: #ce9c3a; text-transform: uppercase; letter-spacing: 1px; margin-top: 5px;">Quizzes Taken</div>
                </div>
                <div style="text-align: center; border: 1px solid #111; padding: 20px; border-radius: 4px; background: #fafafa;">
                    <div style="font-size: 28px; color: #28a745; font-weight: bold;"><?php echo $pass_rate; ?>%</div>
                    <div style="font-size: 11px; color: #ce9c3a; text-transform: uppercase; letter-spacing: 1px; margin-top: 5px;">Success Rate</div>
                </div>
                <div style="text-align: center; border: 1px solid #111; padding: 20px; border-radius: 4px; background: #fafafa;">
                    <div style="font-size: 28px; color: #007bff; font-weight: bold;"><?php echo $avg_score; ?>%</div>
                    <div style="font-size: 11px; color: #ce9c3a; text-transform: uppercase; letter-spacing: 1px; margin-top: 5px;">Average Score</div>
                </div>
                <div style="flex: 1; text-align: center; border: 1px solid #111; padding: 15px; border-radius: 4px; background: #fafafa;">
                    <div style="font-size: 28px; color: #ffc107; font-weight: bold;"><?php echo $total_attempts * 10; ?></div>
                    <div style="font-size: 11px; color: #ce9c3a; text-transform: uppercase; letter-spacing: 1px; margin-top: 5px;">Total Credits</div>
                </div>
            </div>
        </div>

        <!-- History Table -->
        <div>
            <h3 style="color: #0e1e3b; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px; font-size: 18px; text-transform: uppercase; letter-spacing: 2px;">Detailed Performance Log</h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr style="border-bottom: 2px solid #0e1e3b;">
                        <th style="padding: 12px 5px; text-align: left; color: #0e1e3b; font-size: 13px; text-transform: uppercase;">Assessment</th>
                        <th style="padding: 12px 5px; text-align: center; color: #0e1e3b; font-size: 13px; text-transform: uppercase;">Score</th>
                        <th style="padding: 12px 5px; text-align: center; color: #0e1e3b; font-size: 13px; text-transform: uppercase;">Accuracy</th>
                        <th style="padding: 12px 5px; text-align: center; color: #0e1e3b; font-size: 13px; text-transform: uppercase;">Status</th>
                        <th style="padding: 12px 5px; text-align: right; color: #0e1e3b; font-size: 13px; text-transform: uppercase;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($detailed_history as $history): ?>
                        <?php 
                            $pct = ($history['total_questions'] > 0) ? ($history['score'] / $history['total_questions']) * 100 : 0;
                            $passed = $pct >= $history['passing_score'];
                        ?>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 10px 5px; color: #333; font-weight: bold;"><?php echo sanitize($history['title']); ?></td>
                            <td style="padding: 10px 5px; text-align: center; color: #666;"><?php echo $history['score']; ?> / <?php echo $history['total_questions']; ?></td>
                            <td style="padding: 10px 5px; text-align: center; font-weight: bold; color: #0e1e3b;"><?php echo round($pct); ?>%</td>
                            <td style="padding: 10px 5px; text-align: center;">
                                <div style="display: inline-block; padding: 3px 10px; color: <?php echo $passed ? '#28a745' : '#dc3545'; ?>; border: 1px solid <?php echo $passed ? '#28a745' : '#dc3545'; ?>; font-size: 10px; font-weight: bold;">
                                    <?php echo $passed ? 'PASS' : 'FAIL'; ?>
                                </div>
                            </td>
                            <td style="padding: 10px 5px; text-align: right; color: #999; font-size: 12px;"><?php echo date('d M Y', strtotime($history['completed_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Signature Section -->
        <div style="margin-top: 40px; display: flex; justify-content: space-between; align-items: flex-end;">
            <div style="text-align: center; width: 180px;">
                <div style="border-bottom: 1px solid #333; height: 40px; margin-bottom: 10px;"></div>
                <div style="font-size: 12px; color: #666; text-transform: uppercase;">Office of Admissions</div>
            </div>
            <div style="text-align: center; width: 280px;">
                <img src="<?php echo base_url('assets/images/Achievement Badge.png'); ?>" style="width: 16rem; opacity: 1;" alt="Seal">
            </div>
            <div style="text-align: center; width: 180px;">
                <div style="font-family: 'Brush Script MT', cursive; font-size: 24px; color: #0e1e3b; border-bottom: 1px solid #333; height: 40px; margin-bottom: 10px; line-height: 50px;">QuizMaster</div>
                <div style="font-size: 12px; color: #666; text-transform: uppercase;">Authorized Signature</div>
            </div>
        </div>

        <div style="margin-top: 30px; text-align: center; color: #ccc; font-size: 10px; font-family: sans-serif;">
            This document is a valid academic report generated by the QuizMaster LMS platform. 
            Verification ID: <?php echo strtoupper(bin2hex(random_bytes(4))); ?>
        </div>
    </div>
</div>

<!-- html2pdf.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
function downloadReport() {
    const element = document.getElementById('report-table-view');
    // Temporarily show the element for high-quality capture
    element.style.display = 'block';
    
    const opt = {
        margin:       0,
        filename:     'QuizMaster_Report_<?php echo $_SESSION['username']; ?>_<?php echo date('Y-m-d'); ?>.pdf',
        image:        { type: 'jpeg', quality: 1.0 },
        html2canvas:  { 
            scale: 2, 
            useCORS: true,
            backgroundColor: '#ffffff',
            letterRendering: true
        },
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save().then(() => {
        element.style.display = 'none';
    });
}
</script>

<style>
/* PDF Specific Adjustments */
#report-content {
    background-color: var(--dark-bg);
}
.report-stat-card {
    padding: 2rem;
    text-align: center;
    transition: transform 0.3s ease;
}
.report-stat-card:hover {
    transform: translateY(-5px);
}
.report-stat-card .val {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 0.5rem;
}
.report-stat-card .label {
    color: var(--muted-text);
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 0.8rem;
    font-weight: 600;
}
.dist-circle {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}
.shadow-success { box-shadow: 0 0 10px rgba(16, 185, 129, 0.4); }
.shadow-info { box-shadow: 0 0 10px rgba(59, 130, 246, 0.4); }
.shadow-warning { box-shadow: 0 0 10px rgba(245, 158, 11, 0.4); }
.shadow-danger { box-shadow: 0 0 10px rgba(239, 68, 68, 0.4); }

@media print {
    body { background-color: white !important; color: black !important; }
    .glass-card { background: white !important; border: 1px solid #ddd !important; box-shadow: none !important; }
    .text-light, .text-muted, .text-gradient { color: black !important; -webkit-text-fill-color: black !important; }
    .btn, .navbar, .admin-sidebar { display: none !important; }
    .admin-main-content { margin-left: 0 !important; width: 100% !important; }
    .progress { border: 1px solid #000 !important; }
}
</style>

<?php include_once '../includes/footer.php'; ?>
