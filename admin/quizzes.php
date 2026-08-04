<?php include_once 'controllers/manage-quiz.php'; ?>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
    <div>
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2">Manage Quizzes</h1>
        <p class="text-slate-500 text-sm md:text-base mb-0">Create, edit, and organize your quizzes.</p>
    </div>
    <div class="flex-shrink-0">
        <a href="add-quiz.php" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-6 py-3 rounded-full shadow-md text-sm transition-all focus:outline-none hover:scale-105 flex items-center">
            <i class="fas fa-plus mr-2 text-xs"></i>Add Quiz
        </a>
    </div>
</div>

<!-- Quizzes Table -->
<div class="bg-white border border-slate-200 rounded-3xl shadow-premium overflow-hidden mb-8">
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left text-sm text-slate-600 border-collapse">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider">Time</th>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider text-center">Questions</th>
                    <th class="px-6 py-3.5 text-sm font-bold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($quizzes) > 0): ?>
                    <?php foreach ($quizzes as $quiz): ?>
                        <tr class="border-b border-slate-100 last:border-0 hover:bg-slate-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-9 h-9 bg-primary-50 rounded-full flex items-center justify-center text-primary-600 mr-3 text-sm flex-shrink-0 border border-primary-100/30">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="font-bold text-slate-850 truncate max-w-[200px] md:max-w-xs"><?php echo sanitize($quiz['title']); ?></div>
                                        <div class="text-slate-400 text-sm mt-0.5 line-clamp-1 max-w-[200px] md:max-w-xs"><?php echo sanitize($quiz['description']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-sky-50 text-sky-600 border border-sky-100 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider inline-flex items-center">
                                    <?php echo sanitize($quiz['category_name']); ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($quiz['time_limit'] > 0): ?>
                                    <span class="text-amber-500 font-semibold text-sm flex items-center"><i class="fas fa-clock mr-1.5 text-xs"></i> <?php echo $quiz['time_limit']; ?>m</span>
                                <?php else: ?>
                                    <span class="text-emerald-500 font-semibold text-sm flex items-center"><i class="fas fa-infinity mr-1.5 text-xs"></i> No Limit</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-slate-100 text-slate-600 text-sm font-bold px-2.5 py-1 rounded-full">
                                    <?php echo $quiz['question_count']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-1.5">
                                    <a href="questions.php?quiz_id=<?php echo $quiz['id']; ?>" class="w-8 h-8 rounded-full flex items-center justify-center text-sky-500 hover:bg-sky-50 transition-all" title="Manage Questions">
                                        <i class="fas fa-list-ul"></i>
                                    </a>
                                    <a href="edit-quiz.php?id=<?php echo $quiz['id']; ?>" class="w-8 h-8 rounded-full flex items-center justify-center text-emerald-500 hover:bg-emerald-50 transition-all" title="Edit Quiz">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this quiz? This cannot be undone.');">
                                        <input type="hidden" name="quiz_id" value="<?php echo $quiz['id']; ?>">
                                        <button type="submit" name="delete_quiz" class="w-8 h-8 rounded-full flex items-center justify-center text-rose-500 hover:bg-rose-50 transition-all focus:outline-none" title="Delete Quiz">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-12">
                            <div class="mb-4">
                                <i class="fas fa-box-open text-slate-350 text-5xl"></i>
                            </div>
                            <h5 class="font-bold text-slate-800 text-base mb-1">No quizzes found</h5>
                            <p class="text-slate-400 text-sm">Get started by creating your first quiz.</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>