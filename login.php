<?php include_once 'controllers/login-process.php'; ?>

<section class="container position-relative z-1">
    <div class="auth-card-premium mx-auto">
        <div class="auth-header text-center">
            <div class="auth-brand-icon">
                <i class="fas fa-lock-open"></i>
            </div>
            <h2 class="fw-black text-slate-900 mb-2">Welcome Back</h2>
            <p class="text-slate-500 small fw-medium">Continue your learning journey</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger glass-alert d-flex align-items-center mb-4 border-0 border-start border-danger border-4 shadow-sm">
                <i class="fas fa-exclamation-circle me-2"></i> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" id="loginForm">
            <div class="premium-input-group mb-4">
                <i class="fas fa-user input-icon"></i>
                <input type="text" class="premium-control" id="email" name="email" placeholder=" " value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                <label for="email">Email or Username</label>
            </div>

            <div class="premium-input-group mb-4">
                <i class="fas fa-key input-icon"></i>
                <input type="password" class="premium-control" id="password" name="password" placeholder=" ">
                <i class="fas fa-eye password-toggle" style="right: 15px; top: 15px;"></i>
                <label for="password">Password</label>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check custom-checkbox">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label text-slate-500 small cursor-pointer" for="remember">Remember Me</label>
                </div>
                <a href="forgot-password.php" class="text-danger fw-bold text-decoration-none small hover-glow">Recovery Password?</a>
            </div>

            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-outline-indigo rounded-pill shadow-premium hover-scale py-3 fw-black">
                    Sign In Now <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>

            <div class="auth-footer text-center mt-0">
                <p class="mb-4 text-slate-500 small fw-medium">Or continue with</p>

                <div class="social-grid ">
                    <a href="#" class="social-btn-premium"><i class="fab fa-google"></i></a>
                    <a href="#" class="social-btn-premium"><i class="fab fa-github"></i></a>
                </div>

                <p class="mt-5 mb-0 text-slate-500 small">
                    New to Quizara? <a href="register.php" class="text-indigo-600 fw-bold text-decoration-none ms-1">Create an Account</a>
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

<?php include_once 'includes/footer.php'; ?>