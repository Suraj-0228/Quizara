<?php include_once 'controllers/register-process.php'; ?>

<section class="max-w-md mx-auto py-12 px-4">
    <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-premium relative overflow-hidden">
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2 class="text-2xl font-black text-slate-900 mb-1">Create Account</h2>
            <p class="text-slate-400 text-xs font-semibold">Start your learning journey today</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="p-4 mb-2 rounded-2xl bg-red-50 border border-red-200 text-red-655 text-red-600 text-xs font-medium">
                <ul class="list-disc pl-4 space-y-1">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="" method="POST" id="registerForm" class="space-y-2">
            <!-- Username Input -->
            <div class="relative z-0 w-full group border-b-2 border-slate-200 focus-within:border-primary-600 transition-colors">
                <input type="text" class="block py-2.5 px-0 pl-8 w-full text-sm text-slate-800 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 peer" id="username" name="username" placeholder=" " value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
                <label for="username" class="peer-focus:font-medium absolute text-sm text-slate-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:left-8 peer-focus:scale-75 peer-focus:-translate-y-6">Choose Username</label>
                <i class="fas fa-user absolute left-0 top-3 text-slate-400 peer-focus:text-primary-600 text-sm transition-colors"></i>
            </div>

            <!-- Email Input -->
            <div class="relative z-0 w-full group border-b-2 border-slate-200 focus-within:border-primary-600 transition-colors">
                <input type="email" class="block py-2.5 px-0 pl-8 w-full text-sm text-slate-800 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 peer" id="email" name="email" placeholder=" " value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                <label for="email" class="peer-focus:font-medium absolute text-sm text-slate-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:left-8 peer-focus:scale-75 peer-focus:-translate-y-6">Email Address</label>
                <i class="fas fa-envelope absolute left-0 top-3 text-slate-400 peer-focus:text-primary-600 text-sm transition-colors"></i>
            </div>

            <!-- Password Input -->
            <div class="relative z-0 w-full group border-b-2 border-slate-200 focus-within:border-primary-600 transition-colors">
                <input type="password" class="block py-2.5 px-0 pl-8 w-full text-sm text-slate-800 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 peer" id="password" name="password" placeholder=" ">
                <label for="password" class="peer-focus:font-medium absolute text-sm text-slate-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:left-8 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                <i class="fas fa-lock absolute left-0 top-3 text-slate-400 peer-focus:text-primary-600 text-sm transition-colors"></i>
                <i class="fas fa-eye password-toggle absolute right-3 top-3 text-slate-400 hover:text-slate-600 cursor-pointer text-sm"></i>
            </div>

            <!-- Confirm Password Input -->
            <div class="relative z-0 w-full group border-b-2 border-slate-200 focus-within:border-primary-600 transition-colors">
                <input type="password" class="block py-2.5 px-0 pl-8 w-full text-sm text-slate-800 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 peer" id="confirm_password" name="confirm_password" placeholder=" ">
                <label for="confirm_password" class="peer-focus:font-medium absolute text-sm text-slate-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:left-8 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm Password</label>
                <i class="fas fa-shield-alt absolute left-0 top-3 text-slate-400 peer-focus:text-primary-600 text-sm transition-colors"></i>
                <i class="fas fa-eye password-toggle absolute right-3 top-3 text-slate-400 hover:text-slate-600 cursor-pointer text-sm"></i>
            </div>

            <div>
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-xs flex items-center justify-center focus:outline-none">
                    Create Account <i class="fas fa-rocket ml-2 text-[10px]"></i>
                </button>
            </div>

            <div class="text-center pt-2">
                <p class="text-slate-505 text-xs">
                    Already have an account? <a href="login.php" class="text-primary-600 font-bold ml-1">Sign In instead</a>
                </p>

                <div class="mt-6 pt-6 border-t border-slate-100 flex justify-center space-x-6">
                    <div class="flex items-center text-slate-400 text-xs font-semibold">
                        <i class="fas fa-check-circle text-emerald-500 mr-1.5"></i>
                        <span>Free Access</span>
                    </div>
                    <div class="flex items-center text-slate-400 text-xs font-semibold">
                        <i class="fas fa-check-circle text-emerald-500 mr-1.5"></i>
                        <span>Analytics</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include_once 'includes/footer.php'; ?>