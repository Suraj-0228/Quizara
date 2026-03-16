<?php include_once 'controllers/register-process.php'; ?>

<section class="container position-relative z-1">
    <div class="auth-card-premium mx-auto" style="max-width: 550px;">
        <div class="auth-header text-center">
            <div class="auth-brand-icon">
                <i class="fas fa-user-plus text-success"></i>
            </div>
            <h2 class="fw-black text-dark mb-2">Create Account</h2>
            <p class="text-slate-500 small fw-medium">Start your learning journey today</p>
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

        <form action="" method="POST" id="registerForm">
            <div class="row g-3">
                <div class="col-12">
                    <div class="premium-input-group mb-2">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="premium-control" id="username" name="username" placeholder=" " value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>">
                        <label for="username">Choose Username</label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="premium-input-group mb-2">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" class="premium-control" id="email" name="email" placeholder=" " value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        <label for="email">Email Address</label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="premium-input-group mb-2">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="premium-control" id="password" name="password" placeholder=" ">
                        <i class="fas fa-eye password-toggle" style="right: 15px; top: 15px;"></i>
                        <label for="password">Password</label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="premium-input-group mb-2">
                        <i class="fas fa-shield input-icon"></i>
                        <input type="password" class="premium-control" id="confirm_password" name="confirm_password" placeholder=" ">
                        <i class="fas fa-eye password-toggle" style="right: 15px; top: 15px;"></i>
                        <label for="confirm_password">Confirm</label>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-indigo rounded-pill shadow-premium hover-scale py-3 fw-black">
                            Create Account <i class="fas fa-rocket ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="auth-footer text-center mt-0">
                <p class="mb-0 text-slate-500 small">
                    Already have an account? <a href="login.php" class="text-indigo-600 fw-bold text-decoration-none ms-1">Sign In instead</a>
                </p>

                <div class="mt-4 pt-4 border-top border-slate-100">
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <div class="d-flex align-items-center opacity-75">
                            <i class="fas fa-check-circle text-success me-2 small"></i>
                            <span class="small fw-bold text-slate-600">Free Access</span>
                        </div>
                        <div class="d-flex align-items-center opacity-75">
                            <i class="fas fa-check-circle text-success me-2 small"></i>
                            <span class="small fw-bold text-slate-600">Analytics</span>
                        </div>
                    </div>
                </div>
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