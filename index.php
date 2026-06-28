<?php
$pageTitle = 'Home';
include_once 'includes/header.php';
?>

<!-- Hero Section (2-Column Premium Asymmetric Layout) -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20">
    <!-- Hero Left Info -->
    <div class="lg:col-span-7 text-left space-y-6">
        <div class="inline-flex items-center bg-primary-50 border border-primary-100 text-primary-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider">
            <i class="fas fa-sparkles mr-2"></i> Elevate Your Knowledge
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 leading-[1.1] tracking-tight">
            Unlock Your <br class="hidden sm:inline">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-primary-800">Learning Potential</span>
        </h1>

        <p class="text-slate-500 text-base md:text-lg leading-relaxed max-w-xl">
            The ultimate intelligent platform to test your knowledge, challenge your peers, and architect your learning journey with precision.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 pt-2">
            <?php if (isLoggedIn()): ?>
                <?php if (isAdmin()): ?>
                    <a href="admin/dashboard.php" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3.5 rounded-full shadow-lg hover:scale-105 transition-all text-xs flex items-center justify-center sm:justify-start w-full sm:w-auto">
                        Admin Portal <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
                    </a>
                <?php else: ?>
                    <a href="student/dashboard.php" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3.5 rounded-full shadow-lg hover:scale-105 transition-all text-xs flex items-center justify-center sm:justify-start w-full sm:w-auto">
                        Start Learning <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <a href="register.php" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3.5 rounded-full shadow-lg hover:scale-105 transition-all text-xs text-center w-full sm:w-auto">Get Started Free</a>
                <a href="login.php" class="border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold px-8 py-3.5 rounded-full transition-all text-xs text-center w-full sm:w-auto">Sign In</a>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-3 gap-4 pt-6 border-t border-slate-100 max-w-md">
            <div>
                <div class="font-extrabold text-slate-900 text-base mb-0.5">1k+</div>
                <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Active Users</div>
            </div>
            <div>
                <div class="font-extrabold text-slate-900 text-base mb-0.5">500+</div>
                <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">Quizzes</div>
            </div>
            <div>
                <div class="font-extrabold text-slate-900 text-base mb-0.5">4.9/5</div>
                <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider">User Rating</div>
            </div>
        </div>
    </div>

    <!-- Hero Right Graphic (Interactive elements) -->
    <div class="lg:col-span-5 relative hidden lg:block">
        <div class="w-full h-[400px] rounded-[48px] bg-gradient-to-tr from-primary-50 to-primary-100/50 border border-primary-100/40 relative overflow-hidden flex items-center justify-center">
            <!-- Decorative circle glow -->
            <div class="absolute w-72 h-72 rounded-full bg-primary-200/30 blur-3xl -top-20 -right-20"></div>
            
            <!-- Graphic 1: Trophy Badge -->
            <div class="absolute top-10 left-6 bg-white border border-slate-200 rounded-3xl p-4 shadow-premium flex items-center w-56 animate-float-1">
                <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mr-3 flex-shrink-0">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="min-w-0">
                    <h6 class="font-extrabold text-slate-800 text-xs truncate">Top Scorer</h6>
                    <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider block">Achieve Greatness</span>
                </div>
            </div>

            <!-- Graphic 2: Real-time score -->
            <div class="absolute bottom-12 left-10 bg-white border border-slate-200 rounded-3xl p-5 shadow-premium w-48 text-center animate-float-2">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-1">XP Points</span>
                <span class="text-3xl font-black text-primary-600 leading-none">850</span>
            </div>

            <!-- Graphic 3: Passed Notif -->
            <div class="absolute top-36 right-4 bg-white border border-slate-200 rounded-3xl p-4 shadow-premium flex items-center w-52 animate-float-3">
                <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center mr-3 shadow-md shadow-emerald-500/20 flex-shrink-0">
                    <i class="fas fa-check text-xs"></i>
                </div>
                <div class="min-w-0">
                    <h6 class="font-extrabold text-slate-800 text-xs">Quiz Passed</h6>
                    <span class="text-emerald-500 text-[10px] font-bold block">Score: 92%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popular Categories -->
<section class="py-12 position-relative">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-10 gap-4">
        <div>
            <h6 class="text-primary-600 text-xs uppercase font-extrabold tracking-widest mb-2">Curated for you</h6>
            <h2 class="text-3xl md:text-4xl font-black text-slate-900">Popular <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-primary-800">Categories</span></h2>
            <p class="text-slate-500 mt-1 text-sm">Discover quizzes across 20+ specialized topics</p>
        </div>
        <div class="hidden md:block flex-shrink-0">
            <a href="student/quizzes.php" class="text-primary-600 hover:text-primary-700 font-bold text-xs inline-flex items-center group transition-colors">
                Browse All Categories <i class="fas fa-chevron-right ml-1.5 text-[10px] group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Category 1 -->
        <div class="group bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-premium hover:-translate-y-2 transition-all duration-300 p-6 relative">
            <div class="absolute -top-12 -right-12 w-32 h-32 rounded-full bg-primary-600/5 group-hover:scale-150 transition-all duration-500"></div>
            <div class="relative z-1">
                <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center mb-6 text-primary-600 group-hover:bg-primary-600 group-hover:text-white group-hover:rotate-[-6deg] transition-all duration-300 shadow-sm">
                    <i class="fas fa-code text-lg"></i>
                </div>
                <h4 class="font-bold text-slate-900 text-base mb-2">Programming</h4>
                <p class="text-slate-400 text-xs leading-relaxed mb-6">Master Python, Java, and modern web frameworks.</p>
                <div class="flex items-center justify-between">
                    <span class="bg-primary-50 text-primary-600 text-[10px] font-bold px-3 py-1 rounded-full">120+ Quizzes</span>
                    <a href="student/quizzes.php?category=programming" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-primary-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Category 2 -->
        <div class="group bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-premium hover:-translate-y-2 transition-all duration-300 p-6 relative">
            <div class="absolute -top-12 -right-12 w-32 h-32 rounded-full bg-accent-600/5 group-hover:scale-150 transition-all duration-500"></div>
            <div class="relative z-1">
                <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center mb-6 text-accent-600 group-hover:bg-accent-600 group-hover:text-white group-hover:rotate-[-6deg] transition-all duration-300 shadow-sm">
                    <i class="fas fa-flask text-lg"></i>
                </div>
                <h4 class="font-bold text-slate-900 text-base mb-2">Science</h4>
                <p class="text-slate-400 text-xs leading-relaxed mb-6">Explore Biology, Chemistry, and Quantum Physics.</p>
                <div class="flex items-center justify-between">
                    <span class="bg-accent-50 text-accent-600 text-[10px] font-bold px-3 py-1 rounded-full">85+ Quizzes</span>
                    <a href="student/quizzes.php?category=science" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-accent-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Category 3 -->
        <div class="group bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-premium hover:-translate-y-2 transition-all duration-300 p-6 relative">
            <div class="absolute -top-12 -right-12 w-32 h-32 rounded-full bg-amber-600/5 group-hover:scale-150 transition-all duration-500"></div>
            <div class="relative z-1">
                <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center mb-6 text-amber-600 group-hover:bg-amber-600 group-hover:text-white group-hover:rotate-[-6deg] transition-all duration-300 shadow-sm">
                    <i class="fas fa-calculator text-lg"></i>
                </div>
                <h4 class="font-bold text-slate-900 text-base mb-2">Mathematics</h4>
                <p class="text-slate-400 text-xs leading-relaxed mb-6">From basic Algebra to advanced Calculus.</p>
                <div class="flex items-center justify-between">
                    <span class="bg-amber-50 text-amber-600 text-[10px] font-bold px-3 py-1 rounded-full">60+ Quizzes</span>
                    <a href="student/quizzes.php?category=math" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Category 4 -->
        <div class="group bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-premium hover:-translate-y-2 transition-all duration-300 p-6 relative">
            <div class="absolute -top-12 -right-12 w-32 h-32 rounded-full bg-sky-600/5 group-hover:scale-150 transition-all duration-500"></div>
            <div class="relative z-1">
                <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center mb-6 text-sky-600 group-hover:bg-sky-600 group-hover:text-white group-hover:rotate-[-6deg] transition-all duration-300 shadow-sm">
                    <i class="fas fa-globe-americas text-lg"></i>
                </div>
                <h4 class="font-bold text-slate-900 text-base mb-2">History</h4>
                <p class="text-slate-400 text-xs leading-relaxed mb-6">Journey through civilizations and turning points.</p>
                <div class="flex items-center justify-between">
                    <span class="bg-sky-50 text-sky-600 text-[10px] font-bold px-3 py-1 rounded-full">95+ Quizzes</span>
                    <a href="student/quizzes.php?category=history" class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-sky-600 group-hover:text-white transition-all duration-300 shadow-sm">
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-12">
    <div class="max-w-xl mx-auto text-center mb-12">
        <h6 class="text-primary-600 text-xs uppercase font-extrabold tracking-widest mb-2">Process</h6>
        <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-3">How It Works</h2>
        <p class="text-slate-500 text-sm">Start your learning journey in simple steps</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Step 1 -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-premium hover:-translate-y-2 transition-all duration-300 text-center relative h-full">
            <div class="flex justify-center mb-6">
                <div class="relative">
                    <div class="bg-primary-50 rounded-full p-4 border border-primary-100 text-primary-600">
                        <i class="fas fa-user-plus text-xl"></i>
                    </div>
                    <span class="absolute -top-1.5 -right-1.5 w-5 h-5 rounded-full bg-primary-600 text-white text-[10px] font-bold flex items-center justify-center border-2 border-white shadow-sm">1</span>
                </div>
            </div>
            <h4 class="font-bold text-slate-900 text-base mb-3">Sign Up</h4>
            <p class="text-slate-400 text-xs leading-relaxed">Create your free account in seconds. Join a community of eager learners.</p>
        </div>

        <!-- Step 2 -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-premium hover:-translate-y-2 transition-all duration-300 text-center relative h-full">
            <div class="flex justify-center mb-6">
                <div class="relative">
                    <div class="bg-primary-50 rounded-full p-4 border border-primary-100 text-primary-600">
                        <i class="fas fa-tasks text-xl"></i>
                    </div>
                    <span class="absolute -top-1.5 -right-1.5 w-5 h-5 rounded-full bg-primary-600 text-white text-[10px] font-bold flex items-center justify-center border-2 border-white shadow-sm">2</span>
                </div>
            </div>
            <h4 class="font-bold text-slate-900 text-base mb-3">Take Quizzes</h4>
            <p class="text-slate-400 text-xs leading-relaxed">Choose from a variety of categories and challenge yourself with interactive quizzes.</p>
        </div>

        <!-- Step 3 -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-premium hover:-translate-y-2 transition-all duration-300 text-center relative h-full">
            <div class="flex justify-center mb-6">
                <div class="relative">
                    <div class="bg-primary-50 rounded-full p-4 border border-primary-100 text-primary-600">
                        <i class="fas fa-trophy text-xl"></i>
                    </div>
                    <span class="absolute -top-1.5 -right-1.5 w-5 h-5 rounded-full bg-primary-600 text-white text-[10px] font-bold flex items-center justify-center border-2 border-white shadow-sm">3</span>
                </div>
            </div>
            <h4 class="font-bold text-slate-900 text-base mb-3">Get Results</h4>
            <p class="text-slate-400 text-xs leading-relaxed">Receive instant feedback, track your progress, and climb the leaderboard.</p>
        </div>
    </div>
</section>

<!-- Features Grid -->
<section class="py-12 text-center">
    <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-12">Why Choose Quizara?</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-premium hover:-translate-y-1 transition-all duration-300 h-full">
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-bolt text-xl"></i>
            </div>
            <h4 class="font-bold text-slate-900 text-base mb-3">Instant Feedback</h4>
            <p class="text-slate-400 text-xs leading-relaxed">Get detailed explanations and scores immediately after completing a quiz.</p>
        </div>
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-premium hover:-translate-y-1 transition-all duration-300 h-full">
            <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-500 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-chart-bar text-xl"></i>
            </div>
            <h4 class="font-bold text-slate-900 text-base mb-3">Detailed Analytics</h4>
            <p class="text-slate-400 text-xs leading-relaxed">Track your progress over time with comprehensive charts and performance reports.</p>
        </div>
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-premium hover:-translate-y-1 transition-all duration-300 h-full">
            <div class="w-14 h-14 rounded-2xl bg-accent-50 text-accent-500 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-mobile-alt text-xl"></i>
            </div>
            <h4 class="font-bold text-slate-900 text-base mb-3">Mobile Friendly</h4>
            <p class="text-slate-400 text-xs leading-relaxed">Study on the go. Our platform is fully responsive and optimized for any device.</p>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-12 mb-8">
    <div class="max-w-xl mx-auto text-center mb-12">
        <h6 class="text-amber-500 text-xs uppercase font-extrabold tracking-widest mb-2">Testimonials</h6>
        <h2 class="text-3xl md:text-4xl font-black text-slate-900 mb-3">What Users Say</h2>
        <p class="text-slate-500 text-sm">Join thousands of satisfied learners worldwide</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Testimonial 1 -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-premium hover:-translate-y-2 transition-all duration-300 relative overflow-hidden group flex flex-col h-full">
            <div class="absolute -top-4 -left-2 text-9xl text-slate-100 font-serif leading-none select-none opacity-40 group-hover:text-primary-50 transition-colors">"</div>
            <div class="flex text-amber-400 space-x-1 mb-4 relative z-1">
                <i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i>
            </div>
            <p class="text-slate-600 text-sm font-medium italic mb-6 leading-relaxed relative z-1">"Quizara has transformed the way I revise for my exams. The instant feedback is incredibly helpful!"</p>
            <div class="flex items-center mt-auto relative z-1">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-rose-500 to-rose-400 text-white font-bold flex items-center justify-center shadow-md shadow-rose-500/10 mr-3 text-xs">JS</div>
                <div>
                    <h6 class="text-slate-800 mb-0 font-bold text-xs">John Smith</h6>
                    <small class="text-slate-400 text-[10px]">Computer Science Student</small>
                </div>
            </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-premium hover:-translate-y-2 transition-all duration-300 relative overflow-hidden group flex flex-col h-full">
            <div class="absolute -top-4 -left-2 text-9xl text-slate-100 font-serif leading-none select-none opacity-40 group-hover:text-primary-50 transition-colors">"</div>
            <div class="flex text-amber-400 space-x-1 mb-4 relative z-1">
                <i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star-half-alt text-sm"></i>
            </div>
            <p class="text-slate-600 text-sm font-medium italic mb-6 leading-relaxed relative z-1">"The variety of categories keeps me engaged. I've learned so much about history and science just for fun."</p>
            <div class="flex items-center mt-auto relative z-1">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-emerald-500 to-emerald-400 text-white font-bold flex items-center justify-center shadow-md shadow-emerald-500/10 mr-3 text-xs">ED</div>
                <div>
                    <h6 class="text-slate-800 mb-0 font-bold text-xs">Emily Davis</h6>
                    <small class="text-slate-400 text-[10px]">Lifelong Learner</small>
                </div>
            </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm hover:shadow-premium hover:-translate-y-2 transition-all duration-300 relative overflow-hidden group flex flex-col h-full">
            <div class="absolute -top-4 -left-2 text-9xl text-slate-100 font-serif leading-none select-none opacity-40 group-hover:text-primary-50 transition-colors">"</div>
            <div class="flex text-amber-400 space-x-1 mb-4 relative z-1">
                <i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i><i class="fas fa-star text-sm"></i>
            </div>
            <p class="text-slate-600 text-sm font-medium italic mb-6 leading-relaxed relative z-1">"A fantastic platform! The interface is beautiful, and studying on my phone has never been easier."</p>
            <div class="flex items-center mt-auto relative z-1">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-sky-500 to-sky-400 text-white font-bold flex items-center justify-center shadow-md shadow-sky-500/10 mr-3 text-xs">MJ</div>
                <div>
                    <h6 class="text-slate-800 mb-0 font-bold text-xs">Michael Johnson</h6>
                    <small class="text-slate-400 text-[10px]">Web Developer</small>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once 'includes/footer.php'; ?>