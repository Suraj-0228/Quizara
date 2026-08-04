<?php include_once 'controllers/que-process.php'; ?>

<div class="mb-8">
    <nav class="flex items-center space-x-2 text-slate-400 text-sm font-semibold mb-2">
        <a href="quizzes.php" class="hover:text-primary-600">Quizzes</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span>Manage Questions</span>
    </nav>
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h2 class="text-2xl md:text-3xl font-black text-slate-900 mb-1"><?php echo sanitize($quiz['title']); ?></h2>
            <p class="text-slate-500 text-sm font-semibold">Manage and organize the questions for this quiz.</p>
        </div>
        <div class="flex-shrink-0">
            <a href="add-question.php?quiz_id=<?php echo $quiz_id; ?>" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-6 py-3 rounded-full shadow-md text-sm transition-all focus:outline-none hover:scale-105 flex items-center">
                <i class="fas fa-plus mr-2 text-xs"></i>Add Question
            </a>
        </div>
    </div>
</div>

<div class="space-y-6">
    <?php if (count($questions) > 0): ?>
        <?php foreach ($questions as $index => $q): ?>
            <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm relative overflow-hidden">
                <!-- Question Header -->
                <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-4">
                    <div class="flex items-start min-w-0">
                        <div class="w-10 h-10 rounded-full bg-primary-50 border border-primary-100/30 flex items-center justify-center font-bold text-primary-600 mr-3 text-sm select-none flex-shrink-0">
                            Q<?php echo $index + 1; ?>
                        </div>
                        <div class="min-w-0">
                            <h5 class="font-extrabold text-slate-900 text-base mb-2 leading-normal"><?php echo sanitize($q['question_text']); ?></h5>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-slate-100 text-slate-500 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">
                                    Marks: <?php echo $q['marks']; ?>
                                </span>
                                <span class="bg-primary-50 text-primary-600 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider text-capitalize">
                                    <?php echo sanitize($q['difficulty_level'] ?? 'low'); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-1 ml-auto sm:ml-0 flex-shrink-0">
                        <a href="edit-question.php?id=<?php echo $q['id']; ?>&quiz_id=<?php echo $quiz_id; ?>" class="w-8 h-8 rounded-full flex items-center justify-center text-emerald-500 hover:bg-emerald-50 transition-all" title="Edit Question">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" class="inline" onsubmit="return confirm('Delete this question?');">
                            <input type="hidden" name="question_id" value="<?php echo $q['id']; ?>">
                            <button type="submit" name="delete_question" class="w-8 h-8 rounded-full flex items-center justify-center text-rose-500 hover:bg-rose-50 transition-all focus:outline-none" title="Delete Question">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Options Box -->
                <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl md:ml-13">
                    <?php
                    $opt_stmt = $pdo->prepare("SELECT * FROM options WHERE question_id = ?");
                    $opt_stmt->execute([$q['id']]);
                    $options = $opt_stmt->fetchAll();
                    ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <?php foreach ($options as $opt): ?>
                            <div class="flex items-center p-3 rounded-xl text-sm font-semibold <?php echo $opt['is_correct'] ? 'bg-emerald-50/50 border border-emerald-100/50 text-emerald-800' : 'bg-transparent text-slate-500'; ?>">
                                <?php if ($opt['is_correct']): ?>
                                    <i class="fas fa-check-circle mr-2.5 text-emerald-500 text-sm flex-shrink-0"></i>
                                <?php else: ?>
                                    <i class="far fa-circle mr-2.5 text-slate-300 text-sm flex-shrink-0"></i>
                                <?php endif; ?>
                                <span class="truncate"><?php echo sanitize($opt['option_text']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="bg-white border border-slate-200 p-10 rounded-3xl text-center shadow-sm max-w-md mx-auto my-8">
            <div class="w-20 h-20 rounded-full bg-slate-50 text-slate-300 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-clipboard-question text-3xl"></i>
            </div>
            <h4 class="font-extrabold text-slate-800 text-base mb-1">No Questions Yet</h4>
            <p class="text-slate-400 text-sm leading-relaxed max-w-xs mx-auto">This quiz is empty. Start adding questions to build it.</p>
            <a href="add-question.php?quiz_id=<?php echo $quiz_id; ?>" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3 rounded-full shadow-md text-sm transition-all hover:scale-105 mt-4">
                <i class="fas fa-plus mr-2"></i>Add First Question
            </a>
        </div>
    <?php endif; ?>
</div>

<?php include_once '../includes/admin-footer.php'; ?>