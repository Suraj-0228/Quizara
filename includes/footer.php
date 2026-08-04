</div> <!-- End Container -->

<?php if (isLoggedIn()): ?>
    </div> <!-- End Main Content (Admin or Student) -->
<?php else: ?>
    <footer class="bg-white border-t border-slate-200 mt-auto py-12">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Brand Column -->
                <div class="space-y-4">
                    <a href="<?php echo base_url(); ?>" class="flex items-center text-primary-600 hover:text-primary-700 transition-colors">
                        <i class="fas fa-graduation-cap text-2xl mr-2"></i>
                        <span class="text-xl font-extrabold text-slate-900 tracking-wider">Quizara</span>
                    </a>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Empowering students and professionals to master new skills through interactive assessments and data-driven insights.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-primary-600 hover:text-white hover:border-transparent transition-all"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-primary-600 hover:text-white hover:border-transparent transition-all"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-primary-600 hover:text-white hover:border-transparent transition-all"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-primary-600 hover:text-white hover:border-transparent transition-all"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Explore Links -->
                <div>
                    <h5 class="text-slate-900 font-bold text-sm uppercase tracking-wider mb-4">Explore</h5>
                    <ul class="space-y-2">
                        <li><a href="<?php echo base_url(); ?>" class="text-slate-500 hover:text-primary-600 text-sm transition-colors">Home</a></li>
                        <li><a href="<?php echo base_url('student/quizzes.php'); ?>" class="text-slate-500 hover:text-primary-600 text-sm transition-colors">Quizzes</a></li>
                        <li><a href="<?php echo base_url('about.php'); ?>" class="text-slate-500 hover:text-primary-600 text-sm transition-colors">About Us</a></li>
                    </ul>
                </div>

                <!-- Support Links -->
                <div>
                    <h5 class="text-slate-900 font-bold text-sm uppercase tracking-wider mb-4">Support</h5>
                    <ul class="space-y-2">
                        <li><a href="<?php echo base_url('faq.php'); ?>" class="text-slate-500 hover:text-primary-600 text-sm transition-colors">Help Center</a></li>
                        <li><a href="<?php echo base_url('contact.php'); ?>" class="text-slate-500 hover:text-primary-600 text-sm transition-colors">Contact Us</a></li>
                        <li><a href="<?php echo base_url('privacy.php'); ?>" class="text-slate-500 hover:text-primary-600 text-sm transition-colors">Privacy Policy</a></li>
                        <li><a href="<?php echo base_url('terms.php'); ?>" class="text-slate-500 hover:text-primary-600 text-sm transition-colors">Terms of Service</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h5 class="text-slate-900 font-bold text-sm uppercase tracking-wider mb-4">Stay Updated</h5>
                    <p class="text-slate-500 text-sm mb-3">Subscribe to our newsletter for new quizzes and learning tips.</p>
                    <form action="#" class="mb-3">
                        <div class="flex shadow-sm rounded-lg overflow-hidden border border-slate-200">
                            <input type="email" class="flex-grow px-3 py-2 text-sm bg-white focus:outline-none text-slate-800" placeholder="Your email address">
                            <button class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 transition-colors" type="button"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                    <p class="text-slate-400 text-sm flex items-center">
                        <i class="fas fa-lock mr-1.5"></i> Secure subscription
                    </p>
                </div>
            </div>

            <hr class="my-8 border-slate-200">

            <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left gap-4">
                <p class="text-slate-400 text-sm">&copy; <?php echo date('Y'); ?> Quizara. All rights reserved.</p>
                <p class="text-slate-400 text-sm hidden md:block">Built with <i class="fas fa-lightbulb text-warning mx-1"></i> for learning and growth</p>
            </div>
        </div>
    </footer>
<?php endif; ?>

<!-- Custom JS -->
<script src="<?php echo base_url('assets/js/validation.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
</body>

</html>