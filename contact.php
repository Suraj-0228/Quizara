<?php include_once 'controllers/contact-process.php'; ?>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 py-12 items-center">
    <!-- Contact Info Column -->
    <div>
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight mb-4">Let's <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-primary-800">Connect</span></h1>
        <p class="text-slate-500 text-base leading-relaxed mb-8">
            We're here to help and answer any question you might have. We look forward to hearing from you.
        </p>

        <!-- Email card -->
        <div class="flex items-center mb-6">
            <div class="w-12 h-12 rounded-2xl bg-primary-50 text-primary-600 flex items-center justify-center mr-4 flex-shrink-0 border border-primary-100">
                <i class="fas fa-envelope"></i>
            </div>
            <div>
                <h5 class="text-sm font-bold text-slate-800 mb-0.5">Email Us</h5>
                <p class="text-slate-500 text-sm font-semibold">quizmastera524@gmail.com</p>
            </div>
        </div>

        <!-- Phone card -->
        <div class="flex items-center mb-6">
            <div class="w-12 h-12 rounded-2xl bg-accent-50 text-accent-600 flex items-center justify-center mr-4 flex-shrink-0 border border-accent-100">
                <i class="fas fa-phone"></i>
            </div>
            <div>
                <h5 class="text-sm font-bold text-slate-800 mb-0.5">Call Us</h5>
                <p class="text-slate-500 text-sm font-semibold">+1 (555) 123-4567</p>
            </div>
        </div>

        <!-- Address card -->
        <div class="flex items-center mb-8">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center mr-4 flex-shrink-0 border border-sky-100">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div>
                <h5 class="text-sm font-bold text-slate-800 mb-0.5">Visit Us</h5>
                <p class="text-slate-500 text-sm font-semibold">123 Education Lane, Tech City</p>
            </div>
        </div>

        <!-- Social links -->
        <div class="flex gap-3">
            <a href="#" class="w-9 h-9 border border-slate-200 text-slate-400 hover:border-transparent hover:bg-primary-600 hover:text-white rounded-full flex items-center justify-center transition-all text-sm"><i class="fab fa-twitter"></i></a>
            <a href="#" class="w-9 h-9 border border-slate-200 text-slate-400 hover:border-transparent hover:bg-primary-600 hover:text-white rounded-full flex items-center justify-center transition-all text-sm"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="w-9 h-9 border border-slate-200 text-slate-400 hover:border-transparent hover:bg-primary-600 hover:text-white rounded-full flex items-center justify-center transition-all text-sm"><i class="fab fa-instagram"></i></a>
            <a href="#" class="w-9 h-9 border border-slate-200 text-slate-400 hover:border-transparent hover:bg-primary-600 hover:text-white rounded-full flex items-center justify-center transition-all text-sm"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>

    <!-- Contact Form Column -->
    <div>
        <?php if ($message): 
            $is_success = ($messageType == 'success');
            $bgColor = $is_success ? 'bg-emerald-50' : 'bg-rose-50';
            $textColor = $is_success ? 'text-emerald-900' : 'text-rose-900';
            $borderColor = $is_success ? 'border-emerald-200' : 'border-rose-200';
            $icon = $is_success ? '<i class="fas fa-check-circle mr-3 text-emerald-500 text-lg flex-shrink-0"></i>' : '<i class="fas fa-exclamation-circle mr-3 text-rose-500 text-lg flex-shrink-0"></i>';
        ?>
            <div class="flash-alert-msg alert-dismissible p-4 mb-6 rounded-2xl border shadow-sm flex items-center justify-between transition-all duration-500 transform translate-y-0 opacity-100 <?php echo $bgColor . ' ' . $textColor . ' ' . $borderColor; ?>" role="alert">
                <div class="flex items-center text-sm font-extrabold">
                    <?php echo $icon; ?>
                    <span><?php echo $message; ?></span>
                </div>
                <button type="button" class="ml-4 text-slate-400 hover:text-slate-700 focus:outline-none flex items-center justify-center p-1 transition-colors" onclick="this.closest('.flash-alert-msg').remove()" aria-label="Close">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-[32px] border border-slate-200 p-8 md:p-10 shadow-premium relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 p-6 opacity-[0.03] -z-10">
                <i class="fas fa-paper-plane text-8xl text-primary-600 rotate-[-20deg]"></i>
            </div>

            <h3 class="font-extrabold text-slate-900 text-xl mb-1">Send a Message</h3>
            <p class="text-slate-400 text-sm mb-8">We usually respond within 24 hours.</p>

            <form action="" method="POST" class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Name input -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Your Name</label>
                        <div class="relative">
                            <input type="text" name="name" id="name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pl-10 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all" placeholder="John Doe" />
                            <i class="fas fa-user absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                        </div>
                    </div>

                    <!-- Email input -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Email Address</label>
                        <div class="relative">
                            <input type="email" name="email" id="email" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pl-10 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all" placeholder="john@example.com" />
                            <i class="fas fa-envelope absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                        </div>
                    </div>
                </div>

                <!-- Subject input -->
                <div>
                    <label for="subject" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Subject</label>
                    <div class="relative">
                        <select name="subject" id="subject" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pl-10 pr-10 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all appearance-none cursor-pointer">
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Support">Technical Support</option>
                            <option value="Feedback">Feedback</option>
                            <option value="Partnership">Partnership</option>
                        </select>
                        <i class="fas fa-tag absolute left-3.5 top-3.5 text-slate-400 text-sm pointer-events-none"></i>
                        <i class="fas fa-chevron-down absolute right-4 top-3.5 text-slate-400 text-sm pointer-events-none"></i>
                    </div>
                </div>

                <!-- Message input -->
                <div>
                    <label for="message" class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Your Message</label>
                    <div class="relative">
                        <textarea name="message" id="message" rows="4" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pl-10 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all resize-none" placeholder="Type your message here..."></textarea>
                        <i class="fas fa-comment-alt absolute left-3.5 top-3.5 text-slate-400 text-sm"></i>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-sm flex items-center justify-center focus:outline-none">
                        Send Message <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>