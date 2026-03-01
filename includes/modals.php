<?php
/**
 * Global Modals for QuizMaster
 * Includes Welcome Popup and Logout Confirmation
 */
?>

<!-- Welcome Modal -->
<?php if (isset($_SESSION['login_welcome']) && $_SESSION['login_welcome']): ?>
<div class="modal fade" id="welcomeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card border-0 rounded-4 overflow-hidden">
            <div class="modal-body p-5 text-center">
                <div class="mb-4">
                    <div class="d-inline-flex bg-primary bg-opacity-10 text-primary p-4 rounded-circle mb-3 animate-bounce">
                        <i class="fas fa-rocket fa-3x"></i>
                    </div>
                </div>
                <h2 class="fw-bold text-light mb-2">Welcome Back, <?php echo sanitize($_SESSION['username']); ?>!</h2>
                <p class="text-muted mb-4">Great to See You Again. Ready to Master Some New Topics Today?</p>
                <button type="button" class="btn btn-gradient-primary rounded-pill px-5 py-2 fw-bold hover-scale" data-bs-dismiss="modal">
                    Let's Go!
                </button>
            </div>
            <!-- Decorative corner -->
            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                <i class="fas fa-graduation-cap fa-4x"></i>
            </div>
        </div>
    </div>
</div>
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
        <div class="modal-content glass-card border-0 rounded-4">
            <div class="modal-header border-0 pb-0 justify-content-center">
                <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-circle mt-3">
                    <i class="fas fa-sign-out-alt fa-lg"></i>
                </div>
            </div>
            <div class="modal-body p-4 text-center">
                <h5 class="fw-bold text-light mb-2">Confirm Logout!</h5>
                <p class="text-muted small mb-0">Are You Sure You Want To Sign Out Of Your Account??</p>
            </div>
            <div class="modal-footer border-0 pt-0 flex-column">
                <a href="<?php echo base_url('logout.php'); ?>" class="btn btn-danger w-100 rounded-pill py-2 fw-bold mb-2 confirm-logout-btn">Logout</a>
                <button type="button" class="btn btn-link text-muted text-decoration-none small" data-bs-dismiss="modal">Cancel</button>
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
    0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
    40% {transform: translateY(-10px);}
    60% {transform: translateY(-5px);}
}
.hover-scale {
    transition: transform 0.2s;
}
.hover-scale:hover {
    transform: scale(1.05);
}
</style>
