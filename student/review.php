<?php include_once '../controllers/review-process.php'; ?>

<!-- Header & Nav -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
    <div>
        <span class="bg-primary-50 text-primary-600 text-[10px] font-bold px-3.5 py-1.5 rounded-full mb-3 inline-block uppercase tracking-wider">Review Mode</span>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-0"><?php echo sanitize($attempt['title']); ?></h1>
    </div>
    <div class="flex gap-2 w-full md:w-auto justify-end flex-shrink-0">
        <?php if (isAdmin()): ?>
            <a href="../admin/student-details.php?id=<?php echo $attempt['user_id']; ?>" class="border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-5 py-2.5 rounded-full shadow-sm text-xs transition-all flex items-center focus:outline-none">
                <i class="fas fa-arrow-left mr-2"></i>Back to Student
            </a>
        <?php else: ?>
            <a href="results.php?attempt_id=<?php echo $attempt_id; ?>" class="border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-5 py-2.5 rounded-full shadow-sm text-xs transition-all flex items-center focus:outline-none">
                <i class="fas fa-poll mr-2"></i>Results
            </a>
            <a href="dashboard.php" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-5 py-2.5 rounded-full shadow-md text-xs transition-all focus:outline-none hover:scale-105 flex items-center">
                <i class="fas fa-home mr-2"></i>Dashboard
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- Summary Stats Grid -->
<?php
$percentage = ($attempt['total_questions'] > 0) ? ($attempt['score'] / $attempt['total_questions']) * 100 : 0;
$passed = $percentage >= $attempt['passing_score'];
?>
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
    <!-- Points -->
    <div class="bg-white border border-slate-200 p-5 rounded-2xl shadow-sm relative overflow-hidden group">
        <i class="fas fa-star text-primary-500 mb-2 block"></i>
        <div class="text-2xl font-extrabold text-slate-800 mb-0.5"><?php echo $attempt['score']; ?></div>
        <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Points Earned</div>
        <div class="w-full bg-slate-100 h-1 rounded-full mt-3 overflow-hidden">
            <div class="bg-primary-600 h-full rounded-full" style="width: 100%"></div>
        </div>
    </div>

    <!-- Accuracy -->
    <div class="bg-white border border-slate-200 p-5 rounded-2xl shadow-sm relative overflow-hidden group">
        <i class="fas fa-percentage <?php echo $passed ? 'text-emerald-500' : 'text-rose-500'; ?> mb-2 block"></i>
        <div class="text-2xl font-extrabold <?php echo $passed ? 'text-emerald-600' : 'text-rose-600'; ?> mb-0.5"><?php echo round($percentage); ?>%</div>
        <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Total Accuracy</div>
        <div class="w-full bg-slate-100 h-1 rounded-full mt-3 overflow-hidden">
            <div class="h-full rounded-full <?php echo $passed ? 'bg-emerald-500' : 'bg-rose-500'; ?>" style="width: <?php echo $percentage; ?>%"></div>
        </div>
    </div>

    <!-- Correct -->
    <div class="bg-white border border-slate-200 p-5 rounded-2xl shadow-sm relative overflow-hidden group">
        <i class="fas fa-check-circle text-emerald-500 mb-2 block"></i>
        <div class="text-2xl font-extrabold text-emerald-600 mb-0.5"><?php echo $attempt['correct_answers']; ?></div>
        <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Correct Solving</div>
        <div class="w-full bg-slate-100 h-1 rounded-full mt-3 overflow-hidden">
            <div class="bg-emerald-500 h-full rounded-full" style="width: 70%"></div>
        </div>
    </div>

    <!-- Wrong -->
    <div class="bg-white border border-slate-200 p-5 rounded-2xl shadow-sm relative overflow-hidden group">
        <i class="fas fa-history text-rose-500 mb-2 block"></i>
        <div class="text-2xl font-extrabold text-rose-600 mb-0.5"><?php echo $attempt['total_questions'] - $attempt['correct_answers']; ?></div>
        <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Incorrect Ones</div>
        <div class="w-full bg-slate-100 h-1 rounded-full mt-3 overflow-hidden">
            <div class="bg-rose-500 h-full rounded-full" style="width: 30%"></div>
        </div>
    </div>
</div>

<!-- Questions List -->
<div class="mb-8">
    <h4 class="font-extrabold text-slate-800 text-lg mb-6">Detailed Analysis</h4>
    <div class="space-y-6">
        <?php foreach ($questions as $index => $q): ?>
            <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden relative">
                <!-- Color bar highlight -->
                <div class="absolute left-0 top-0 bottom-0 w-1.5 <?php echo $q['user_is_correct'] ? 'bg-emerald-500' : 'bg-rose-500'; ?>"></div>
                
                <div class="p-6 md:p-8 pl-8 md:pl-10">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-4 mb-6">
                        <h5 class="font-extrabold text-slate-900 text-base md:text-lg flex items-start leading-normal">
                            <span class="bg-slate-100 text-slate-600 text-xs font-bold px-2.5 py-1 rounded-lg mr-3 select-none flex-shrink-0 font-sans">Q<?php echo $index + 1; ?>.</span>
                            <?php echo sanitize($q['question_text']); ?>
                        </h5>
                        <?php if ($q['user_is_correct']): ?>
                            <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider flex items-center flex-shrink-0">
                                <i class="fas fa-check-circle mr-1"></i> Correct
                            </span>
                        <?php else: ?>
                            <span class="bg-rose-50 text-rose-600 border border-rose-100 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider flex items-center flex-shrink-0">
                                <i class="fas fa-times-circle mr-1"></i> Incorrect
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 md:pl-10">
                        <!-- User Answer block -->
                        <div class="<?php echo $q['user_is_correct'] ? 'bg-emerald-50/30 border border-emerald-100/50 text-emerald-800' : 'bg-rose-50/30 border border-rose-100/50 text-rose-800'; ?> p-4 rounded-2xl">
                            <p class="text-[10px] font-bold uppercase tracking-wider mb-1.5 opacity-80">Your Answer</p>
                            <div class="font-bold text-slate-800 text-xs font-sans">
                                <?php if ($q['selected_option_id']): ?>
                                    <?php echo sanitize($q['user_answer_text']); ?>
                                <?php else: ?>
                                    <em class="text-slate-400 font-normal">No answer selected</em>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Correct Answer block (only shown if wrong) -->
                        <?php if (!$q['user_is_correct']): ?>
                            <div class="bg-primary-50/30 border border-primary-100/50 p-4 rounded-2xl">
                                <p class="text-primary-600 text-[10px] font-bold uppercase tracking-wider mb-1.5 opacity-85">Correct Answer</p>
                                <?php
                                $stmt_c = $pdo->prepare("SELECT option_text FROM options WHERE question_id = ? AND is_correct = 1");
                                $stmt_c->execute([$q['id']]);
                                $correct_opt = $stmt_c->fetch();
                                ?>
                                <div class="font-bold text-slate-800 text-xs flex items-center font-sans">
                                    <i class="fas fa-check-circle mr-1.5 text-emerald-500"></i>
                                    <?php echo $correct_opt ? sanitize($correct_opt['option_text']) : 'N/A'; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include_once '../includes/footer.php'; ?>