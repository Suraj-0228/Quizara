<?php include_once 'controllers/forgot-password-process.php'; ?>

<section class="container position-relative z-1">
    <div class="auth-card-premium mx-auto">
        <div class="auth-header text-center">
            <div class="auth-brand-icon">
                <i class="fas fa-key text-danger"></i>
            </div>
            <h2 class="fw-black text-danger mb-2">Forgot Password</h2>
            <p class="text-slate-500 small fw-medium">Recover your account access</p>
            <p class="text-primary x-small mt-2">Enter your email and we'll send a reset link.</p>
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

        <form action="" method="POST" id="forgotPasswordForm" class="needs-validation" novalidate>
            <div class="premium-input-group mb-5">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" class="premium-control" id="email" name="email" placeholder=" " required>
                <label for="email">Email address</label>
                <div class="invalid-feedback ps-2 mt-4 text-start">Please enter your registered email.</div>
            </div>

            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-outline-indigo rounded-pill shadow-premium hover-scale py-3 fw-black">
                    Send Recovery Link <i class="fas fa-paper-plane ms-2"></i>
                </button>
            </div>

            <div class="auth-footer text-center mt-0">
                <p class="mb-0 text-slate-500 small">
                    Remembered it? <a href="login.php" class="text-indigo-600 fw-bold text-decoration-none ms-1">Return to Login</a>
                </p>
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