<?php include_once '../controllers/reports-process.php'; ?>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
    <div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2">Performance <span class="text-primary-600">Report</span></h1>
        <p class="text-slate-500 text-sm mb-0">A detailed breakdown of your academic progress and quiz history.</p>
    </div>
    <div class="flex gap-2 w-full md:w-auto justify-end flex-shrink-0">
        <button onclick="downloadReport()" class="border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-5 py-2.5 rounded-full shadow-sm text-xs transition-all flex items-center focus:outline-none">
            <i class="fas fa-download mr-2"></i>Download Report
        </button>
        <a href="dashboard.php" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-5 py-2.5 rounded-full shadow-md text-xs transition-all focus:outline-none hover:scale-105 flex items-center">
            Dashboard
        </a>
    </div>
</div>

<div id="report-content">
    <?php if ($total_attempts > 0): ?>
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Attempts -->
            <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm relative overflow-hidden group">
                <div class="text-3xl font-extrabold text-slate-800 mb-0.5"><?php echo $total_attempts; ?></div>
                <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">Total Attempts</div>
                <div class="w-full bg-slate-100 h-1.5 rounded-full mt-3 overflow-hidden">
                    <div class="bg-primary-600 h-full rounded-full" style="width: 100%"></div>
                </div>
            </div>

            <!-- Pass Rate -->
            <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm relative overflow-hidden group">
                <div class="text-3xl font-extrabold text-emerald-500 mb-0.5"><?php echo $pass_rate; ?>%</div>
                <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">Pass Rate</div>
                <div class="w-full bg-slate-100 h-1.5 rounded-full mt-3 overflow-hidden">
                    <div class="bg-emerald-500 h-full rounded-full" style="width: <?php echo $pass_rate; ?>%"></div>
                </div>
            </div>

            <!-- Avg Score -->
            <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm relative overflow-hidden group">
                <div class="text-3xl font-extrabold text-sky-500 mb-0.5"><?php echo $avg_score; ?>%</div>
                <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">Average Score</div>
                <div class="w-full bg-slate-100 h-1.5 rounded-full mt-3 overflow-hidden">
                    <div class="bg-sky-500 h-full rounded-full" style="width: <?php echo $avg_score; ?>%"></div>
                </div>
            </div>

            <!-- XP Earned -->
            <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm relative overflow-hidden group">
                <div class="text-3xl font-extrabold text-amber-500 mb-0.5"><?php echo $total_attempts * 10; ?></div>
                <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">Total XP Earned</div>
                <div class="w-full bg-slate-100 h-1.5 rounded-full mt-3 overflow-hidden">
                    <div class="bg-amber-500 h-full rounded-full" style="width: 70%"></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Category Performance -->
            <div class="lg:col-span-7">
                <div class="bg-white border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm h-full">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-primary-50 text-primary-600 flex items-center justify-center rounded-xl text-lg mr-4 flex-shrink-0">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <h5 class="font-extrabold text-slate-900 text-base">Performance by Category</h5>
                    </div>

                    <div class="space-y-6">
                        <?php foreach ($category_stats as $cat): ?>
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-bold text-slate-800 text-sm"><?php echo sanitize($cat['category_name']); ?></span>
                                    <span class="text-slate-400 text-xs font-semibold"><?php echo $cat['attempts']; ?> Attempts • <?php echo round($cat['avg_pct']); ?>% Avg</span>
                                </div>
                                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                                    <?php
                                    $cat_pct = round($cat['avg_pct']);
                                    $bar_color = $cat_pct >= 75 ? 'bg-emerald-500' : ($cat_pct >= 50 ? 'bg-sky-500' : 'bg-rose-500');
                                    ?>
                                    <div class="h-full rounded-full <?php echo $bar_color; ?>" style="width: <?php echo $cat_pct; ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Success Distribution -->
            <div class="lg:col-span-5">
                <div class="bg-white border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm h-full flex flex-col">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-primary-50 text-primary-600 flex items-center justify-center rounded-xl text-lg mr-4 flex-shrink-0">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h5 class="font-extrabold text-slate-900 text-base">Score Distribution</h5>
                    </div>

                    <div class="flex-grow flex flex-col justify-center space-y-4">
                        <div class="flex items-center justify-between py-2 border-b border-slate-100">
                            <div class="flex items-center flex-grow">
                                <div class="w-3.5 h-3.5 rounded-full bg-emerald-500 shadow-md shadow-emerald-500/20 mr-3.5"></div>
                                <span class="font-bold text-slate-700 text-sm">Excellent (90%+)</span>
                            </div>
                            <div class="font-extrabold text-slate-900 text-sm"><?php echo $distribution['excellent'] ?? 0; ?></div>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-slate-100">
                            <div class="flex items-center flex-grow">
                                <div class="w-3.5 h-3.5 rounded-full bg-sky-500 shadow-md shadow-sky-500/20 mr-3.5"></div>
                                <span class="font-bold text-slate-700 text-sm">Good (75-89%)</span>
                            </div>
                            <div class="font-extrabold text-slate-900 text-sm"><?php echo $distribution['good'] ?? 0; ?></div>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-slate-100">
                            <div class="flex items-center flex-grow">
                                <div class="w-3.5 h-3.5 rounded-full bg-amber-500 shadow-md shadow-amber-500/20 mr-3.5"></div>
                                <span class="font-bold text-slate-700 text-sm">Average (50-74%)</span>
                            </div>
                            <div class="font-extrabold text-slate-900 text-sm"><?php echo $distribution['average'] ?? 0; ?></div>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-slate-100">
                            <div class="flex items-center flex-grow">
                                <div class="w-3.5 h-3.5 rounded-full bg-rose-500 shadow-md shadow-rose-500/20 mr-3.5"></div>
                                <span class="font-bold text-slate-700 text-sm">Poor (&lt; 50%)</span>
                            </div>
                            <div class="font-extrabold text-slate-900 text-sm"><?php echo $distribution['poor'] ?? 0; ?></div>
                        </div>
                    </div>

                    <div class="mt-6 p-4 rounded-2xl bg-slate-50 border border-slate-100 text-center">
                        <div class="text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Pass vs Fail Ratio</div>
                        <div class="text-2xl font-black text-slate-800"><?php echo $passed_count; ?> <span class="text-slate-200 mx-1.5">/</span> <?php echo $failed_count; ?></div>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <div class="bg-white border border-slate-200 p-10 rounded-3xl text-center shadow-sm max-w-md mx-auto my-8">
            <div class="w-20 h-20 rounded-full bg-slate-50 text-slate-300 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-chart-line text-3xl"></i>
            </div>
            <h3 class="font-extrabold text-slate-800 text-lg mb-2">No Data Available</h3>
            <p class="text-slate-400 text-xs leading-relaxed max-w-xs mx-auto">Complete at least one quiz to see your performance report.</p>
            <a href="quizzes.php" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3 rounded-full shadow-md text-sm transition-all hover:scale-105 mt-4">
                Take Your First Quiz
            </a>
        </div>
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
                <div style="flex: 1; text-align: center; border: 1px solid #111; padding: 15px; border-radius: 4px; background: #fafafa;">
                    <div style="font-size: 28px; color: #28a745; font-weight: bold;"><?php echo $pass_rate; ?>%</div>
                    <div style="font-size: 11px; color: #ce9c3a; text-transform: uppercase; letter-spacing: 1px; margin-top: 5px;">Success Rate</div>
                </div>
                <div style="flex: 1; text-align: center; border: 1px solid #111; padding: 15px; border-radius: 4px; background: #fafafa;">
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
                    <?php foreach ($detailed_history as $history): ?>
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
                <div style="font-family: 'Brush Script MT', cursive; font-size: 24px; color: #0e1e3b; border-bottom: 1px solid #333; height: 40px; margin-bottom: 10px; line-height: 50px;">Suraj Manani</div>
                <div style="font-size: 12px; color: #666; text-transform: uppercase;">Authorized Signature</div>
            </div>
        </div>

        <div style="margin-top: 30px; text-align: center; color: #ccc; font-size: 10px; font-family: sans-serif;">
            This document is a valid academic report generated by the Quizara LMS platform.
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
            margin: 0,
            filename: 'Quizara_Report_<?php echo $_SESSION['username']; ?>_<?php echo date('Y-m-d'); ?>.pdf',
            image: {
                type: 'jpeg',
                quality: 1.0
            },
            html2canvas: {
                scale: 2,
                useCORS: true,
                backgroundColor: '#ffffff',
                letterRendering: true
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
        };

        html2pdf().set(opt).from(element).save().then(() => {
            element.style.display = 'none';
        });
    }
</script>

<?php include_once '../includes/footer.php'; ?>