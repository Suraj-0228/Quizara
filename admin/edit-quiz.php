<?php include_once 'controllers/edit-quiz-process.php'; ?>

<!-- Navigation -->
<div class="mb-6">
    <a href="quizzes.php" class="inline-flex items-center border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-5 py-2 rounded-full transition-all text-sm focus:outline-none shadow-sm">
        <i class="fas fa-arrow-left mr-2"></i>Back to Quizzes
    </a>
</div>

<div class="bg-white border border-slate-200 rounded-[32px] shadow-premium max-w-2xl mx-auto overflow-hidden">
    <div class="bg-primary-600 p-6 text-white">
        <h4 class="text-xl font-black mb-1 flex items-center"><i class="fas fa-edit mr-2 text-amber-300"></i> Edit Quiz</h4>
        <p class="text-primary-100 text-sm opacity-75">Modify quiz configuration details below.</p>
    </div>

    <div class="p-6 md:p-10">
        <form action="" method="POST" class="space-y-6">
            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Quiz Title</label>
                <div class="flex shadow-sm rounded-lg overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                    <span class="px-3 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-heading"></i></span>
                    <input type="text" class="flex-grow px-4 py-2.5 text-sm bg-white focus:outline-none text-slate-800" id="title" name="title" value="<?php echo sanitize($quiz['title']); ?>">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Description</label>
                <textarea class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all resize-none" id="description" name="description" rows="3"><?php echo sanitize($quiz['description']); ?></textarea>
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Category</label>
                <div class="flex shadow-sm rounded-lg overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all relative">
                    <select class="w-full pl-4 pr-10 py-2.5 text-sm bg-white focus:outline-none text-slate-800 cursor-pointer appearance-none" id="category_id" name="category_id">
                        <option value="" disabled>Choose a category...</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>" <?php echo $cat['id'] == $quiz['category_id'] ? 'selected' : ''; ?>>
                                <?php echo sanitize($cat['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <i class="fas fa-chevron-down absolute right-4 top-3.5 text-slate-400 pointer-events-none text-sm"></i>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Time Limit -->
                <div>
                    <label for="time_limit" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Time Limit (Minutes)</label>
                    <div class="flex shadow-sm rounded-lg overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                        <span class="px-3 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-clock"></i></span>
                        <input type="number" class="flex-grow px-4 py-2.5 text-sm bg-white focus:outline-none text-slate-800" id="time_limit" name="time_limit" value="<?php echo $quiz['time_limit']; ?>" min="0">
                    </div>
                    <div class="text-slate-400 text-xs mt-1.5 font-semibold"><i class="fas fa-info-circle mr-1"></i> Set to 0 for no time limit.</div>
                </div>

                <!-- Passing Score -->
                <div>
                    <label for="passing_score" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Passing Score (%)</label>
                    <div class="flex shadow-sm rounded-lg overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                        <span class="px-3 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-percentage"></i></span>
                        <input type="number" class="flex-grow px-4 py-2.5 text-sm bg-white focus:outline-none text-slate-800" id="passing_score" name="passing_score" value="<?php echo $quiz['passing_score']; ?>" min="1" max="100">
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="pt-4">
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-sm flex items-center justify-center focus:outline-none">
                    <i class="fas fa-save mr-2 text-xs"></i>Update Quiz
                </button>
            </div>
        </form>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>