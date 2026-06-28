<?php
require_once 'config/database.php';
require_once 'includes/functions.php';

$pageTitle = 'Privacy Policy';
include_once 'includes/header.php';
?>

<div class="max-w-4xl mx-auto py-12">
    <!-- Header -->
    <div class="text-center mb-10">
        <h1 class="text-4xl font-black text-slate-900 leading-tight mb-2">Privacy Policy</h1>
        <p class="text-slate-500 text-sm md:text-base">How we handle and protect your data.</p>
    </div>

    <!-- Content Card -->
    <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-12 shadow-premium relative overflow-hidden mb-8">
        <span class="text-slate-400 text-xs mb-8 block">Last updated: <?php echo date('F d, Y'); ?></span>

        <h3 class="text-lg font-bold text-primary-600 mb-3 mt-6">1. Information We Collect</h3>
        <p class="text-slate-600 text-xs md:text-sm leading-relaxed text-justify mb-4">
            We collect information you provide directly to us when you create an account, participate in quizzes, or communicate with us. This may include your name, email address, password, and profile information. We also automatically collect certain information when you access our platform, such as your IP address, browser type, and usage data.
        </p>

        <h3 class="text-lg font-bold text-primary-600 mb-3 mt-6">2. How We Use Your Information</h3>
        <p class="text-slate-600 text-xs md:text-sm leading-relaxed text-justify mb-4">
            We use the information we collect to operate, maintain, and improve our services. Specifically, we use your data to:
        </p>
        <ul class="list-disc pl-5 text-slate-600 text-xs md:text-sm space-y-2 mt-2 mb-4">
            <li>Provide and personalize your quiz experience.</li>
            <li>Track your progress and generate performance reports.</li>
            <li>Send administrative notifications and updates.</li>
            <li>Detect and prevent fraudulent or unauthorized activity.</li>
        </ul>

        <h3 class="text-lg font-bold text-primary-600 mb-3 mt-6">3. Data Security</h3>
        <p class="text-slate-600 text-xs md:text-sm leading-relaxed text-justify mb-4">
            We implement appropriate technical and organizational measures to protect specific data. However, please be aware that no method of transmission over the internet is completely secure. We strive to use commercially acceptable means to protect your personal information, but we cannot guarantee its absolute security.
        </p>

        <h3 class="text-lg font-bold text-primary-600 mb-3 mt-6">4. Cookies</h3>
        <p class="text-slate-600 text-xs md:text-sm leading-relaxed text-justify mb-4">
            We use cookies and similar tracking technologies to track the activity on our service and hold certain information. Cookies are files with small amount of data which may include an anonymous unique identifier. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.
        </p>

        <h3 class="text-lg font-bold text-primary-600 mb-3 mt-6">5. Third-Party Services</h3>
        <p class="text-slate-600 text-xs md:text-sm leading-relaxed text-justify mb-4">
            We may employ third-party companies and individuals to facilitate our service, to provide the service on our behalf, to perform service-related services or to assist us in analyzing how our service is used. These third parties have access to your Personal Data only to perform these tasks on our behalf and are obligated not to disclose or use it for any other purpose.
        </p>

        <h3 class="text-lg font-bold text-primary-600 mb-3 mt-6">6. Contact Us</h3>
        <p class="text-slate-600 text-xs md:text-sm leading-relaxed text-justify mb-0">
            If you have any questions about this Privacy Policy, please contact us at <a href="contact.php" class="text-primary-600 hover:text-primary-700 font-bold transition-colors">support@quizara.com</a>.
        </p>
    </div>

    <div class="text-center">
        <a href="index.php" class="inline-flex items-center border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-6 py-2.5 rounded-full transition-all text-sm">
            <i class="fas fa-arrow-left mr-2"></i>Back to Home
        </a>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>