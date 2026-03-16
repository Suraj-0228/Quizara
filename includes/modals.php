<?php

/**
 * Global Modals for Quizara
 * Includes Welcome Popup and Logout Confirmation
 */
?>

<!-- Welcome Modal -->
<?php if (isset($_SESSION['login_welcome']) && $_SESSION['login_welcome']): ?>
    <div class="modal fade" id="welcomeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content auth-card-premium border-0 overflow-hidden shadow-premium" style="max-width: 450px;">
                <div class="modal-body p-5 text-center">
                    <div class="mb-4">
                        <div class="auth-brand-icon animate-bounce mb-0">
                            <i class="fas fa-rocket"></i>
                        </div>
                    </div>
                    <h2 class="fw-black text-slate-900 mb-2">Welcome Back!</h2>
                    <h4 class="text-indigo-600 mb-3 fw-bold"><?php echo sanitize($_SESSION['username']); ?></h4>
                    <p class="text-slate-500 small fw-medium mb-4">Great to see you again. Ready to master some new topics today?</p>
                    <div class="d-grid">
                        <button type="button" class="btn btn-outline-indigo rounded-pill px-5 py-3 fw-black shadow-premium hover-scale" data-bs-dismiss="modal">
                            Let's Get Started <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
                <!-- Decorative corner -->
                <div class="position-absolute top-0 end-0 p-3 opacity-05">
                    <i class="fas fa-graduation-cap fa-4x text-indigo-600"></i>
                </div>
            </div>
        </div>
    </div>

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
        document.addEventListener('DOMContentLoaded', function() {
            var welcomeModal = new bootstrap.Modal(document.getElementById('welcomeModal'));
            welcomeModal.show();
        });
    </script>
    <?php unset($_SESSION['login_welcome']); ?>
<?php endif; ?>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content auth-card-premium border-0 shadow-premium" style="padding: 2.5rem 1.5rem;">
            <div class="modal-header border-0 pb-0 justify-content-center">
                <div class="auth-brand-icon mb-0">
                    <i class="fas fa-sign-out-alt text-danger"></i>
                </div>
            </div>
            <div class="modal-body p-4 text-center">
                <h4 class="fw-black text-danger mb-2">Confirm Logout</h4>
                <p class="text-slate-500 small fw-medium mb-0">Are you sure you want to sign out of your account?</p>
            </div>
            <div class="modal-footer border-0 pt-2 flex-column">
                <div class="d-grid w-100 gap-2">
                    <a href="<?php echo base_url('logout.php'); ?>" class="btn btn-danger btn-lg rounded-pill py-3 fw-black confirm-logout-btn shadow-premium hover-scale">
                        Yes, Log Me Out
                    </a>
                    <button type="button" class="btn btn-link text-slate-400 text-decoration-none small fw-bold" data-bs-dismiss="modal">Stay Signed In</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all logout links except the one inside the confirmation modal
        const logoutLinks = document.querySelectorAll('a[href*="logout.php"]:not(.confirm-logout-btn)');
        const logoutModal = new bootstrap.Modal(document.getElementById('logoutConfirmModal'));

        logoutLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                logoutModal.show();
            });
        });
    });
</script>

<style>
    .animate-bounce {
        animation: bounce 2s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-10px);
        }

        60% {
            transform: translateY(-5px);
        }
    }

    .hover-scale {
        transition: transform 0.2s;
    }

    .hover-scale:hover {
        transform: scale(1.05);
    }
</style>