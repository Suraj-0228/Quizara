<?php include_once '../controllers/quizzes-process.php'; ?>

<!-- Header Section -->
<div class="quiz-hero-banner mb-5">
    <div class="hero-shape"></div>
    <div class="container-fluid p-0">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge bg-white bg-opacity-20 text-dark mb-3 badge-premium border-0">
                    <i class="fas fa-search me-2"></i> Quiz Library
                </span>
                <h1 class="display-5 fw-bold mb-2 text-white">Available <span class="text-info">Quizzes</span></h1>
                <p class="lead text-white-50 mb-0">Choose a topic and challenge yourself today.</p>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
                <form action="quizzes.php" method="GET" id="filterForm">
                    <div class="row g-2">
                        <div class="col-md-8">
                            <div class="quiz-search-wrapper">
                                <i class="fas fa-search"></i>
                                <input type="text" name="search" class="form-control rounded-pill" placeholder="Search for quizzes..." value="<?php echo htmlspecialchars($searchQuery ?? ''); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-select border-0 h-100 rounded-pill px-3 shadow-sm" onchange="document.getElementById('filterForm').submit();">
                                <option value="">All Categories</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo sanitize($category['name']); ?>" <?php echo (isset($categoryFilter) && $categoryFilter === $category['name']) ? 'selected' : ''; ?>>
                                        <?php echo sanitize($category['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Quizzes Grid -->
<div class="row g-4" id="quizGrid">
    <?php if (count($quizzes) > 0): ?>
        <?php foreach ($quizzes as $quiz): ?>
            <div class="col-md-6 col-lg-4 quiz-item" data-category="<?php echo sanitize($quiz['category_name']); ?>">
                <div class="premium-quiz-card">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="category-pill"><?php echo sanitize($quiz['category_name']); ?></div>
                        <div class="small fw-bold <?php echo ($quiz['time_limit'] > 0) ? 'text-warning' : 'text-success'; ?>">
                            <i class="fas <?php echo ($quiz['time_limit'] > 0) ? 'fa-clock' : 'fa-infinity'; ?> me-1"></i>
                            <?php echo ($quiz['time_limit'] > 0) ? $quiz['time_limit'] . 'm' : 'Unlimited'; ?>
                        </div>
                    </div>

                    <h4 class="quiz-title mb-2"><?php echo sanitize($quiz['title']); ?></h4>
                    <p class="quiz-desc flex-grow-1 line-clamp-3 mb-4"><?php echo sanitize($quiz['description']); ?></p>

                    <div class="d-flex align-items-center mb-3 text-muted small">
                        <i class="fas fa-book-open me-2 text-primary"></i>
                        <span class="fw-bold"><?php echo $quiz['question_count']; ?></span>&nbsp;Questions
                    </div>

                    <?php if ($quiz['question_count'] > 0): ?>
                        <div class="mode-btn-group">
                            <!-- Low Mode -->
                            <?php if (in_array($quiz['highest_mode_completed'], ['low', 'medium', 'high'])): ?>
                                <button class="mode-btn active-low" disabled title="Completed">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Low</span>
                                </button>
                            <?php else: ?>
                                <a href="take-quiz.php?id=<?php echo $quiz['id']; ?>&mode=low" class="mode-btn ready-low text-decoration-none" title="Start Low Mode">
                                    <i class="fas fa-play"></i>
                                    <span>Low</span>
                                </a>
                            <?php endif; ?>

                            <!-- Medium Mode -->
                            <?php if (in_array($quiz['highest_mode_completed'], ['medium', 'high'])): ?>
                                <button class="mode-btn active-med" disabled title="Completed">
                                    <i class="fas fa-check-circle"></i>
                                    <span>Med</span>
                                </button>
                            <?php elseif (in_array($quiz['highest_mode_completed'], ['low'])): ?>
                                <a href="take-quiz.php?id=<?php echo $quiz['id']; ?>&mode=medium" class="mode-btn ready-med text-decoration-none" title="Start Medium Mode">
                                    <i class="fas fa-play"></i>
                                    <span>Med</span>
                                </a>
                            <?php else: ?>
                                <button class="mode-btn locked" disabled title="Locked">
                                    <i class="fas fa-lock"></i>
                                    <span>Med</span>
                                </button>
                            <?php endif; ?>

                            <!-- High/Premium Mode -->
                            <?php if ($quiz['highest_mode_completed'] == 'high'): ?>
                                <button class="mode-btn active-high" disabled title="Completed">
                                    <i class="fas fa-check-circle"></i>
                                    <span>High</span>
                                </button>
                            <?php elseif (in_array($quiz['highest_mode_completed'], ['medium'])): ?>
                                <?php if ($quiz['is_purchased']): ?>
                                    <a href="take-quiz.php?id=<?php echo $quiz['id']; ?>&mode=high" class="mode-btn ready-high text-decoration-none" title="Start High Mode">
                                        <i class="fas fa-play"></i>
                                        <span>High</span>
                                    </a>
                                <?php else: ?>
                                    <a href="upgrade-premium.php?quiz_id=<?php echo $quiz['id']; ?>" class="mode-btn active-premium text-decoration-none" title="Upgrade to Premium">
                                        <i class="fas fa-crown"></i>
                                        <span>High</span>
                                    </a>
                                <?php endif; ?>
                            <?php else: ?>
                                <button class="mode-btn locked" disabled title="Locked">
                                    <i class="fas fa-lock"></i>
                                    <span>High</span>
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="bg-slate-50 text-center py-2 rounded-3 text-muted small">
                            Coming soon to library
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center py-5">
            <div class="mb-3">
                <i class="fas fa-box-open fa-4x text-muted opacity-25"></i>
            </div>
            <h4 class="text-muted">No quizzes available for this query.</h4>
            <p class="text-muted small">Try adjusting your filters or search terms.</p>
            <a href="quizzes.php" class="btn btn-outline-primary mt-3 rounded-pill">Clear Filters</a>
        </div>
    <?php endif; ?>
</div>

<!-- Pagination Controls -->
<?php if (isset($total_pages) && $total_pages > 1): ?>
    <div class="row mt-5">
        <div class="col-12 d-flex justify-content-center">
            <nav aria-label="Quiz page navigation">
                <ul class="pagination pagination-lg custom-pagination shadow-lg">

                    <?php
                    // Build the base query string to preserve search/category filters across pages
                    $queryParams = $_GET;
                    unset($queryParams['page']); // Remove current page from params
                    $queryString = http_build_query($queryParams);
                    $queryString = $queryString ? '&' . $queryString : '';
                    ?>

                    <!-- Previous Button -->
                    <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?><?php echo $queryString; ?>" tabindex="-1" aria-disabled="<?php echo ($page <= 1) ? 'true' : 'false'; ?>">
                            <i class="fas fa-chevron-left me-1"></i> Prev
                        </a>
                    </li>

                    <!-- Page Numbers -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?><?php echo $queryString; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <!-- Next Button -->
                    <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?><?php echo $queryString; ?>">
                            Next <i class="fas fa-chevron-right ms-1"></i>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
<?php endif; ?>

<style>
    /* Custom Dark Theme Pagination Styles */
    .custom-pagination .page-link {
        background-color: #ffffff;
        border: 1px solid var(--border-color);
        color: var(--slate-600);
        padding: 0.75rem 1.25rem;
        transition: all 0.3s ease;
    }

    .custom-pagination .page-item:first-child .page-link {
        border-top-left-radius: 50rem;
        border-bottom-left-radius: 50rem;
        padding-left: 1.5rem;
    }

    .custom-pagination .page-item:last-child .page-link {
        border-top-right-radius: 50rem;
        border-bottom-right-radius: 50rem;
        padding-right: 1.5rem;
    }

    .custom-pagination .page-item:not(.active):not(.disabled) .page-link:hover {
        background-color: var(--slate-50);
        border-color: var(--indigo-200);
        color: var(--primary);
        transform: translateY(-2px);
        z-index: 2;
    }

    .custom-pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary) 0%, #6366f1 100%);
        border-color: var(--primary);
        color: white;
        font-weight: bold;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
    }

    .custom-pagination .page-item.disabled .page-link {
        background-color: var(--slate-50);
        color: var(--slate-300);
        border-color: var(--border-color);
        cursor: not-allowed;
    }
</style>

<?php include_once '../includes/footer.php'; ?>