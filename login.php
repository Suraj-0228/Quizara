<?php include_once 'controllers/login-process.php'; ?>

<section class="max-w-md mx-auto py-12 px-4">
    <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-premium relative overflow-hidden">
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-primary-50 text-primary-600 border border-primary-100/30 flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fas fa-lock-open"></i>
            </div>
            <h2 class="text-2xl font-black text-slate-900 mb-1">Welcome Back</h2>
            <p class="text-slate-400 text-xs font-semibold">Continue your learning journey</p>
        </div>

        <?php if ($error): ?>
            <div class="p-4 mb-6 rounded-2xl bg-red-50 border border-red-200 text-red-655 text-red-600 text-sm font-medium flex items-center">
                <i class="fas fa-exclamation-circle mr-2.5"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" id="loginForm">
            <!-- Email Input -->
            <div class="relative z-0 w-full mb-2 group border-b-2 border-slate-200 focus-within:border-primary-600 transition-colors">
                <input type="text" class="block py-2.5 px-0 pl-8 w-full text-sm text-slate-800 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 peer" id="email" name="email" placeholder=" " value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                <label for="email" class="peer-focus:font-medium absolute text-sm text-slate-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:left-8 peer-focus:scale-75 peer-focus:-translate-y-6">Email or Username</label>
                <i class="fas fa-user absolute left-0 top-3 text-slate-400 peer-focus:text-primary-600 text-sm transition-colors"></i>
            </div>

            <!-- Password Input -->
            <div class="relative z-0 w-full mb-2 group border-b-2 border-slate-200 focus-within:border-primary-600 transition-colors">
                <input type="password" class="block py-2.5 px-0 pl-8 w-full text-sm text-slate-800 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 peer" id="password" name="password" placeholder=" ">
                <label for="password" class="peer-focus:font-medium absolute text-sm text-slate-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:left-8 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                <i class="fas fa-key absolute left-0 top-3 text-slate-400 peer-focus:text-primary-600 text-sm transition-colors"></i>
                <i class="fas fa-eye password-toggle absolute right-3 top-3 text-slate-400 hover:text-slate-600 cursor-pointer text-sm"></i>
            </div>

            <div class="flex justify-between items-center mt-5 mb-6">
                <label class="flex items-center text-slate-500 text-xs font-semibold cursor-pointer">
                    <input type="checkbox" id="remember" class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500 mr-2">
                    Remember Me
                </label>
                <a href="forgot-password.php" class="text-red-550 hover:text-red-655 text-red-600 hover:text-red-700 font-bold text-xs">Recovery Password?</a>
            </div>

            <div class="mb-6">
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-xs flex items-center justify-center focus:outline-none">
                    Sign In Now <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
                </button>
            </div>

            <div class="text-center">
                <p class="text-slate-400 text-xs mb-4">Or continue with</p>

                <div class="flex justify-center space-x-3 mb-6">
                    <a href="#" class="w-10 h-10 border border-slate-200 text-slate-400 hover:border-transparent hover:bg-primary-600 hover:text-white rounded-full flex items-center justify-center transition-all"><i class="fab fa-google text-sm"></i></a>
                    <a href="#" class="w-10 h-10 border border-slate-200 text-slate-400 hover:border-transparent hover:bg-primary-600 hover:text-white rounded-full flex items-center justify-center transition-all"><i class="fab fa-github text-sm"></i></a>
                </div>

                <p class="text-slate-500 text-xs">
                    New to Quizara? <a href="register.php" class="text-primary-600 font-bold ml-1">Create an Account</a>
                </p>
            </div>
        </form>
    </div>
</section>

<?php include_once 'includes/footer.php'; ?>