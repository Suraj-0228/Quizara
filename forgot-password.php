<?php include_once 'controllers/forgot-password-process.php'; ?>

<section class="max-w-md mx-auto py-12 px-4">
    <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-premium relative overflow-hidden">
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-red-50 text-red-655 text-red-600 flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fas fa-key"></i>
            </div>
            <h2 class="text-2xl font-black text-red-655 text-red-600 mb-1">Forgot Password</h2>
            <p class="text-slate-400 text-xs font-semibold">Recover your account access</p>
            <p class="text-primary-600 text-[11px] font-bold mt-2 leading-relaxed max-w-xs mx-auto">Enter your email and we'll send a reset link.</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="p-4 mb-6 rounded-2xl bg-red-50 border border-red-200 text-red-655 text-red-600 text-xs font-medium">
                <ul class="list-disc pl-4 space-y-1">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="" method="POST" id="forgotPasswordForm" class="needs-validation" novalidate>
            <!-- Email Input -->
            <div class="relative z-0 w-full mb-8 group border-b-2 border-slate-200 focus-within:border-primary-600 transition-colors">
                <input type="email" class="block py-2.5 px-0 pl-8 w-full text-sm text-slate-800 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 peer" id="email" name="email" placeholder=" ">
                <label for="email" class="peer-focus:font-medium absolute text-sm text-slate-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:left-8 peer-focus:scale-75 peer-focus:-translate-y-6">Email Address</label>
                <i class="fas fa-envelope absolute left-0 top-3 text-slate-400 peer-focus:text-primary-600 text-sm transition-colors"></i>
            </div>

            <div class="mb-6">
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-xs flex items-center justify-center focus:outline-none">
                    Send Recovery Link <i class="fas fa-paper-plane ml-2 text-[10px]"></i>
                </button>
            </div>

            <div class="text-center">
                <p class="text-slate-505 text-xs">
                    Remembered it? <a href="login.php" class="text-primary-600 font-bold ml-1">Return to Login</a>
                </p>
            </div>
        </form>
    </div>
</section>

<script>
    // Validation Script
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<?php include_once 'includes/footer.php'; ?>