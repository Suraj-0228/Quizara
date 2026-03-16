<?php include_once 'controllers/reset-password-process.php'; ?>

<section class="container position-relative z-1">
    <div class="auth-card-premium mx-auto">
        <div class="auth-header text-center">
            <div class="auth-brand-icon" style="background: var(--emerald-50); color: var(--emerald-600);">
                <i class="fas fa-shield-alt text-success"></i>
            </div>
            <h2 class="fw-black text-success mb-2">Set New Password</h2>
            <p class="text-slate-500 small fw-medium">Secure your account with a new password</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger glass-alert mb-4 border-0 border-start border-danger border-4 shadow-sm">
                <ul class="mb-0 ps-3 small fw-bold">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="needs-validation" novalidate>
            <!-- IMPORTANT: Hidden token input -->
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">

            <div class="premium-input-group mb-4">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" class="premium-control" id="password" name="password" placeholder=" " required minlength="6">
                <label for="password">New Password</label>
                <div class="invalid-feedback ps-2 mt-4 text-start">At least 6 characters required.</div>
            </div>

            <div class="premium-input-group mb-5">
                <i class="fas fa-check-circle input-icon"></i>
                <input type="password" class="premium-control" id="confirm_password" name="confirm_password" placeholder=" " required minlength="6">
                <label for="confirm_password">Confirm Password</label>
                <div class="invalid-feedback ps-2 mt-4 text-start">Passwords must match.</div>
            </div>

            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-outline-indigo rounded-pill shadow-premium hover-scale py-3 fw-black">
                    Update Password <i class="fas fa-check ms-2"></i>
                </button>
            </div>
        </form>
    </div>
</section>

<style>
    .btn-outline-indigo {
        border: 1px solid var(--indigo-500);
        color: var(--indigo-500);
    }

    .btn-outline-indigo:hover {
        background-color: var(--indigo-500);
        color: #fff;
    }
</style>

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