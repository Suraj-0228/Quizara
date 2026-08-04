<?php
$pageTitle = 'Frequently Asked Questions';
include_once 'includes/header.php';
?>

<div class="max-w-3xl mx-auto py-12 px-4">
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-black text-slate-900 leading-tight mb-3">Frequently Asked <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-amber-500">Questions</span></h1>
        <p class="text-slate-500 text-sm md:text-base font-medium">Everything you need to know about Quizara, quiz modes, certificates, and features.</p>
    </div>

    <div class="space-y-4">
        <!-- Item 1 -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden transition-all">
            <h2>
                <button class="w-full flex justify-between items-center bg-transparent py-5 px-6 font-extrabold text-slate-800 text-left focus:outline-none cursor-pointer hover:text-primary-600 transition-colors" type="button" onclick="toggleFaq('collapseOne', this)">
                    <span class="flex items-center text-sm">
                        <i class="fas fa-play-circle mr-3.5 text-primary-600 text-lg flex-shrink-0"></i> How do I start my first quiz?
                    </span>
                    <i class="fas fa-chevron-down text-slate-400 text-xs transition-transform duration-300 transform rotate-180 faq-icon"></i>
                </button>
            </h2>
            <div id="collapseOne" class="faq-content border-t border-slate-100 bg-slate-50/50">
                <div class="p-6 text-slate-600 text-sm leading-relaxed font-medium">
                    Getting started is easy! Once you log in, navigate to the <strong class="text-slate-800">Quizzes</strong> section. Browse through categories like Programming, Science, or General Knowledge, choose your difficulty, and click "Take Quiz" to begin. Your performance and scores will be saved automatically to your dashboard.
                </div>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden transition-all">
            <h2>
                <button class="w-full flex justify-between items-center bg-transparent py-5 px-6 font-extrabold text-slate-800 text-left focus:outline-none cursor-pointer hover:text-primary-600 transition-colors" type="button" onclick="toggleFaq('collapseTwo', this)">
                    <span class="flex items-center text-sm">
                        <i class="fas fa-redo mr-3.5 text-amber-500 text-lg flex-shrink-0"></i> Can I retake a quiz to improve my score?
                    </span>
                    <i class="fas fa-chevron-down text-slate-400 text-xs transition-transform duration-300 transform faq-icon"></i>
                </button>
            </h2>
            <div id="collapseTwo" class="faq-content hidden border-t border-slate-100 bg-slate-50/50">
                <div class="p-6 text-slate-600 text-sm leading-relaxed font-medium">
                    Absolutely! We encourage continuous learning. You can retake any quiz as many times as you like. We track every attempt, allowing you to see your improvement over time in your <strong class="text-slate-800">History</strong> tab.
                </div>
            </div>
        </div>

        <!-- Item 3 -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden transition-all">
            <h2>
                <button class="w-full flex justify-between items-center bg-transparent py-5 px-6 font-extrabold text-slate-800 text-left focus:outline-none cursor-pointer hover:text-primary-600 transition-colors" type="button" onclick="toggleFaq('collapseThree', this)">
                    <span class="flex items-center text-sm">
                        <i class="fas fa-bolt mr-3.5 text-indigo-600 text-lg flex-shrink-0"></i> What is High Difficulty Mode & Premium Access?
                    </span>
                    <i class="fas fa-chevron-down text-slate-400 text-xs transition-transform duration-300 transform faq-icon"></i>
                </button>
            </h2>
            <div id="collapseThree" class="faq-content hidden border-t border-slate-100 bg-slate-50/50">
                <div class="p-6 text-slate-600 text-sm leading-relaxed font-medium">
                    High Difficulty Mode unlocks advanced expert-level questions designed to challenge top learners. You can unlock lifetime High Mode access for just <strong class="text-slate-900">₹149</strong> via Credit/Debit Card or Google Pay (GPay).
                </div>
            </div>
        </div>

        <!-- Item 4 -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden transition-all">
            <h2>
                <button class="w-full flex justify-between items-center bg-transparent py-5 px-6 font-extrabold text-slate-800 text-left focus:outline-none cursor-pointer hover:text-primary-600 transition-colors" type="button" onclick="toggleFaq('collapseFour', this)">
                    <span class="flex items-center text-sm">
                        <i class="fas fa-chart-line mr-3.5 text-sky-500 text-lg flex-shrink-0"></i> How is my accuracy and academic standing calculated?
                    </span>
                    <i class="fas fa-chevron-down text-slate-400 text-xs transition-transform duration-300 transform faq-icon"></i>
                </button>
            </h2>
            <div id="collapseFour" class="faq-content hidden border-t border-slate-100 bg-slate-50/50">
                <div class="p-6 text-slate-600 text-sm leading-relaxed font-medium">
                    Your academic standing is computed automatically based on your average accuracy percentage across all completed attempts. Scoring above 85% earns you the prestigious <strong class="text-slate-900">Scholar Master</strong> title on your profile.
                </div>
            </div>
        </div>

        <!-- Item 5 -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden transition-all">
            <h2>
                <button class="w-full flex justify-between items-center bg-transparent py-5 px-6 font-extrabold text-slate-800 text-left focus:outline-none cursor-pointer hover:text-primary-600 transition-colors" type="button" onclick="toggleFaq('collapseFive', this)">
                    <span class="flex items-center text-sm">
                        <i class="fas fa-certificate mr-3.5 text-rose-500 text-lg flex-shrink-0"></i> How do I get a certificate after completing a quiz?
                    </span>
                    <i class="fas fa-chevron-down text-slate-400 text-xs transition-transform duration-300 transform faq-icon"></i>
                </button>
            </h2>
            <div id="collapseFive" class="faq-content hidden border-t border-slate-100 bg-slate-50/50">
                <div class="p-6 text-slate-600 text-sm leading-relaxed font-medium">
                    Upon passing a quiz with a score equal to or higher than the passing score, a verified digital certificate is generated automatically. You can view, print, or download your certificates anytime from your <strong class="text-slate-800">Reports</strong> page.
                </div>
            </div>
        </div>

        <!-- Item 6 -->
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden transition-all">
            <h2>
                <button class="w-full flex justify-between items-center bg-transparent py-5 px-6 font-extrabold text-slate-800 text-left focus:outline-none cursor-pointer hover:text-primary-600 transition-colors" type="button" onclick="toggleFaq('collapseSix', this)">
                    <span class="flex items-center text-sm">
                        <i class="fas fa-lock mr-3.5 text-slate-500 text-lg flex-shrink-0"></i> How do I update my password or account settings?
                    </span>
                    <i class="fas fa-chevron-down text-slate-400 text-xs transition-transform duration-300 transform faq-icon"></i>
                </button>
            </h2>
            <div id="collapseSix" class="faq-content hidden border-t border-slate-100 bg-slate-50/50">
                <div class="p-6 text-slate-600 text-sm leading-relaxed font-medium">
                    You can update your password under the dedicated <strong class="text-slate-800">Settings</strong> page in your student sidebar. Simply enter your current password, type your new password, and click "Update Password".
                </div>
            </div>
        </div>
    </div>

    <!-- Still Have Questions Box -->
    <div class="bg-white border border-slate-200 p-8 rounded-[32px] text-center relative overflow-hidden shadow-premium mt-12">
        <div class="flex justify-center -space-x-3 mb-6">
            <div class="w-10 h-10 rounded-full border-2 border-white bg-primary-600 text-white font-bold flex items-center justify-center text-xs shadow-sm flex-shrink-0">QZ</div>
            <div class="w-10 h-10 rounded-full border-2 border-white bg-amber-500 text-white font-bold flex items-center justify-center text-xs shadow-sm flex-shrink-0">AI</div>
            <div class="w-10 h-10 rounded-full border-2 border-white bg-sky-500 text-white font-bold flex items-center justify-center text-xs shadow-sm flex-shrink-0">ED</div>
        </div>

        <h3 class="text-lg font-extrabold text-slate-900 mb-1.5">Still have questions?</h3>
        <p class="text-slate-400 text-sm mb-6 max-w-sm mx-auto leading-relaxed font-medium">Can't find the answer you're looking for? Reach out to our support team.</p>

        <a href="contact.php" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-sm">
            Contact Support
        </a>
    </div>
</div>

<script>
function toggleFaq(id, btn) {
    const target = document.getElementById(id);
    const icon = btn.querySelector('.faq-icon');
    
    if (target) {
        const isHidden = target.classList.contains('hidden');
        
        // Close all other FAQ items for a clean accordion effect
        document.querySelectorAll('.faq-content').forEach(el => {
            el.classList.add('hidden');
        });
        document.querySelectorAll('.faq-icon').forEach(ic => {
            ic.classList.remove('rotate-180');
        });

        // If it was hidden, open it now
        if (isHidden) {
            target.classList.remove('hidden');
            if (icon) icon.classList.add('rotate-180');
        }
    }
}
</script>

<?php include_once 'includes/footer.php'; ?>