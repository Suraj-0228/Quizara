<?php
$pageTitle = 'FAQ';
include_once 'includes/header.php';
?>

<div class="max-w-3xl mx-auto py-12">
    <div class="text-center mb-10">
        <h1 class="text-4xl font-black text-slate-900 leading-tight mb-3">Frequently Asked <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-primary-800">Questions</span></h1>
        <p class="text-slate-500 text-sm md:text-base">Everything you need to know about Quizara.</p>
    </div>

    <div class="space-y-4">
        <!-- Item 1 -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <h2>
                <button class="w-full flex justify-between items-center bg-transparent py-5 px-6 font-bold text-slate-800 text-left focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                    <span class="flex items-center text-sm">
                        <i class="fas fa-play-circle mr-3.5 text-primary-600 text-lg"></i> How do I start my first quiz?
                    </span>
                    <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                </button>
            </h2>
            <div id="collapseOne" class="collapse hidden border-t border-slate-100 bg-slate-50/30">
                <div class="p-6 text-slate-500 text-xs leading-relaxed">
                    Getting started is easy! Once you log in, go to the <strong>Available Quizzes</strong> section. Browse through categories like Programming, Science, or Math, and click "Take Quiz" to begin. Your results will be saved automatically to your dashboard.
                </div>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <h2>
                <button class="w-full flex justify-between items-center bg-transparent py-5 px-6 font-bold text-slate-800 text-left focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                    <span class="flex items-center text-sm">
                        <i class="fas fa-redo mr-3.5 text-accent-500 text-lg"></i> Can I retake a quiz to improve my score?
                    </span>
                    <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                </button>
            </h2>
            <div id="collapseTwo" class="collapse hidden border-t border-slate-100 bg-slate-50/30">
                <div class="p-6 text-slate-500 text-xs leading-relaxed">
                    Absolutely! We encourage continuous learning. You can retake any quiz as many times as you like. We track every attempt, allowing you to see your improvement over time in your <strong>History</strong> tab.
                </div>
            </div>
        </div>

        <!-- Item 3 -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <h2>
                <button class="w-full flex justify-between items-center bg-transparent py-5 px-6 font-bold text-slate-800 text-left focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                    <span class="flex items-center text-sm">
                        <i class="fas fa-crown mr-3.5 text-amber-500 text-lg"></i> What are the benefits of Quizara Premium?
                    </span>
                    <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                </button>
            </h2>
            <div id="collapseThree" class="collapse hidden border-t border-slate-100 bg-slate-50/30">
                <div class="p-6 text-slate-500 text-xs leading-relaxed">
                    Quizara Premium unlocks advanced features including <strong>detailed explanation videos</strong>, priority support, unlimited retakes for certified quizzes, and exclusive access to "Expert Level" categories across all topics.
                </div>
            </div>
        </div>

        <!-- Item 4 -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <h2>
                <button class="w-full flex justify-between items-center bg-transparent py-5 px-6 font-bold text-slate-800 text-left focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                    <span class="flex items-center text-sm">
                        <i class="fas fa-chart-bar mr-3.5 text-sky-500 text-lg"></i> How is my accuracy and ranking determined?
                    </span>
                    <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                </button>
            </h2>
            <div id="collapseFour" class="collapse hidden border-t border-slate-100 bg-slate-50/30">
                <div class="p-6 text-slate-500 text-xs leading-relaxed">
                    Your ranking on our global leaderboard is based on a combination of your <strong>total score</strong>, <strong>average accuracy</strong>, and the <strong>difficulty</strong> of the quizzes you complete. High accuracy in harder categories yields the most points.
                </div>
            </div>
        </div>

        <!-- Item 5 -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <h2>
                <button class="w-full flex justify-between items-center bg-transparent py-5 px-6 font-bold text-slate-800 text-left focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                    <span class="flex items-center text-sm">
                        <i class="fas fa-certificate mr-3.5 text-rose-500 text-lg"></i> Do I get a certificate after completion?
                    </span>
                    <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                </button>
            </h2>
            <div id="collapseFive" class="collapse hidden border-t border-slate-100 bg-slate-50/30">
                <div class="p-6 text-slate-500 text-xs leading-relaxed">
                    Yes! Upon completing any "Certified Study Path" with a score of 80% or higher, a digital certificate will be generated automatically. You can view and download your certificates from your profile section at any time.
                </div>
            </div>
        </div>

        <!-- Item 6 -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <h2>
                <button class="w-full flex justify-between items-center bg-transparent py-5 px-6 font-bold text-slate-800 text-left focus:outline-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix">
                    <span class="flex items-center text-sm">
                        <i class="fas fa-key mr-3.5 text-slate-500 text-lg"></i> I forgot my password. How do I recover it?
                    </span>
                    <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                </button>
            </h2>
            <div id="collapseSix" class="collapse hidden border-t border-slate-100 bg-slate-50/30">
                <div class="p-6 text-slate-500 text-xs leading-relaxed">
                    If you lose access to your account, please use the "Forgot Password" link on the login page or contact our support team via the <a href="contact.php" class="text-primary-600 hover:text-primary-700 font-bold transition-colors">Contact Support</a> form. We'll help you secure your account within 24 hours.
                </div>
            </div>
        </div>
    </div>

    <!-- Still have questions card -->
    <div class="bg-white border border-slate-200 p-8 rounded-3xl text-center relative overflow-hidden shadow-sm mt-12">
        <div class="flex justify-center -space-x-3 mb-6">
            <div class="w-9 h-9 rounded-full border-2 border-white bg-primary-600 text-white font-bold flex items-center justify-center text-[10px] shadow-sm flex-shrink-0">JS</div>
            <div class="w-9 h-9 rounded-full border-2 border-white bg-accent-500 text-white font-bold flex items-center justify-center text-[10px] shadow-sm flex-shrink-0">ED</div>
            <div class="w-9 h-9 rounded-full border-2 border-white bg-sky-500 text-white font-bold flex items-center justify-center text-[10px] shadow-sm flex-shrink-0">MJ</div>
            <div class="w-9 h-9 rounded-full border-2 border-white bg-slate-100 text-slate-500 font-bold flex items-center justify-center text-[10px] shadow-sm flex-shrink-0"><i class="fas fa-plus text-[8px]"></i></div>
        </div>

        <h3 class="text-base font-extrabold text-slate-800 mb-1.5">Still have questions?</h3>
        <p class="text-slate-400 text-xs mb-6 max-w-sm mx-auto leading-relaxed">Can't find the answer you're looking for? Please contact our friendly team.</p>

        <a href="contact.php" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3 rounded-full shadow-md hover:scale-105 transition-all text-xs">
            Get in Touch
        </a>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>