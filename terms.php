<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

$pageTitle = 'Terms of Service';
include_once 'includes/header.php';
?>

<div class="max-w-4xl mx-auto py-12">
    <!-- Header -->
    <div class="text-center mb-10">
        <h1 class="text-4xl font-black text-slate-900 leading-tight mb-2">Terms of Service</h1>
        <p class="text-slate-500 text-sm md:text-base">Rules and agreements for using Quizara.</p>
    </div>

    <!-- Content Card -->
    <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-12 shadow-premium relative overflow-hidden mb-8">
        <span class="text-slate-400 text-xs mb-8 block">Effective Date: <?php echo date('F d, Y'); ?></span>

        <h3 class="text-lg font-bold text-primary-600 mb-3 mt-6">1. Acceptance of Terms</h3>
        <p class="text-slate-600 text-xs md:text-sm leading-relaxed text-justify mb-4">
            By accessing or using Quizara, you agree to be bound by these Terms of Service and all applicable laws and regulations. If you do not agree with any of these terms, you are prohibited from using or accessing this site.
        </p>

        <h3 class="text-lg font-bold text-primary-600 mb-3 mt-6">2. User Accounts</h3>
        <p class="text-slate-600 text-xs md:text-sm leading-relaxed text-justify mb-4">
            When you create an account with us, you must provide information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our service. You are responsible for safeguarding the password that you use to access the service and for any activities or actions under your password.
        </p>

        <h3 class="text-lg font-bold text-primary-600 mb-3 mt-6">3. Educational Content</h3>
        <p class="text-slate-600 text-xs md:text-sm leading-relaxed text-justify mb-4">
            The quizzes and educational materials provided on Quizara are for learning and assessment purposes. While we strive for accuracy, we do not guarantee that all content is free of errors. Report any discrepancies to our support team for review.
        </p>

        <h3 class="text-lg font-bold text-primary-600 mb-3 mt-6">4. Prohibited Conduct</h3>
        <p class="text-slate-600 text-xs md:text-sm leading-relaxed text-justify mb-4">
            You agree not to use the service to:
        </p>
        <ul class="list-disc pl-5 text-slate-600 text-xs md:text-sm space-y-2 mt-2 mb-4">
            <li>Violate any local, state, national, or international law.</li>
            <li>Attempt to exploit vulnerabilities or bypass authentication measures.</li>
            <li>Cheating or manipulating quiz scores through automated means.</li>
            <li>Harass, abuse, or harm another person or group.</li>
        </ul>

        <h3 class="text-lg font-bold text-primary-600 mb-3 mt-6">5. Intellectual Property</h3>
        <p class="text-slate-600 text-xs md:text-sm leading-relaxed text-justify mb-4">
            The Service and its original content, features, and functionality are and will remain the exclusive property of Quizara and its licensors. The Service is protected by copyright, trademark, and other laws.
        </p>

        <h3 class="text-lg font-bold text-primary-600 mb-3 mt-6">6. Termination</h3>
        <p class="text-slate-600 text-xs md:text-sm leading-relaxed text-justify mb-4">
            We may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms. All provisions of the Terms which by their nature should survive termination shall survive termination.
        </p>

        <h3 class="text-lg font-bold text-primary-600 mb-3 mt-6">7. Changes to Terms</h3>
        <p class="text-slate-600 text-xs md:text-sm leading-relaxed text-justify mb-0">
            We reserve the right, at our sole discretion, to modify or replace these Terms at any time. What constitutes a material change will be determined at our sole discretion. By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms.
        </p>
    </div>

    <div class="text-center">
        <a href="index.php" class="inline-flex items-center border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-6 py-2.5 rounded-full transition-all text-sm">
            <i class="fas fa-arrow-left mr-2"></i>Back to Home
        </a>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>