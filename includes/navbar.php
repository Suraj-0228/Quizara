<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
            <i class="fas fa-graduation-cap me-2"></i>Quizara
        </a>

        <!-- Mobile User Menu -->
        <?php if (isLoggedIn()): ?>
            <div class="dropdown d-lg-none ms-auto me-3">
                <a class="dropdown-toggle d-flex align-items-center text-decoration-none" href="#" id="mobileUserDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-weight: bold; font-size: 0.9rem; border: 2px solid #fff; box-shadow: var(--shadow-sm);">
                        <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-premium border-0 py-2 animated fadeIn" aria-labelledby="mobileUserDropdown" style="border-radius: 15px; margin-top: 10px;">
                    <li class="px-3 py-2 border-bottom border-slate-100 mb-2">
                        <div class="small text-muted fw-bold text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Logged in as</div>
                        <div class="fw-bold text-slate-900 fs-5"><?php echo sanitize($_SESSION['username']); ?></div>
                    </li>
                    <?php if (!isAdmin()): ?>
                        <li><a class="dropdown-item py-2 fw-semibold" href="<?php echo base_url('student/profile.php'); ?>"><i class="fas fa-user-cog me-2 text-primary"></i>Profile Settings</a></li>
                        <li><a class="dropdown-item py-2 fw-semibold" href="<?php echo base_url('student/reports.php'); ?>"><i class="fas fa-chart-line me-2 text-success"></i>Performance Reports</a></li>
                        <li><a class="dropdown-item py-2 fw-semibold" href="<?php echo base_url('student/quizzes.php'); ?>"><i class="fas fa-list-check me-2 text-warning"></i>Available Quizzes</a></li>
                        <li><a class="dropdown-item py-2 fw-semibold" href="<?php echo base_url('student/history.php'); ?>"><i class="fas fa-history me-2 text-info"></i>Learning History</a></li>
                        <li>
                            <hr class="dropdown-divider border-slate-100">
                        </li>
                    <?php else: ?>
                        <li><a class="dropdown-item py-2 fw-semibold" href="<?php echo base_url('admin/settings.php'); ?>"><i class="fas fa-cog me-2 text-primary"></i>System Settings</a></li>
                        <li>
                            <hr class="dropdown-divider border-slate-100">
                        </li>
                    <?php endif; ?>
                    <li><a class="dropdown-item py-2 text-danger fw-bold" href="<?php echo base_url('logout.php'); ?>"><i class="fas fa-sign-out-alt me-2"></i>Sign Out</a></li>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Custom Toggler -->
        <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger-menu <?php echo isLoggedIn() ? 'ms-0' : 'ms-auto'; ?>">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left Side -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('about.php'); ?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('faq.php'); ?>">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('contact.php'); ?>">Contact</a>
                </li>
            </ul>

            <!-- Desktop User Menu -->
            <?php if (isLoggedIn()): ?>
                <ul class="navbar-nav ms-auto align-items-center d-none d-lg-flex">
                    <li class="nav-item dropdown dropdown-premium">
                        <a class="nav-link dropdown-toggle d-flex align-items-center px-3 py-2 rounded-pill bg-slate-50 border border-slate-100" href="#" id="desktopUserDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-weight: bold; font-size: 0.8rem; border: 2px solid #fff; box-shadow: var(--shadow-sm);">
                                <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                            </div>
                            <span class="fw-bold text-slate-800 me-1"><?php echo sanitize($_SESSION['username']); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-premium border-0 py-2 animated fadeIn" aria-labelledby="desktopUserDropdown" style="border-radius: 15px; margin-top: 15px; min-width: 220px;">
                            <li class="px-3 py-2 border-bottom border-slate-100 mb-2 text-center">
                                <div class="small text-muted fw-bold text-uppercase mb-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">Account Profile</div>
                                <div class="fw-bold text-indigo-600"><?php echo sanitize($_SESSION['username']); ?></div>
                            </li>
                            <?php if (!isAdmin()): ?>
                                <li><a class="dropdown-item py-2 fw-semibold" href="<?php echo base_url('student/profile.php'); ?>"><i class="fas fa-user-cog me-2 text-primary"></i>Profile Settings</a></li>
                                <li><a class="dropdown-item py-2 fw-semibold" href="<?php echo base_url('student/reports.php'); ?>"><i class="fas fa-chart-line me-2 text-success"></i>Performance Reports</a></li>
                                <li><a class="dropdown-item py-2 fw-semibold" href="<?php echo base_url('student/quizzes.php'); ?>"><i class="fas fa-list-check me-2 text-warning"></i>Available Quizzes</a></li>
                                <li><a class="dropdown-item py-2 fw-semibold" href="<?php echo base_url('student/history.php'); ?>"><i class="fas fa-history me-2 text-info"></i>Learning History</a></li>
                                <li>
                                    <hr class="dropdown-divider border-slate-100">
                                </li>
                            <?php else: ?>
                                <li><a class="dropdown-item py-2 fw-semibold" href="<?php echo base_url('admin/dashboard.php'); ?>"><i class="fas fa-desktop me-2 text-primary"></i>Admin Control</a></li>
                                <li>
                                    <hr class="dropdown-divider border-slate-100">
                                </li>
                            <?php endif; ?>
                            <li><a class="dropdown-item py-2 text-danger fw-bold" href="<?php echo base_url('logout.php'); ?>"><i class="fas fa-power-off me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            <?php else: ?>
                <div class="d-flex gap-2">
                    <a href="<?php echo base_url('login.php'); ?>" class="btn btn-outline-indigo rounded-pill px-4 fw-bold">Login</a>
                    <a href="<?php echo base_url('register.php'); ?>" class="btn btn-outline-indigo rounded-pill px-4 fw-bold shadow-premium">Join Now</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>

<style>
    .btn-outline-indigo {
        border: 1px solid var(--indigo-500);
        color: var(--indigo-500);
    }

    .btn-outline-indigo:hover {
        background-color: var(--indigo-500);
        color: #fff;
    }

    /* Tiny animation for dropdown */
    .animated {
        animation-duration: 0.3s;
        animation-fill-mode: both;
    }

    .fadeIn {
        animation-name: fadeIn;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>