<?php include_once 'controllers/questions-process.php'; ?>

<!-- Navigation -->
<div class="flex justify-between items-center mb-6">
    <a href="questions.php?quiz_id=<?php echo $quiz_id; ?>" class="inline-flex items-center border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-5 py-2 rounded-full transition-all text-xs focus:outline-none shadow-sm">
        <i class="fas fa-arrow-left mr-2"></i>Back to Questions
    </a>
    <span class="bg-primary-50 text-primary-600 border border-primary-100/35 text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
        <?php echo sanitize($quiz['title']); ?>
    </span>
</div>

<div class="bg-white border border-slate-200 rounded-[32px] shadow-premium max-w-2xl mx-auto overflow-hidden">
    <div class="bg-primary-600 p-6 text-white">
        <h4 class="text-xl font-black mb-1 flex items-center"><i class="fas fa-plus-circle mr-2"></i> Add New Question</h4>
        <p class="text-primary-100 text-xs opacity-75">Define question text, choices and scoring points.</p>
    </div>

    <div class="p-6 md:p-10">
        <form action="" method="POST" class="space-y-6">
            <!-- Question Text -->
            <div>
                <label for="question_text" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Question Text</label>
                <div class="relative">
                    <textarea class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all resize-none min-h-[100px]" id="question_text" name="question_text" placeholder="Type your question here..."></textarea>
                    <div class="absolute top-3.5 left-4 text-slate-350 text-sm pointer-events-none"><i class="fas fa-quote-left"></i></div>
                </div>
            </div>

            <!-- Difficulty Level -->
            <div>
                <label for="difficulty_level" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Difficulty Level</label>
                <div class="flex shadow-sm rounded-lg overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all relative">
                    <select class="w-full pl-4 pr-10 py-2.5 text-sm bg-white focus:outline-none text-slate-800 cursor-pointer appearance-none" id="difficulty_level" name="difficulty_level">
                        <option value="low" selected>Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>
                    </select>
                    <i class="fas fa-chevron-down absolute right-4 top-3.5 text-slate-400 pointer-events-none text-xs"></i>
                </div>
            </div>

            <!-- Options & Correct Answer -->
            <div>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 mb-4">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-0">Answer Options</label>
                    <span class="bg-sky-50 text-sky-600 border border-sky-100 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider inline-flex items-center">
                        <i class="fas fa-check-circle mr-1.5"></i> Select default correct answer
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <div class="flex shadow-sm rounded-lg overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                            <div class="px-3 bg-slate-50 border-r border-slate-200 flex items-center">
                                <input class="w-4 h-4 text-primary-600 border-slate-300 focus:ring-primary-500 cursor-pointer" type="radio" name="correct_option" value="<?php echo $i; ?>" <?php echo $i === 1 ? 'checked' : ''; ?> aria-label="Correct answer">
                            </div>
                            <input type="text" class="flex-grow px-4 py-2.5 text-sm bg-white focus:outline-none text-slate-800" name="options[]" placeholder="Option <?php echo $i; ?>">
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Marks -->
            <div>
                <label for="marks" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Points</label>
                <div class="flex items-center space-x-2">
                    <button type="button" class="w-9 h-9 border border-slate-200 text-slate-505 hover:bg-slate-50 rounded-lg flex items-center justify-center transition-all focus:outline-none text-sm" onclick="this.nextElementSibling.stepDown()"><i class="fas fa-minus"></i></button>
                    <input type="number" class="w-16 h-9 bg-white border border-slate-200 rounded-lg text-center text-sm font-bold text-slate-800 focus:outline-none" id="marks" name="marks" value="1" min="1">
                    <button type="button" class="w-9 h-9 border border-slate-200 text-slate-505 hover:bg-slate-50 rounded-lg flex items-center justify-center transition-all focus:outline-none text-sm" onclick="this.previousElementSibling.stepUp()"><i class="fas fa-plus"></i></button>
                </div>
            </div>

            <!-- Actions -->
            <div class="pt-4">
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-xs flex items-center justify-center focus:outline-none">
                    <i class="fas fa-save mr-2 text-[10px]"></i>Save Question
                </button>
            </div>
        </form>
    </div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>