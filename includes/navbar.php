<nav class="fixed top-4 left-0 w-full z-50 px-4 print:hidden">
    <div class="max-w-6xl mx-auto bg-white/80 border border-slate-200/85 backdrop-blur-md rounded-full shadow-premium px-6 py-3 flex justify-between items-center">
        <!-- Brand -->
        <a class="flex items-center text-primary-600 hover:text-primary-700 transition-colors font-extrabold text-lg tracking-wider" href="<?php echo base_url(); ?>">
            <i class="fas fa-graduation-cap mr-2"></i>Quizara
        </a>

        <!-- Navigation Links (Desktop) -->
        <div class="hidden md:flex items-center space-x-2">
            <a class="text-slate-600 hover:text-primary-600 hover:bg-slate-50/50 font-bold text-sm transition-colors px-4 py-2 rounded-full" href="<?php echo base_url(); ?>">Home</a>
            <a class="text-slate-600 hover:text-primary-600 hover:bg-slate-50/50 font-bold text-sm transition-colors px-4 py-2 rounded-full" href="<?php echo base_url('about.php'); ?>">About</a>
            <a class="text-slate-600 hover:text-primary-600 hover:bg-slate-50/50 font-bold text-sm transition-colors px-4 py-2 rounded-full" href="<?php echo base_url('faq.php'); ?>">FAQ</a>
            <a class="text-slate-600 hover:text-primary-600 hover:bg-slate-50/50 font-bold text-sm transition-colors px-4 py-2 rounded-full" href="<?php echo base_url('contact.php'); ?>">Contact</a>
        </div>

        <!-- Right Menu (Desktop & Mobile trigger) -->
        <div class="flex items-center space-x-3">
            <?php if (isLoggedIn()): ?>
                <!-- Desktop Logged In Action Links -->
                <div class="relative hidden md:block">
                    <button class="flex items-center space-x-2 bg-slate-50 border border-slate-200 hover:bg-slate-100 px-3.5 py-1.5 rounded-full transition-all focus:outline-none" id="desktopUserDropdown" data-bs-toggle="dropdown">
                        <div class="w-7 h-7 rounded-full bg-primary-600 text-white flex items-center justify-content-center text-sm font-bold border-2 border-white shadow-sm">
                            <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                        </div>
                        <span class="text-slate-800 text-sm font-bold"><?php echo sanitize($_SESSION['username']); ?></span>
                        <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                    </button>
                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu absolute right-0 mt-2 w-56 bg-white border border-slate-200 rounded-2xl shadow-premium py-2 hidden z-50">
                        <div class="px-4 py-2 border-b border-slate-100 mb-1 text-center">
                            <div class="text-xs text-slate-400 uppercase font-bold tracking-wider mb-0.5">Account Profile</div>
                            <div class="text-primary-600 font-bold text-sm"><?php echo sanitize($_SESSION['username']); ?></div>
                        </div>
                        <?php if (!isAdmin()): ?>
                            <a class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 font-semibold" href="<?php echo base_url('student/dashboard.php'); ?>"><i class="fas fa-desktop w-5 text-primary-600 mr-2"></i>Student Portal</a>
                            <a class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 font-semibold" href="<?php echo base_url('student/profile.php'); ?>"><i class="fas fa-user-cog w-5 text-primary-600 mr-2"></i>Profile Settings</a>
                            <div class="border-t border-slate-100 my-1"></div>
                        <?php else: ?>
                            <a class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 font-semibold" href="<?php echo base_url('admin/dashboard.php'); ?>"><i class="fas fa-desktop w-5 text-primary-600 mr-2"></i>Admin Control</a>
                            <div class="border-t border-slate-100 my-1"></div>
                        <?php endif; ?>
                        <a class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-bold" href="<?php echo base_url('logout.php'); ?>"><i class="fas fa-power-off w-5 mr-2"></i>Logout</a>
                    </div>
                </div>

                <!-- Mobile User Menu icon -->
                <div class="relative md:hidden">
                    <button class="w-8 h-8 rounded-full bg-primary-600 text-white flex items-center justify-content-center text-sm font-bold border-2 border-white shadow-sm focus:outline-none" id="mobileUserDropdown" data-bs-toggle="dropdown">
                        <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                    </button>
                    <div class="dropdown-menu absolute right-0 mt-2 w-56 bg-white border border-slate-200 rounded-2xl shadow-premium py-2 hidden z-50">
                        <div class="px-4 py-2 border-b border-slate-100 mb-1">
                            <div class="text-xs text-slate-400 uppercase font-bold tracking-wider mb-0.5">Logged in as</div>
                            <div class="text-slate-800 font-bold text-sm truncate"><?php echo sanitize($_SESSION['username']); ?></div>
                        </div>
                        <?php if (!isAdmin()): ?>
                            <a class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 font-semibold" href="<?php echo base_url('student/dashboard.php'); ?>"><i class="fas fa-desktop w-5 text-primary-600 mr-2"></i>Student Portal</a>
                            <a class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 font-semibold" href="<?php echo base_url('student/profile.php'); ?>"><i class="fas fa-user-cog w-5 text-primary-600 mr-2"></i>Profile Settings</a>
                            <div class="border-t border-slate-100 my-1"></div>
                        <?php else: ?>
                            <a class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 font-semibold" href="<?php echo base_url('admin/settings.php'); ?>"><i class="fas fa-cog w-5 text-primary-600 mr-2"></i>System Settings</a>
                            <div class="border-t border-slate-100 my-1"></div>
                        <?php endif; ?>
                        <a class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-bold" href="<?php echo base_url('logout.php'); ?>"><i class="fas fa-sign-out-alt w-5 mr-2"></i>Sign Out</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="hidden md:flex space-x-2">
                    <a href="<?php echo base_url('login.php'); ?>" class="text-primary-600 hover:bg-primary-50 border border-primary-200 font-bold text-sm px-5 py-2 rounded-full transition-all">Login</a>
                    <a href="<?php echo base_url('register.php'); ?>" class="bg-primary-600 hover:bg-primary-700 text-white font-bold text-sm px-5 py-2 rounded-full shadow-md hover:scale-105 transition-all">Join Now</a>
                </div>
            <?php endif; ?>

            <!-- Hamburger Mobile Menu Toggle -->
            <button class="md:hidden w-10 h-10 rounded-full border border-slate-200 bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-700 transition-all focus:outline-none cursor-pointer" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" onclick="quizaraToggleNavbar(event);" aria-label="Toggle navigation">
                <i class="fas fa-bars text-base pointer-events-none"></i>
            </button>
        </div>
    </div>
    
    <!-- Mobile Links (Collapsible) -->
    <div class="hidden md:hidden bg-white/95 backdrop-blur-md border border-slate-200/90 rounded-2xl shadow-premium px-6 py-5 mt-2 max-w-6xl mx-auto z-50 transition-all" id="navbarNav">
        <div class="flex flex-col space-y-3">
            <a class="flex items-center text-slate-700 hover:text-primary-600 font-bold text-sm transition-colors py-1.5" href="<?php echo base_url(); ?>"><i class="fas fa-home w-6 text-primary-500"></i>Home</a>
            <a class="flex items-center text-slate-700 hover:text-primary-600 font-bold text-sm transition-colors py-1.5" href="<?php echo base_url('about.php'); ?>"><i class="fas fa-info-circle w-6 text-primary-500"></i>About</a>
            <a class="flex items-center text-slate-700 hover:text-primary-600 font-bold text-sm transition-colors py-1.5" href="<?php echo base_url('faq.php'); ?>"><i class="fas fa-question-circle w-6 text-primary-500"></i>FAQ</a>
            <a class="flex items-center text-slate-700 hover:text-primary-600 font-bold text-sm transition-colors py-1.5" href="<?php echo base_url('contact.php'); ?>"><i class="fas fa-envelope w-6 text-primary-500"></i>Contact</a>
            <?php if (!isLoggedIn()): ?>
                <div class="border-t border-slate-100 my-2 pt-4 flex space-x-3">
                    <a href="<?php echo base_url('login.php'); ?>" class="text-primary-600 hover:bg-primary-50 border border-primary-200 text-center font-bold text-sm px-4 py-2.5 rounded-full flex-1 transition-all">Sign In</a>
                    <a href="<?php echo base_url('register.php'); ?>" class="bg-primary-600 hover:bg-primary-700 text-white text-center font-bold text-sm px-4 py-2.5 rounded-full shadow-md flex-1 transition-all">Get Started Free</a>
                </div>
            <?php else: ?>
                <div class="border-t border-slate-100 my-2 pt-3 flex flex-col space-y-2">
                    <?php if (!isAdmin()): ?>
                        <a href="<?php echo base_url('student/dashboard.php'); ?>" class="bg-primary-600 text-white text-center font-bold text-sm px-4 py-2.5 rounded-full shadow-md transition-all flex items-center justify-center"><i class="fas fa-desktop mr-2"></i>Student Dashboard</a>
                    <?php else: ?>
                        <a href="<?php echo base_url('admin/dashboard.php'); ?>" class="bg-primary-600 text-white text-center font-bold text-sm px-4 py-2.5 rounded-full shadow-md transition-all flex items-center justify-center"><i class="fas fa-user-shield mr-2"></i>Admin Dashboard</a>
                    <?php endif; ?>
                    <a href="<?php echo base_url('logout.php'); ?>" class="text-red-600 hover:bg-red-50 text-center font-bold text-sm px-4 py-2 rounded-full transition-all flex items-center justify-center"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>