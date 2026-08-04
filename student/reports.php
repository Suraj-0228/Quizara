<?php include_once '../controllers/reports-process.php'; ?>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
    <div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2">Performance <span class="text-primary-600">Report</span></h1>
        <p class="text-slate-500 text-sm mb-0">A detailed breakdown of your academic progress and quiz history.</p>
    </div>
    <div class="flex gap-2 w-full md:w-auto justify-end flex-shrink-0">
        <a href="export-report.php" class="border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-5 py-2.5 rounded-full shadow-sm text-sm transition-all flex items-center focus:outline-none">
            <i class="fas fa-download mr-2"></i>Download Report
        </a>
        <a href="dashboard.php" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-5 py-2.5 rounded-full shadow-md text-sm transition-all focus:outline-none hover:scale-105 flex items-center">
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
                <div class="text-slate-400 text-sm font-bold uppercase tracking-wider">Total Attempts</div>
                <div class="w-full bg-slate-100 h-1.5 rounded-full mt-3 overflow-hidden">
                    <div class="bg-primary-600 h-full rounded-full" style="width: 100%"></div>
                </div>
            </div>

            <!-- Pass Rate -->
            <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm relative overflow-hidden group">
                <div class="text-3xl font-extrabold text-emerald-500 mb-0.5"><?php echo $pass_rate; ?>%</div>
                <div class="text-slate-400 text-sm font-bold uppercase tracking-wider">Pass Rate</div>
                <div class="w-full bg-slate-100 h-1.5 rounded-full mt-3 overflow-hidden">
                    <div class="bg-emerald-500 h-full rounded-full" style="width: <?php echo $pass_rate; ?>%"></div>
                </div>
            </div>

            <!-- Avg Score -->
            <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm relative overflow-hidden group">
                <div class="text-3xl font-extrabold text-sky-500 mb-0.5"><?php echo $avg_score; ?>%</div>
                <div class="text-slate-400 text-sm font-bold uppercase tracking-wider">Average Score</div>
                <div class="w-full bg-slate-100 h-1.5 rounded-full mt-3 overflow-hidden">
                    <div class="bg-sky-500 h-full rounded-full" style="width: <?php echo $avg_score; ?>%"></div>
                </div>
            </div>

            <!-- XP Earned -->
            <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm relative overflow-hidden group">
                <div class="text-3xl font-extrabold text-amber-500 mb-0.5"><?php echo $total_attempts * 10; ?></div>
                <div class="text-slate-400 text-sm font-bold uppercase tracking-wider">Total XP Earned</div>
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
                                    <span class="text-slate-400 text-sm font-semibold"><?php echo $cat['attempts']; ?> Attempts • <?php echo round($cat['avg_pct']); ?>% Avg</span>
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
                        <div class="text-slate-400 text-sm font-bold uppercase tracking-wider mb-2">Pass vs Fail Ratio</div>
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
            <p class="text-slate-400 text-sm leading-relaxed max-w-xs mx-auto">Complete at least one quiz to see your performance report.</p>
            <a href="quizzes.php" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3 rounded-full shadow-md text-sm transition-all hover:scale-105 mt-4">
                Take Your First Quiz
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- Offscreen Container (Rendered in normal DOM flow with zero height for instant 1:1 canvas capture) -->
<div id="pdf-report-wrapper" style="height: 0px; overflow: hidden; opacity: 0; position: relative; pointer-events: none;">
    <div id="report-table-view" style="width: 210mm; background-color: #ffffff; color: #1e293b; font-family: 'Segoe UI', Arial, sans-serif; box-sizing: border-box; overflow: hidden; margin: 0; padding: 0; border: none;">
        
        <!-- Top Modern Brand Header Bar (Palette 2: #25343F & #FF9B51) - Edge to Edge -->
        <div style="background-color: #25343F; color: #ffffff; padding: 30px 45px; position: relative; width: 100%; box-sizing: border-box; margin: 0;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center;">
                    <div style="font-size: 26px; font-weight: 900; letter-spacing: 2px; color: #ffffff; font-family: sans-serif;">
                        QUIZARA <span style="color: #FF9B51;">ACADEMICS</span>
                    </div>
                </div>
                <div style="text-align: right;">
                    <div style="color: #FF9B51; font-size: 11px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase;">Official Academic Transcript</div>
                    <div style="color: #94a3b8; font-size: 10px; margin-top: 2px;">Doc Ref: QZ-REP-<?php echo strtoupper(substr(md5($_SESSION['username'] . date('Y-m-d')), 0, 8)); ?></div>
                </div>
            </div>
            <!-- Accent Orange Bar -->
            <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 4px; background: #FF9B51;"></div>
        </div>

        <div style="padding: 35px 45px;">
            <!-- Student Info Header Card -->
            <div style="background: #F4F7F7; border: 1px solid #BFC9D1; border-radius: 16px; padding: 20px 25px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="color: #64748b; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 4px;">Student Credentials</div>
                    <h2 style="color: #25343F; font-size: 22px; font-weight: 800; margin: 0; line-height: 1.2;"><?php echo sanitize($_SESSION['username']); ?></h2>
                    <div style="color: #475569; font-size: 12px; font-weight: 600; margin-top: 3px;"><?php echo sanitize($_SESSION['email'] ?? 'Registered Scholar'); ?></div>
                </div>
                <div style="text-align: right; border-left: 2px solid #BFC9D1; padding-left: 25px;">
                    <div style="color: #64748b; font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 4px;">Date of Issue</div>
                    <div style="color: #25343F; font-size: 14px; font-weight: 800;"><?php echo date('F j, Y'); ?></div>
                    <div style="color: #FF9B51; font-size: 11px; font-weight: 700; margin-top: 2px;">Verified LMS Record</div>
                </div>
            </div>

            <!-- 4-Grid Summary Metric Cards -->
            <div style="margin-bottom: 35px;">
                <div style="color: #25343F; font-size: 13px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px; border-left: 4px solid #FF9B51; padding-left: 10px;">
                    Performance Highlights
                </div>
                <div style="display: flex; gap: 15px; justify-content: space-between;">
                    <!-- Stat 1 -->
                    <div style="flex: 1; border: 1px solid #BFC9D1; padding: 15px; border-radius: 14px; background: #ffffff; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        <div style="font-size: 26px; color: #25343F; font-weight: 900;"><?php echo $total_attempts; ?></div>
                        <div style="font-size: 10px; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px;">Total Quizzes</div>
                    </div>
                    <!-- Stat 2 -->
                    <div style="flex: 1; border: 1px solid #BFC9D1; padding: 15px; border-radius: 14px; background: #ffffff; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        <div style="font-size: 26px; color: #10b981; font-weight: 900;"><?php echo $pass_rate; ?>%</div>
                        <div style="font-size: 10px; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px;">Success Rate</div>
                    </div>
                    <!-- Stat 3 -->
                    <div style="flex: 1; border: 1px solid #BFC9D1; padding: 15px; border-radius: 14px; background: #ffffff; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        <div style="font-size: 26px; color: #0284c7; font-weight: 900;"><?php echo $avg_score; ?>%</div>
                        <div style="font-size: 10px; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px;">Average Accuracy</div>
                    </div>
                    <!-- Stat 4 -->
                    <div style="flex: 1; border: 1px solid #BFC9D1; padding: 15px; border-radius: 14px; background: #ffffff; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
                        <div style="font-size: 26px; color: #FF9B51; font-weight: 900;"><?php echo $total_attempts * 10; ?></div>
                        <div style="font-size: 10px; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px;">XP Credits</div>
                    </div>
                </div>
            </div>

            <!-- Detailed Assessment History Table -->
            <div style="margin-bottom: 35px;">
                <div style="color: #25343F; font-size: 13px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 15px; border-left: 4px solid #25343F; padding-left: 10px;">
                    Assessment History Log
                </div>
                <table style="width: 100%; border-collapse: collapse; border: 1px solid #BFC9D1; border-radius: 12px; overflow: hidden;">
                    <thead>
                        <tr style="background: #25343F; color: #ffffff;">
                            <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Assessment Title</th>
                            <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Score</th>
                            <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Accuracy</th>
                            <th style="padding: 12px 16px; text-align: center; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Status</th>
                            <th style="padding: 12px 16px; text-align: right; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; foreach ($detailed_history as $history): 
                            $i++;
                            $pct = ($history['total_questions'] > 0) ? ($history['score'] / $history['total_questions']) * 100 : 0;
                            $passed = $pct >= $history['passing_score'];
                            $rowBg = ($i % 2 == 0) ? '#F8FAFC' : '#ffffff';
                        ?>
                            <tr style="background: <?php echo $rowBg; ?>; border-bottom: 1px solid #E2E8F0;">
                                <td style="padding: 12px 16px; color: #1e293b; font-weight: 700; font-size: 12px;"><?php echo sanitize($history['title']); ?></td>
                                <td style="padding: 12px 16px; text-align: center; color: #475569; font-size: 12px; font-weight: 600;"><?php echo $history['score']; ?> / <?php echo $history['total_questions']; ?></td>
                                <td style="padding: 12px 16px; text-align: center; font-weight: 800; color: #25343F; font-size: 12px;"><?php echo round($pct); ?>%</td>
                                <td style="padding: 12px 16px; text-align: center;">
                                    <span style="display: inline-block; padding: 3px 12px; border-radius: 20px; font-size: 10px; font-weight: 800; letter-spacing: 0.5px; background: <?php echo $passed ? '#ecfdf5' : '#fff1f2'; ?>; color: <?php echo $passed ? '#059669' : '#e11d48'; ?>; border: 1px solid <?php echo $passed ? '#a7f3d0' : '#fecdd3'; ?>;">
                                        <?php echo $passed ? 'PASSED' : 'FAILED'; ?>
                                    </span>
                                </td>
                                <td style="padding: 12px 16px; text-align: right; color: #64748b; font-size: 11px; font-weight: 600;"><?php echo date('d M Y', strtotime($history['completed_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Signature & Seal Footer Section -->
            <div style="margin-top: 45px; display: flex; justify-content: space-between; align-items: flex-end; padding-top: 20px; border-top: 2px solid #E2E8F0;">
                <div style="text-align: center; width: 170px;">
                    <div style="border-bottom: 1.5px solid #25343F; height: 35px; margin-bottom: 8px;"></div>
                    <div style="font-size: 10px; color: #64748b; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Office of Academic Registrar</div>
                </div>

                <div style="text-align: center; width: 180px;">
                    <img src="<?php echo base_url('assets/images/Achievement%20Badge.png'); ?>" style="width: 110px; height: 110px; opacity: 0.95;" alt="Official Seal">
                </div>

                <div style="text-align: center; width: 170px;">
                    <div style="font-family: 'Georgia', serif; font-style: italic; font-size: 20px; color: #25343F; font-weight: bold; border-bottom: 1.5px solid #25343F; height: 35px; margin-bottom: 8px; line-height: 40px;">Suraj Manani</div>
                    <div style="font-size: 10px; color: #64748b; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Authorized Signatory</div>
                </div>
            </div>

            
        </div>
    </div>
</div>

<!-- html2pdf.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    function downloadReport() {
        const wrapper = document.getElementById('pdf-report-wrapper');
        const element = document.getElementById('report-table-view');
        if (!wrapper || !element) return;

        // Temporarily unhide wrapper in normal DOM flow for 100% accurate canvas capture
        wrapper.style.height = 'auto';
        wrapper.style.opacity = '1';
        wrapper.style.overflow = 'visible';

        const opt = {
            margin: 0,
            filename: 'Quizara_Report_<?php echo $_SESSION['username']; ?>_<?php echo date('Y-m-d'); ?>.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2,
                useCORS: true,
                allowTaint: true,
                backgroundColor: '#ffffff'
            },
            jsPDF: {
                unit: 'mm',
                format: 'a4',
                orientation: 'portrait'
            }
        };

        html2pdf().set(opt).from(element).save().then(() => {
            wrapper.style.height = '0px';
            wrapper.style.opacity = '0';
            wrapper.style.overflow = 'hidden';
        }).catch(err => {
            console.error('PDF error:', err);
            wrapper.style.height = '0px';
            wrapper.style.opacity = '0';
            wrapper.style.overflow = 'hidden';
        });
    }
</script>

<?php include_once '../includes/footer.php'; ?>