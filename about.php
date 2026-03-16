<?php
$pageTitle = 'About Us';
include_once 'includes/header.php';
?>

<!-- Premium Hero Section -->
<section class="about-hero py-5 position-relative overflow-hidden">
    <div class="hero-bg-accent"></div>
    <div class="container position-relative z-1">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="badge rounded-pill bg-indigo-50 text-indigo-600 px-3 py-2 mb-4 fw-bold border border-indigo-100 shadow-sm">
                    <i class="fas fa-sparkles me-2"></i> Shaping the Future of Education
                </div>
                <h1 class="display-3 fw-bold mb-4 lh-tight">
                    Beyond Just <br>
                    <span class="text-gradient">Questions & Answers</span>
                </h1>
                <p class="lead text-muted mb-5 pe-lg-4">
                    Quizara is a modern assessment platform dedicated to transforming how knowledge is shared and validated. We believe learning should be an adventure, not a chore.
                </p>
                <div class="d-flex flex-column flex-md-row gap-3 align-items-center">
                    <a href="register.php" class="btn btn-primary rounded-pill px-5 shadow-premium">Join Us Now</a>
                    <a href="#mission" class="text-indigo-600 fw-bold text-decoration-none ms-3">Our Core Story <i class="fas fa-arrow-down ms-2"></i></a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="hero-visual-container">
                    <div class="visual-card main-card shadow-premium hover-lift">
                        <i class="fas fa-graduation-cap fa-4x text-indigo-600"></i>
                        <h4 class="mt-3 fw-bold">100% Digital</h4>
                    </div>
                    <div class="visual-card sub-card-1 shadow-md hover-lift">
                        <i class="fas fa-chart-line text-success fa-2x"></i>
                        <div class="ms-3">
                            <div class="fw-bold small">Progress Tracking</div>
                            <div class="text-muted smaller">Real-time data</div>
                        </div>
                    </div>
                    <div class="visual-card sub-card-2 shadow-md hover-lift">
                        <i class="fas fa-users text-info fa-2x"></i>
                        <div class="ms-3">
                            <div class="fw-bold small">Global Learner Base</div>
                            <div class="text-muted smaller">5k+ Joined</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Impactful Mission Section -->
<section id="mission" class="py-5 bg-slate-50 border-top border-bottom border-slate-100">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center text-lg-start d-lg-flex align-items-center">
                <div class="me-lg-5 mb-4 mb-lg-0">
                    <div class="mission-icon bg-indigo-600 text-white rounded-circle shadow-premium d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                        <i class="fas fa-quote-left fa-3x"></i>
                    </div>
                </div>
                <div>
                    <h2 class="fw-bold mb-3">Our Mission</h2>
                    <p class="fs-4 text-slate-700 fst-italic mb-0">
                        "To create a world where everyone has access to high-quality, engaging, and measurable learning experiences, powered by the best in educational technology."
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern Values Grid -->
<section class="py-5 overflow-hidden">
    <div class="container py-5">
        <div class="row mb-5 text-center">
            <div class="col-lg-7 mx-auto">
                <h6 class="text-primary text-uppercase fw-bold letter-spacing-2 mb-3">Driven by excellence</h6>
                <h2 class="display-5 fw-bold mb-4">The Quizara <span class="text-gradient">Core Values</span></h2>
                <p class="text-muted">These pillars define every line of code we write and every quiz we host.</p>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card value-card h-100 border-0 shadow-sm p-4 hover-lift">
                    <div class="value-icon mb-4 text-primary bg-primary bg-opacity-10 rounded-4 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                        <i class="fas fa-bolt fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Innovation First</h4>
                    <p class="text-muted small mb-0">We are constantly redefining the limits of online testing, using data to make assessments smarter and more engaging every day.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card value-card h-100 border-0 shadow-sm p-4 hover-lift">
                    <div class="value-icon mb-4 text-success bg-success bg-opacity-10 rounded-4 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                        <i class="fas fa-fingerprint fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Student Obsessed</h4>
                    <p class="text-muted small mb-0">Your growth is our North Star. Everything in Quizara is built with the student experience as the top priority.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card value-card h-100 border-0 shadow-sm p-4 hover-lift">
                    <div class="value-icon mb-4 text-info bg-info bg-opacity-10 rounded-4 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px;">
                        <i class="fas fa-hand-holding-heart fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Radical Transparency</h4>
                    <p class="text-muted small mb-0">We believe in data that speaks for itself. Clear metrics, honest feedback, and open communication with our community.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Strip with Final CTA -->
<section class="py-5 bg-indigo-50 position-relative overflow-hidden rounded border-top border-indigo-100">
    <div class="container py-5 position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
                <h2 class="display-5 fw-bold mb-4">Ready to unlock your <br><span class="text-indigo-600">full potential?</span></h2>
                <p class="lead text-muted mb-5 pe-lg-5">Join our global community of thousands and start your journey toward mastery today. It only takes 30 seconds to sign up.</p>
                <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-3">
                    <a href="register.php" class="btn btn-primary rounded-pill px-5 py-3 shadow-premium fw-bold">Start Learning Free</a>
                    <a href="contact.php" class="btn btn-outline-primary rounded-pill px-5 py-3 fw-bold">Get In Touch</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="p-4 rounded-4 bg-white border border-indigo-100 text-center shadow-sm">
                            <h3 class="display-4 fw-bold mb-1 text-slate-800">5k+</h3>
                            <div class="text-indigo-600 small text-uppercase fw-bold tracking-wider">Learners</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 rounded-4 bg-white border border-indigo-100 text-center shadow-sm">
                            <h3 class="display-4 fw-bold mb-1 text-slate-800">200+</h3>
                            <div class="text-indigo-600 small text-uppercase fw-bold tracking-wider">Quizzes</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 rounded-4 bg-white border border-indigo-100 text-center shadow-sm">
                            <h3 class="display-4 fw-bold mb-1 text-slate-800">98%</h3>
                            <div class="text-indigo-600 small text-uppercase fw-bold tracking-wider">Success</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 rounded-4 bg-white border border-indigo-100 text-center shadow-sm">
                            <h3 class="display-4 fw-bold mb-1 text-slate-800">24/7</h3>
                            <div class="text-indigo-600 small text-uppercase fw-bold tracking-wider">Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .about-hero {
        padding-top: 5rem;
        padding-bottom: 5rem;
    }

    .hero-bg-accent {
        position: absolute;
        top: -100px;
        right: -100px;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle at center, rgba(79, 70, 229, 0.08) 0%, transparent 70%);
        z-index: 0;
    }

    .hero-visual-container {
        position: relative;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .visual-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 2.5rem;
        position: absolute;
        border: 1px solid var(--border-color);
    }

    .main-card {
        width: 280px;
        text-align: center;
        z-index: 2;
        transform: rotate(-3deg);
    }

    .sub-card-1 {
        width: 220px;
        padding: 1.5rem;
        top: 50px;
        left: 20px;
        display: flex;
        align-items: center;
        z-index: 1;
        transform: rotate(5deg);
    }

    .sub-card-2 {
        width: 240px;
        padding: 1.5rem;
        bottom: 50px;
        right: 20px;
        display: flex;
        align-items: center;
        z-index: 1;
        transform: rotate(-4deg);
    }

    .value-card {
        background: #ffffff;
        border-radius: 20px;
        transition: all 0.3s ease;
    }

    .value-card:hover {
        border-color: var(--indigo-100) !important;
    }

    .text-indigo-600 {
        color: var(--indigo-600) !important;
    }

    .text-indigo-400 {
        color: #818cf8;
    }

    .text-indigo-300 {
        color: #a5b4fc;
    }

    .text-slate-700 {
        color: var(--slate-700) !important;
    }

    .text-slate-800 {
        color: var(--slate-800) !important;
    }

    .bg-indigo-600 {
        background-color: var(--indigo-600) !important;
    }

    .bg-indigo-50 {
        background-color: var(--indigo-50) !important;
    }

    @media (max-width: 991px) {
        .min-vh-50 {
            min-height: auto;
        }
    }
</style>

<?php include_once 'includes/footer.php'; ?>