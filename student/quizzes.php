<?php include_once '../controllers/quizzes-process.php'; ?>

<!-- Header Section -->
<div class="relative rounded-[32px] bg-primary-600 p-8 md:p-10 overflow-hidden mb-8 shadow-md">
    <!-- Decorative shapes -->
    <div class="absolute -top-16 -right-16 w-36 h-36 rounded-full bg-primary-500 opacity-20"></div>
    <div class="absolute -bottom-16 -left-16 w-48 h-48 rounded-full bg-primary-700 opacity-30"></div>

    <div class="relative z-1 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">
        <div>
            <span class="inline-flex items-center bg-white/20 text-white border-0 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-3">
                <i class="fas fa-search mr-2 text-xs"></i> Quiz Library
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2">Available <span class="text-primary-250 opacity-90">Quizzes</span></h1>
            <p class="text-white/80 text-sm mb-0">Choose a topic and challenge yourself today.</p>
        </div>
        <div class="w-full lg:w-auto">
            <form action="quizzes.php" method="GET" id="filterForm" class="flex flex-col sm:flex-row gap-3 w-full">
                <!-- Search input -->
                <div class="relative w-full sm:w-64">
                    <i class="fas fa-search absolute left-4 top-3.5 text-slate-400"></i>
                    <input type="text" name="search" class="w-full pl-10 pr-4 py-2.5 rounded-full border-0 focus:outline-none focus:ring-2 focus:ring-primary-500/20 text-slate-800 text-sm bg-white shadow-sm" placeholder="Search for quizzes..." value="<?php echo htmlspecialchars($searchQuery ?? ''); ?>">
                </div>
                <!-- Category select -->
                <div class="relative w-full sm:w-48">
                    <select name="category" class="w-full pl-4 pr-10 py-2.5 rounded-full border-0 focus:outline-none focus:ring-2 focus:ring-primary-500/20 text-slate-800 text-sm bg-white shadow-sm cursor-pointer appearance-none" onchange="document.getElementById('filterForm').submit();">
                        <option value="">All Categories</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo sanitize($category['name']); ?>" <?php echo (isset($categoryFilter) && $categoryFilter === $category['name']) ? 'selected' : ''; ?>>
                                <?php echo sanitize($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <i class="fas fa-chevron-down absolute right-4 top-3.5 text-slate-400 pointer-events-none text-sm"></i>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Quizzes Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="quizGrid">
    <?php if (count($quizzes) > 0): ?>
        <?php foreach ($quizzes as $quiz): ?>
            <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm hover:shadow-premium hover:-translate-y-1.5 transition-all duration-300 flex flex-col h-full quiz-item" data-category="<?php echo sanitize($quiz['category_name']); ?>">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-primary-50 border border-primary-100/30 text-primary-600 text-xs font-bold px-3 py-1 rounded-full"><?php echo sanitize($quiz['category_name']); ?></div>
                    <div class="text-sm font-bold <?php echo ($quiz['time_limit'] > 0) ? 'text-amber-500' : 'text-emerald-500'; ?> flex items-center">
                        <i class="fas <?php echo ($quiz['time_limit'] > 0) ? 'fa-clock' : 'fa-infinity'; ?> mr-1.5"></i>
                        <?php echo ($quiz['time_limit'] > 0) ? $quiz['time_limit'] . 'm' : 'Unlimited'; ?>
                    </div>
                </div>

                <h4 class="font-extrabold text-slate-900 text-base mb-2 flex-shrink-0"><?php echo sanitize($quiz['title']); ?></h4>
                <p class="text-slate-500 text-sm leading-relaxed mb-6 flex-grow line-clamp-3"><?php echo sanitize($quiz['description']); ?></p>

                <div class="flex items-center text-slate-400 text-sm mb-4 font-semibold">
                    <i class="fas fa-book-open mr-2 text-primary-600"></i>
                    <span><?php echo $quiz['question_count']; ?></span>&nbsp;Questions
                </div>

                <?php if ($quiz['question_count'] > 0): ?>
                    <div class="flex space-x-1.5 bg-slate-50 p-1 rounded-2xl mt-auto">
                        <!-- Low Mode -->
                        <?php if (in_array($quiz['highest_mode_completed'], ['low', 'medium', 'high'])): ?>
                            <button class="flex-1 text-center py-2 text-sm font-bold bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center space-x-1 border border-emerald-200/40" disabled title="Completed">
                                <i class="fas fa-check-circle text-xs"></i>
                                <span>Low</span>
                            </button>
                        <?php else: ?>
                            <a href="take-quiz.php?id=<?php echo $quiz['id']; ?>&mode=low" class="flex-1 text-center py-2 text-sm font-bold text-primary-600 hover:bg-primary-50 rounded-xl flex items-center justify-center space-x-1 border border-primary-200/20 transition-all animate-pulse" title="Start Low Mode">
                                <i class="fas fa-play text-xs"></i>
                                <span>Low</span>
                            </a>
                        <?php endif; ?>

                        <!-- Medium Mode -->
                        <?php if (in_array($quiz['highest_mode_completed'], ['medium', 'high'])): ?>
                            <button class="flex-1 text-center py-2 text-sm font-bold bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center space-x-1 border border-emerald-200/40" disabled title="Completed">
                                <i class="fas fa-check-circle text-xs"></i>
                                <span>Med</span>
                            </button>
                        <?php elseif (in_array($quiz['highest_mode_completed'], ['low'])): ?>
                            <a href="take-quiz.php?id=<?php echo $quiz['id']; ?>&mode=medium" class="flex-1 text-center py-2 text-sm font-bold text-primary-600 hover:bg-primary-50 rounded-xl flex items-center justify-center space-x-1 border border-primary-200/20 transition-all animate-pulse" title="Start Medium Mode">
                                <i class="fas fa-play text-xs"></i>
                                <span>Med</span>
                            </a>
                        <?php else: ?>
                            <button class="flex-1 text-center py-2 text-sm font-bold text-red-500 bg-red-50 rounded-xl flex items-center justify-center space-x-1 border border-red-200/35 cursor-not-allowed" disabled title="Locked">
                                <i class="fas fa-lock text-xs"></i>
                                <span>Med</span>
                            </button>
                        <?php endif; ?>

                        <!-- High/Premium Mode -->
                        <?php if ($quiz['highest_mode_completed'] == 'high'): ?>
                            <button class="flex-1 text-center py-2 text-sm font-bold bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center space-x-1 border border-emerald-200/40" disabled title="Completed">
                                <i class="fas fa-check-circle text-xs"></i>
                                <span>High</span>
                            </button>
                        <?php elseif (in_array($quiz['highest_mode_completed'], ['medium'])): ?>
                            <?php if ($quiz['is_purchased']): ?>
                                <a href="take-quiz.php?id=<?php echo $quiz['id']; ?>&mode=high" class="flex-1 text-center py-2 text-sm font-bold text-primary-600 hover:bg-primary-50 rounded-xl flex items-center justify-center space-x-1 border border-primary-200/20 transition-all animate-pulse" title="Start High Mode">
                                    <i class="fas fa-play text-xs"></i>
                                    <span>High</span>
                                </a>
                            <?php else: ?>
                                <a href="upgrade-premium.php?quiz_id=<?php echo $quiz['id']; ?>" class="flex-1 text-center py-2 text-sm font-bold text-amber-700 bg-amber-50 hover:bg-amber-100 rounded-xl flex items-center justify-center space-x-1 transition-all border border-amber-200" title="Upgrade to Premium">
                                    <i class="fas fa-crown text-xs"></i>
                                    <span>High</span>
                                </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <button class="flex-1 text-center py-2 text-sm font-bold text-red-500 bg-red-50 rounded-xl flex items-center justify-center space-x-1 border border-red-200/35 cursor-not-allowed" disabled title="Locked">
                                <i class="fas fa-lock text-xs"></i>
                                <span>High</span>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="bg-slate-50 text-center py-2 rounded-xl text-slate-400 font-bold text-sm mt-auto">
                        Coming soon to library
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-span-full text-center py-12 bg-white rounded-3xl border border-slate-200 shadow-sm p-10">
            <div class="mb-4">
                <i class="fas fa-box-open text-slate-350 text-5xl"></i>
            </div>
            <h4 class="font-bold text-slate-800 text-base mb-1">No quizzes available for this query.</h4>
            <p class="text-slate-400 text-sm">Try adjusting your filters or search terms.</p>
            <a href="quizzes.php" class="inline-block border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-6 py-2 rounded-full text-sm mt-4 transition-all">Clear Filters</a>
        </div>
    <?php endif; ?>
</div>

<!-- Pagination Controls -->
<?php if (isset($total_pages) && $total_pages > 1): ?>
    <div class="flex justify-center mt-10">
        <nav class="flex items-center space-x-1 bg-white border border-slate-200 rounded-full p-1.5 shadow-sm">
            <?php
            // Build the base query string to preserve search/category filters across pages
            $queryParams = $_GET;
            unset($queryParams['page']); // Remove current page from params
            $queryString = http_build_query($queryParams);
            $queryString = $queryString ? '&' . $queryString : '';
            ?>

            <!-- Previous Button -->
            <a class="px-4 py-2 rounded-full text-sm font-semibold text-slate-500 hover:bg-slate-50 hover:text-primary-600 transition-all <?php echo ($page <= 1) ? 'pointer-events-none opacity-50' : ''; ?>" href="?page=<?php echo $page - 1; ?><?php echo $queryString; ?>">
                <i class="fas fa-chevron-left mr-1.5 text-xs"></i> Prev
            </a>

            <!-- Page Numbers -->
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all <?php echo ($page == $i) ? 'bg-primary-600 text-white shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-primary-600'; ?>" href="?page=<?php echo $i; ?><?php echo $queryString; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <!-- Next Button -->
            <a class="px-4 py-2 rounded-full text-sm font-semibold text-slate-500 hover:bg-slate-50 hover:text-primary-600 transition-all <?php echo ($page >= $total_pages) ? 'pointer-events-none opacity-50' : ''; ?>" href="?page=<?php echo $page + 1; ?><?php echo $queryString; ?>">
                Next <i class="fas fa-chevron-right ml-1.5 text-xs"></i>
            </a>
        </nav>
    </div>
<?php endif; ?>

<?php include_once '../includes/footer.php'; ?>