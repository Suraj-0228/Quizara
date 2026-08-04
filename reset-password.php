<?php include_once 'controllers/reset-password-process.php'; ?>

<section class="max-w-md mx-auto py-12 px-4">
    <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-premium relative overflow-hidden">
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h2 class="text-2xl font-black text-emerald-600 mb-1">Set New Password</h2>
            <p class="text-slate-400 text-sm font-semibold">Secure your account with a new password</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="p-4 mb-6 rounded-2xl bg-red-50 border border-red-200 text-red-600 text-sm font-medium">
                <ul class="list-disc pl-4 space-y-1">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="needs-validation" novalidate>
            <!-- IMPORTANT: Hidden token input -->
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">

            <!-- New Password Input -->
            <div class="relative z-0 w-full mb-6 group border-b-2 border-slate-200 focus-within:border-primary-600 transition-colors">
                <input type="password" class="block py-2.5 px-0 pl-8 w-full text-sm text-slate-800 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 peer" id="password" name="password" placeholder=" " minlength="6">
                <label for="password" class="peer-focus:font-medium absolute text-sm text-slate-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:left-8 peer-focus:scale-75 peer-focus:-translate-y-6">New Password</label>
                <i class="fas fa-lock absolute left-0 top-3 text-slate-400 peer-focus:text-primary-600 text-sm transition-colors"></i>
                <i class="fas fa-eye password-toggle absolute right-3 top-3 text-slate-400 hover:text-slate-600 cursor-pointer text-sm"></i>
            </div>

            <!-- Confirm Password Input -->
            <div class="relative z-0 w-full mb-8 group border-b-2 border-slate-200 focus-within:border-primary-600 transition-colors">
                <input type="password" class="block py-2.5 px-0 pl-8 w-full text-sm text-slate-800 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 peer" id="confirm_password" name="confirm_password" placeholder=" " minlength="6">
                <label for="confirm_password" class="peer-focus:font-medium absolute text-sm text-slate-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-primary-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:left-8 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm Password</label>
                <i class="fas fa-check-circle absolute left-0 top-3 text-slate-400 peer-focus:text-primary-600 text-sm transition-colors"></i>
                <i class="fas fa-eye password-toggle absolute right-3 top-3 text-slate-400 hover:text-slate-600 cursor-pointer text-sm"></i>
            </div>

            <div class="mb-4">
                <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-full shadow-md hover:scale-105 transition-all text-sm flex items-center justify-center focus:outline-none">
                    Update Password <i class="fas fa-check ml-2 text-xs"></i>
                </button>
            </div>
        </form>
    </div>
</section>

<script>
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