<?php
$pageTitle = 'Home';
include_once 'includes/header.php';
?>

<!-- Hero Section (Premium Centered Design) -->
<!-- Floating Dashboard Preview Elements (Desktop Only) -->
<div class="container position-relative d-none d-xl-block" style="margin-top: 10rem;">
    <!-- Element 1: Top Scorer Badge -->
    <div class="hero-floating-element card animate-float-1" style="top: 0; left: -60px; transform: rotate(-5deg);">
        <div class="d-flex align-items-center">
            <div class="icon-box-premium me-3" style="background: var(--warning-50); color: var(--warning-600);">
                <i class="fas fa-trophy"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-0">Top Scorer</h6>
                <small class="text-muted">Achieve Greatness</small>
            </div>
        </div>
        <div class="progress mt-3" style="height: 6px; border-radius: 10px;">
            <div class="progress-bar bg-warning" style="width: 85%;"></div>
        </div>
    </div>

    <!-- Element 2: Quiz Passed Notification -->
    <div class="hero-floating-element card animate-float-2" style="bottom: 40px; left: -40px; transform: rotate(3deg); width: 220px;">
        <div class="d-flex align-items-center">
            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);">
                <i class="fas fa-check"></i>
            </div>
            <div>
                <h6 class="fw-bold mb-0">Quiz Passed</h6>
                <small class="text-success fw-bold">Score: 92%</small>
            </div>
        </div>
    </div>

    <!-- Element 3: User Activity -->
    <div class="hero-floating-element card animate-float-3" style="top: 50px; right: -60px; transform: rotate(4deg); width: 220px;">
        <div class="d-flex align-items-center mb-2">
            <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center me-3" style="width: 34px; height: 34px;">
                <i class="fas fa-bolt small"></i>
            </div>
            <h6 class="fw-bold text-warning mb-0 small text-uppercase tracking-wider">New Activity</h6>
        </div>
        <div class="small text-muted">Python Basics completed with <span class="text-warning fw-bold">Perfect Score</span></div>
    </div>

    <!-- Element 4: Real-time Stats -->
    <div class="hero-floating-element card animate-float-1" style="bottom: 20px; right: -40px; transform: rotate(-2deg); width: 200px; padding: 1rem;">
        <div class="text-center">
            <div class="text-danger fw-bold display-6 mb-0 glow-indigo">850</div>
            <div class="text-muted small fw-bold text-uppercase">Total XP Points</div>
        </div>
    </div>
</div>

<div class="container position-relative z-1">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <div class="hero-card-premium">
                <div class="hero-badge-premium">
                    <i class="fas fa-sparkles me-2"></i> Elevate Your Knowledge
                </div>

                <h1 class="display-3 fw-bold mb-4 lh-tight text-slate-900">
                    Unlock Your Potential <br>
                    <span class="text-gradient">with Quizara</span>
                </h1>

                <p class="lead text-slate-600 mb-5 px-lg-5 mx-auto opacity-75" style="max-width: 600px;">
                    The ultimate intelligent platform to test your knowledge, challenge your peers, and architect your learning journey with precision.
                </p>

                <div class="d-grid gap-3 d-sm-flex justify-content-center mb-5">
                    <?php if (isLoggedIn()): ?>
                        <?php if (isAdmin()): ?>
                            <a href="admin/dashboard.php" class="btn btn-outline-indigo px-5 rounded-pill shadow-premium">
                                Admin View <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        <?php else: ?>
                            <a href="student/dashboard.php" class="btn btn-outline-indigo px-5 rounded-pill shadow-premium">
                                Start Learning <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="register.php" class="btn btn-outline-indigo px-5 fw-bold rounded-pill shadow-premium">Get Started Free</a>
                        <a href="login.php" class="btn btn-outline-indigo px-5 fw-bold rounded-pill">Sign In</a>
                    <?php endif; ?>
                </div>

                <div class="d-flex flex-wrap justify-content-center gap-4 pt-4 border-top border-slate-100">
                    <div class="d-flex align-items-center">
                        <div class="icon-box-premium me-2" style="width: 32px; height: 32px; font-size: 0.9rem;">
                            <i class="fas fa-users text-primary"></i>
                        </div>
                        <span class="fw-bold text-primary">1,000+ Users</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="icon-box-premium me-2" style="width: 32px; height: 32px; font-size: 0.9rem; background: var(--emerald-50); color: var(--emerald-600);">
                            <i class="fas fa-question-circle text-danger"></i>
                        </div>
                        <span class="fw-bold text-danger">500+ Quizzes</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="icon-box-premium me-2" style="width: 32px; height: 32px; font-size: 0.9rem; background: var(--warning-50); color: var(--warning-600);">
                            <i class="fas fa-star text-success"></i>
                        </div>
                        <span class="fw-bold text-success">4.9/5 Rating</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-outline-indigo {
        color: var(--indigo-600);
        border-color: var(--indigo-100);
    }

    .btn-outline-indigo:hover {
        color: var(--indigo-600);
        background-color: var(--indigo-100);
    }
</style>

<!-- Popular Categories -->
<section class="py-5 position-relative overflow-hidden">
    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 opacity-20" style="background: radial-gradient(circle at center, rgba(79, 70, 229, 0.05) 0%, transparent 70%); z-index: -1;"></div>

    <div class="row mb-5 align-items-end">
        <div class="col-lg-6">
            <h6 class="text-primary text-uppercase fw-bold letter-spacing-2 mb-2">Curated for you</h6>
            <h2 class="display-5 fw-bold mb-3">Popular <span class="text-gradient">Categories</span></h2>
            <p class="text-muted lead mb-0">Discover quizzes across 20+ specialized topics</p>
        </div>
        <div class="col-lg-6 text-lg-end d-none d-lg-block">
            <a href="student/quizzes.php" class="btn btn-link text-primary text-decoration-none fw-bold p-0">
                Browse All Categories <i class="fas fa-chevron-right ms-2 small"></i>
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Category 1: Programming -->
        <div class="col-md-6 col-lg-3">
            <div class="card category-card h-100 border-0 shadow-sm overflow-hidden hover-lift">
                <div class="category-accent-bg bg-primary opacity-10"></div>
                <div class="card-body p-4 position-relative">
                    <div class="category-icon-box mb-4 text-primary">
                        <i class="fas fa-code fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Programming</h4>
                    <p class="text-muted small mb-4">Master Python, Java, and modern web frameworks.</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">120+ Quizzes</span>
                        <a href="student/quizzes.php?category=programming" class="btn btn-icon-link stretched-link text-primary"><i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category 2: Science -->
        <div class="col-md-6 col-lg-3">
            <div class="card category-card h-100 border-0 shadow-sm overflow-hidden hover-lift" style="margin-top: 2rem;">
                <div class="category-accent-bg bg-success opacity-10"></div>
                <div class="card-body p-4 position-relative">
                    <div class="category-icon-box mb-4 text-success">
                        <i class="fas fa-flask fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Science</h4>
                    <p class="text-muted small mb-4">Explore Biology, Chemistry, and Quantum Physics.</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">85+ Quizzes</span>
                        <a href="student/quizzes.php?category=science" class="btn btn-icon-link stretched-link text-success"><i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category 3: Mathematics -->
        <div class="col-md-6 col-lg-3">
            <div class="card category-card h-100 border-0 shadow-sm overflow-hidden hover-lift">
                <div class="category-accent-bg bg-warning opacity-10"></div>
                <div class="card-body p-4 position-relative">
                    <div class="category-icon-box mb-4 text-warning text-opacity-100">
                        <i class="fas fa-calculator fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Mathematics</h4>
                    <p class="text-muted small mb-4">From basic Algebra to advanced Calculus.</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="badge bg-warning bg-opacity-10 text-warning-emphasis rounded-pill px-3">60+ Quizzes</span>
                        <a href="student/quizzes.php?category=math" class="btn btn-icon-link stretched-link text-warning"><i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category 4: History -->
        <div class="col-md-6 col-lg-3">
            <div class="card category-card h-100 border-0 shadow-sm overflow-hidden hover-lift" style="margin-top: 2rem;">
                <div class="category-accent-bg bg-info opacity-10"></div>
                <div class="card-body p-4 position-relative">
                    <div class="category-icon-box mb-4 text-info">
                        <i class="fas fa-globe-americas fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-2">History</h4>
                    <p class="text-muted small mb-4">Journey through civilizations and turning points.</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3">95+ Quizzes</span>
                        <a href="student/quizzes.php?category=history" class="btn btn-icon-link stretched-link text-info"><i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .category-card {
        background: #ffffff;
        border-radius: 20px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .category-accent-bg {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        z-index: 0;
        transition: all 0.4s ease;
    }

    .category-card:hover .category-accent-bg {
        transform: scale(1.5);
        opacity: 0.15 !important;
    }

    .category-icon-box {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        border-radius: 15px;
        transition: all 0.3s ease;
    }

    .category-card:hover .category-icon-box {
        transform: rotate(-10deg) scale(1.1);
        background: #ffffff;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    .btn-icon-link {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f8fafc;
        color: inherit;
        transition: all 0.3s ease;
    }

    .category-card:hover .btn-icon-link {
        background: currentColor;
    }

    .category-card:hover .btn-icon-link i {
        color: #fff;
    }

    @media (max-width: 991px) {
        .category-card {
            margin-top: 0 !important;
        }
    }
</style>
</section>

<!-- How It Works Section -->
<section class="py-5 position-relative">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h6 class="text-info text-uppercase fw-bold letter-spacing-2 mb-2">Process</h6>
            <h2 class="display-5 fw-bold mb-3">How It Works</h2>
            <p class="text-muted lead">Start your learning journey in simple steps</p>
        </div>
    </div>

    <div class="row g-4 position-relative px-lg-5">
        <!-- Step 1 -->
        <div class="col-md-4 text-center position-relative">
            <div class="step-connector"></div>
            <div class="glass-card p-4 rounded-4 h-100 hover-lift position-relative z-1">
                <div class="d-flex justify-content-center mb-4">
                    <div class="position-relative">
                        <div class="bg-slate-100 rounded-circle p-3 border border-slate-200">
                            <i class="fas fa-user-plus fa-2x text-primary"></i>
                        </div>
                        <span class="step-number-badge position-absolute top-0 start-100 translate-middle rounded-circle d-flex align-items-center justify-content-center border border-white">1</span>
                    </div>
                </div>
                <h4 class="fw-bold mb-3">Sign Up</h4>
                <p class="text-muted">Create your free account in seconds. Join a community of eager learners.</p>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="col-md-4 text-center position-relative">
            <div class="step-connector"></div>
            <div class="glass-card p-4 rounded-4 h-100 hover-lift position-relative z-1">
                <div class="d-flex justify-content-center mb-4">
                    <div class="position-relative">
                        <div class="bg-slate-100 rounded-circle p-3 border border-slate-200">
                            <i class="fas fa-tasks fa-2x text-primary"></i>
                        </div>
                        <span class="step-number-badge position-absolute top-0 start-100 translate-middle rounded-circle d-flex align-items-center justify-content-center border border-white">2</span>
                    </div>
                </div>
                <h4 class="fw-bold mb-3">Take Quizzes</h4>
                <p class="text-muted">Choose from a variety of categories and challenge yourself with interactive quizzes.</p>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="col-md-4 text-center position-relative">
            <div class="glass-card p-4 rounded-4 h-100 hover-lift position-relative z-1">
                <div class="d-flex justify-content-center mb-4">
                    <div class="position-relative">
                        <div class="bg-slate-100 rounded-circle p-3 border border-slate-200">
                            <i class="fas fa-trophy fa-2x text-primary"></i>
                        </div>
                        <span class="step-number-badge position-absolute top-0 start-100 translate-middle rounded-circle d-flex align-items-center justify-content-center border border-white">3</span>
                    </div>
                </div>
                <h4 class="fw-bold mb-3">Get Results</h4>
                <p class="text-muted">Receive instant feedback, track your progress, and climb the leaderboard.</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Grid -->
<section class="py-5 text-center">
    <h2 class="display-5 fw-bold mb-5">Why Choose Quizara?</h2>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 p-4">
                <div class="card-body">
                    <div class="feature-icon-wrapper">
                        <i class="fas fa-bolt fa-2x text-warning"></i>
                    </div>
                    <h4 class="text-dark mb-3">Instant Feedback</h4>
                    <p class="text-muted">Get detailed explanations and scores immediately after completing a quiz.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 p-4">
                <div class="card-body">
                    <div class="feature-icon-wrapper">
                        <i class="fas fa-chart-bar fa-2x text-info"></i>
                    </div>
                    <h4 class="text-dark mb-3">Detailed Analytics</h4>
                    <p class="text-muted">Track your progress over time with comprehensive charts and performance reports.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 p-4">
                <div class="card-body">
                    <div class="feature-icon-wrapper">
                        <i class="fas fa-mobile-alt fa-2x text-success"></i>
                    </div>
                    <h4 class="text-dark mb-3">Mobile Friendly</h4>
                    <p class="text-muted">Study on the go. Our platform is fully responsive and optimized for any device.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-5 mb-5">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h6 class="text-warning text-uppercase fw-bold letter-spacing-2 mb-2">Testimonials</h6>
            <h2 class="display-5 fw-bold mb-3">What Users Say</h2>
            <p class="text-dark lead">Join thousands of satisfied learners worldwide</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Testimonial 1 -->
        <div class="col-md-4">
            <div class="card glass-card h-100 p-4 border-0 testimonial-card hover-lift">
                <div class="testimonial-quote-icon">"</div>
                <div class="mb-4 text-warning">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-dark fs-5 mb-4 position-relative z-1 opacity-90 fst-italic">"Quizara has transformed the way I revise for my exams. The instant feedback is incredibly helpful!"</p>
                <div class="d-flex align-items-center mt-auto position-relative z-1">
                    <div class="bg-danger bg-gradient rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-3 shadow-sm" style="width: 50px; height: 50px;">JS</div>
                    <div>
                        <h6 class="text-dark mb-0 fw-bold">John Smith</h6>
                        <small class="text-muted">Computer Science Student</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="col-md-4">
            <div class="card glass-card h-100 p-4 border-0 testimonial-card hover-lift">
                <div class="testimonial-quote-icon">"</div>
                <div class="mb-4 text-warning">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text-dark fs-5 mb-4 position-relative z-1 opacity-90 fst-italic">"The variety of categories keeps me engaged. I've learned so much about history and science just for fun."</p>
                <div class="d-flex align-items-center mt-auto position-relative z-1">
                    <div class="bg-success bg-gradient rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-3 shadow-sm" style="width: 50px; height: 50px;">ED</div>
                    <div>
                        <h6 class="text-dark mb-0 fw-bold">Emily Davis</h6>
                        <small class="text-muted">Lifelong Learner</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="col-md-4">
            <div class="card glass-card h-100 p-4 border-0 testimonial-card hover-lift">
                <div class="testimonial-quote-icon">"</div>
                <div class="mb-4 text-warning">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="text-dark fs-5 mb-4 position-relative z-1 opacity-90 fst-italic">"A fantastic platform! The interface is beautiful, and studying on my phone has never been easier."</p>
                <div class="d-flex align-items-center mt-auto position-relative z-1">
                    <div class="bg-info bg-gradient rounded-circle d-flex align-items-center justify-content-center text-white fw-bold me-3 shadow-sm" style="width: 50px; height: 50px;">MJ</div>
                    <div>
                        <h6 class="text-dark mb-0 fw-bold">Michael Johnson</h6>
                        <small class="text-muted">Web Developer</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .floating-animation {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-20px);
        }

        100% {
            transform: translateY(0px);
        }
    }
</style>

<?php include_once 'includes/footer.php'; ?>