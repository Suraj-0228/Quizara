<?php
$pageTitle = 'FAQ';
include_once 'includes/header.php';
?>

<div class="row justify-content-center py-5">
    <div class="col-lg-8">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold mb-3">Frequently Asked <span class="text-gradient">Questions</span></h1>
            <p class="text-muted lead">Everything you need to know about Quizara.</p>
        </div>

        <div class="accordion" id="faqAccordion">

            <!-- Item 1: Getting Started -->
            <div class="accordion-item glass-card mb-4 border-0 shadow-sm overflow-hidden">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed bg-transparent shadow-none py-4 px-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <i class="fas fa-play-circle me-3 text-primary"></i> How do I start my first quiz?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary px-4 pb-4 pt-0">
                        <hr class="border-secondary opacity-25 mt-0 mb-3">
                        Getting started is easy! Once you log in, go to the <strong>Available Quizzes</strong> section. Browse through categories like Programming, Science, or Math, and click "Take Quiz" to begin. Your results will be saved automatically to your dashboard.
                    </div>
                </div>
            </div>

            <!-- Item 2: Retakes -->
            <div class="accordion-item glass-card mb-4 border-0 shadow-sm overflow-hidden">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed bg-transparent shadow-none py-4 px-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="fas fa-redo me-3 text-success"></i> Can I retake a quiz to improve my score?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary px-4 pb-4 pt-0">
                        <hr class="border-secondary opacity-25 mt-0 mb-3">
                        Absolutely! We encourage continuous learning. You can retake any quiz as many times as you like. We track every attempt, allowing you to see your improvement over time in your <strong>History</strong> tab.
                    </div>
                </div>
            </div>

            <!-- Item 3: Premium Features -->
            <div class="accordion-item glass-card mb-4 border-0 shadow-sm overflow-hidden">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed bg-transparent shadow-none py-4 px-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <i class="fas fa-crown me-3 text-warning"></i> What are the benefits of Quizara Premium?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary px-4 pb-4 pt-0">
                        <hr class="border-secondary opacity-25 mt-0 mb-3">
                        Quizara Premium unlocks advanced features including <strong>detailed explanation videos</strong>, priority support, unlimited retakes for certified quizzes, and exclusive access to "Expert Level" categories across all topics.
                    </div>
                </div>
            </div>

            <!-- Item 4: Scoring -->
            <div class="accordion-item glass-card mb-4 border-0 shadow-sm overflow-hidden">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed bg-transparent shadow-none py-4 px-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <i class="fas fa-chart-bar me-3 text-info"></i> How is my accuracy and ranking determined?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary px-4 pb-4 pt-0">
                        <hr class="border-secondary opacity-25 mt-0 mb-3">
                        Your ranking on our global leaderboard is based on a combination of your <strong>total score</strong>, <strong>average accuracy</strong>, and the <strong>difficulty</strong> of the quizzes you complete. High accuracy in harder categories yields the most points.
                    </div>
                </div>
            </div>

            <!-- Item 5: Certificates -->
            <div class="accordion-item glass-card mb-4 border-0 shadow-sm overflow-hidden">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed bg-transparent shadow-none py-4 px-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <i class="fas fa-certificate me-3 text-danger"></i> Do I get a certificate after completion?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary px-4 pb-4 pt-0">
                        <hr class="border-secondary opacity-25 mt-0 mb-3">
                        Yes! Upon completing any "Certified Study Path" with a score of 80% or higher, a digital certificate will be generated automatically. You can view and download your certificates from your profile section at any time.
                    </div>
                </div>
            </div>

            <!-- Item 6: Password Reset -->
            <div class="accordion-item glass-card mb-4 border-0 shadow-sm overflow-hidden">
                <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed bg-transparent shadow-none py-4 px-4 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <i class="fas fa-key me-3 text-secondary"></i> I forgot my password. How do I recover it?
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                    <div class="accordion-body text-secondary px-4 pb-4 pt-0">
                        <hr class="border-secondary opacity-25 mt-0 mb-3">
                        If you lose access to your account, please use the "Forgot Password" link on the login page or contact our support team via the <a href="contact.php" class="text-primary text-decoration-none">Contact Support</a> form. We'll help you secure your account within 24 hours.
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-5">
            <div class="glass-card support-card p-5 rounded-4 text-center border-0">
                <div class="support-bg-shape"></div>

                <div class="position-relative z-1">
                    <div class="avatar-group mb-4">
                        <div class="avatar bg-primary">JS</div>
                        <div class="avatar bg-success">ED</div>
                        <div class="avatar bg-info">MJ</div>
                        <div class="avatar bg-warning text-dark"><i class="fas fa-plus"></i></div>
                    </div>

                    <h3 class="fw-bold mb-2">Still have questions?</h3>
                    <p class="text-muted mb-4 max-w-md mx-auto">Can't find the answer you're looking for? Please chat to our friendly team.</p>

                    <a href="contact.php" class="btn btn-primary rounded-pill px-5 py-2 fw-bold shadow-lg hover-lift">
                        Get in Touch
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .glass-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
    }

    .accordion-button {
        color: var(--slate-800) !important;
    }

    .accordion-button::after {
        filter: none;
        opacity: 0.5;
        transition: all 0.3s ease;
    }

    .accordion-button:not(.collapsed) {
        background-color: var(--indigo-50);
        color: var(--indigo-600) !important;
    }

    .accordion-button:not(.collapsed)::after {
        filter: none;
        opacity: 1;
        transform: rotate(180deg);
    }

    .accordion-button:focus {
        box-shadow: none;
        border-color: var(--indigo-100);
    }
</style>

<?php include_once 'includes/footer.php'; ?>