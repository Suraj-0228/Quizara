<?php
$pageTitle = 'About Us';
include_once 'includes/header.php';
?>

<!-- Premium Hero Section -->
<section class="py-12 relative overflow-hidden">
    <!-- Decorative background glow -->
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-[radial-gradient(circle_at_center,rgba(124,58,237,0.06),transparent_70%)] -z-10"></div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
            <div class="inline-flex items-center bg-primary-50 border border-primary-100 text-primary-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider mb-6">
                <i class="fas fa-sparkles mr-2"></i> Shaping the Future of Education
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight mb-6">
                Beyond Just <br>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-primary-800">Questions & Answers</span>
            </h1>
            <p class="text-slate-500 text-base md:text-lg mb-8 leading-relaxed">
                Quizara is a modern assessment platform dedicated to transforming how knowledge is shared and validated. We believe learning should be an adventure, not a chore.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 items-center">
                <a href="register.php" class="w-full sm:w-auto text-center bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-xs">Join Us Now</a>
                <a href="#mission" class="text-primary-600 hover:text-primary-700 font-bold text-xs inline-flex items-center">
                    Our Core Story <i class="fas fa-arrow-down ml-2"></i>
                </a>
            </div>
        </div>
        
        <div class="hidden lg:block">
            <div class="relative w-full h-[400px] flex items-center justify-center">
                <!-- Main Card -->
                <div class="w-72 bg-white rounded-3xl border border-slate-200 shadow-premium p-8 text-center rotate-[-3deg] hover:scale-105 transition-all duration-300 z-10">
                    <i class="fas fa-graduation-cap text-5xl text-primary-600 mb-4"></i>
                    <h4 class="font-extrabold text-slate-800 text-lg">100% Digital</h4>
                </div>
                <!-- Sub Card 1 -->
                <div class="absolute top-10 left-4 w-56 bg-white rounded-2xl border border-slate-200 shadow-md p-4 flex items-center rotate-[5deg] hover:scale-105 transition-all duration-300 z-0">
                    <i class="fas fa-chart-line text-accent-500 text-xl mr-3"></i>
                    <div>
                        <div class="font-bold text-slate-800 text-sm">Progress Tracking</div>
                        <div class="text-slate-400 text-xs">Real-time data</div>
                    </div>
                </div>
                <!-- Sub Card 2 -->
                <div class="absolute bottom-10 right-4 w-60 bg-white rounded-2xl border border-slate-200 shadow-md p-4 flex items-center rotate-[-4deg] hover:scale-105 transition-all duration-300 z-0">
                    <i class="fas fa-users text-sky-500 text-xl mr-3"></i>
                    <div>
                        <div class="font-bold text-slate-800 text-sm">Global Learner Base</div>
                        <div class="text-slate-400 text-xs">5k+ Joined</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Impactful Mission Section -->
<section id="mission" class="py-12 bg-white border-y border-slate-200 -mx-4 px-4 md:-mx-8 md:px-8">
    <div class="max-w-4xl mx-auto flex flex-col md:flex-row items-center justify-center gap-6 md:gap-8">
        <div class="w-20 h-20 rounded-full bg-primary-600 text-white flex items-center justify-center shadow-lg flex-shrink-0">
            <i class="fas fa-quote-left text-3xl"></i>
        </div>
        <div>
            <h2 class="font-black text-slate-900 text-2xl mb-2 text-center md:text-left">Our Mission</h2>
            <p class="text-slate-700 text-xl font-medium italic leading-relaxed text-center md:text-left">
                "To create a world where everyone has access to high-quality, engaging, and measurable learning experiences, powered by the best in educational technology."
            </p>
        </div>
    </div>
</section>

<!-- Modern Values Grid -->
<section class="py-16">
    <div class="max-w-2xl mx-auto text-center mb-12">
        <h6 class="text-primary-600 text-xs uppercase font-extrabold tracking-widest mb-2">Driven by excellence</h6>
        <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-3">The Quizara <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-primary-800">Core Values</span></h2>
        <p class="text-slate-500 text-sm md:text-base leading-relaxed">These pillars define every line of code we write and every quiz we host.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Innovation First -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-premium hover:-translate-y-1 transition-all duration-300 h-full">
            <div class="w-12 h-12 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center mb-6">
                <i class="fas fa-bolt text-xl"></i>
            </div>
            <h4 class="font-bold text-slate-900 text-base mb-3">Innovation First</h4>
            <p class="text-slate-400 text-xs leading-relaxed">We are constantly redefining the limits of online testing, using data to make assessments smarter and more engaging every day.</p>
        </div>

        <!-- Student Obsessed -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-premium hover:-translate-y-1 transition-all duration-300 h-full">
            <div class="w-12 h-12 rounded-2xl bg-accent-50 text-accent-600 flex items-center justify-center mb-6">
                <i class="fas fa-fingerprint text-xl"></i>
            </div>
            <h4 class="font-bold text-slate-900 text-base mb-3">Student Obsessed</h4>
            <p class="text-slate-400 text-xs leading-relaxed">Your growth is our North Star. Everything in Quizara is built with the student experience as the top priority.</p>
        </div>

        <!-- Radical Transparency -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-premium hover:-translate-y-1 transition-all duration-300 h-full">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center mb-6">
                <i class="fas fa-hand-holding-heart text-xl"></i>
            </div>
            <h4 class="font-bold text-slate-900 text-base mb-3">Radical Transparency</h4>
            <p class="text-slate-400 text-xs leading-relaxed">We believe in data that speaks for itself. Clear metrics, honest feedback, and open communication with our community.</p>
        </div>
    </div>
</section>

<!-- Stats Strip with Final CTA -->
<section class="py-16 bg-primary-50/40 rounded-3xl border border-primary-100/60 overflow-hidden relative mb-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center px-6 md:px-12">
        <div class="text-center lg:text-left">
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-4 leading-tight">
                Ready to unlock your <br>
                <span class="text-primary-600">full potential?</span>
            </h2>
            <p class="text-slate-500 text-sm leading-relaxed mb-8">
                Join our global community of thousands and start your journey toward mastery today. It only takes 30 seconds to sign up.
            </p>
            <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                <a href="register.php" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-xs">Start Learning Free</a>
                <a href="contact.php" class="border border-primary-200 text-primary-600 hover:bg-primary-50 font-bold px-8 py-3.5 rounded-full transition-all text-xs">Get In Touch</a>
            </div>
        </div>
        
        <div>
            <div class="grid grid-cols-2 gap-4">
                <div class="p-6 rounded-2xl bg-white border border-primary-100 text-center shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-3xl font-extrabold text-slate-800 mb-1">5k+</h3>
                    <div class="text-primary-600 text-[10px] font-bold uppercase tracking-wider">Learners</div>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-primary-100 text-center shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-3xl font-extrabold text-slate-800 mb-1">200+</h3>
                    <div class="text-primary-600 text-[10px] font-bold uppercase tracking-wider">Quizzes</div>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-primary-100 text-center shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-3xl font-extrabold text-slate-800 mb-1">98%</h3>
                    <div class="text-primary-600 text-[10px] font-bold uppercase tracking-wider">Success</div>
                </div>
                <div class="p-6 rounded-2xl bg-white border border-primary-100 text-center shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-3xl font-extrabold text-slate-800 mb-1">24/7</h3>
                    <div class="text-primary-600 text-[10px] font-bold uppercase tracking-wider">Support</div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once 'includes/footer.php'; ?>