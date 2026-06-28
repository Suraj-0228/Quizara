<?php
/**
 * Global Modals for Quizara
 * Includes Welcome Popup and Logout Confirmation (Tailwind CSS Version)
 */
?>

<!-- Welcome Modal -->
<?php if (isset($_SESSION['login_welcome']) && $_SESSION['login_welcome']): ?>
    <div class="modal fixed inset-0 z-50 items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden" id="welcomeModal" aria-hidden="true">
        <div class="bg-white rounded-3xl shadow-premium max-w-sm w-full m-4 relative p-8 border border-slate-100 text-center animate-bounce-in">
            <div class="mb-5">
                <div class="w-16 h-16 rounded-2xl bg-primary-50 text-primary-600 border border-primary-100/30 flex items-center justify-center text-2xl mx-auto animate-bounce">
                    <i class="fas fa-rocket"></i>
                </div>
            </div>
            <h2 class="text-2xl font-black text-slate-900 mb-1">Welcome Back!</h2>
            <h4 class="text-primary-600 text-lg font-bold mb-3"><?php echo sanitize($_SESSION['username']); ?></h4>
            <p class="text-slate-500 text-xs font-medium mb-6">Great to see you again. Ready to master some new topics today?</p>
            <div class="w-full">
                <button type="button" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3.5 rounded-full shadow-md hover:shadow-lg hover:scale-105 transition-all focus:outline-none text-xs" data-bs-dismiss="modal">
                    Let's Get Started <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
                </button>
            </div>
            <!-- Decorative corner icon -->
            <div class="absolute top-0 right-0 p-4 opacity-5">
                <i class="fas fa-graduation-cap text-5xl text-primary-600"></i>
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
<div class="modal fixed inset-0 z-50 items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden" id="logoutConfirmModal" aria-hidden="true">
    <div class="bg-white rounded-3xl shadow-premium max-w-sm w-full m-4 relative p-8 border border-slate-100 text-center">
        <div class="mb-4">
            <div class="w-16 h-16 rounded-2xl bg-red-50 text-red-655 text-red-600 flex items-center justify-center text-2xl mx-auto">
                <i class="fas fa-sign-out-alt"></i>
            </div>
        </div>
        <h4 class="text-xl font-black text-red-655 text-red-600 mb-2">Confirm Logout</h4>
        <p class="text-slate-500 text-sm font-medium mb-6">Are you sure you want to sign out of your account?</p>
        <div class="flex flex-col space-y-2">
            <a href="<?php echo base_url('logout.php'); ?>" class="block w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-full shadow-md hover:shadow-lg hover:scale-105 transition-all confirm-logout-btn text-[11px] uppercase tracking-wider text-center">
                Yes, Log Me Out
            </a>
            <button type="button" class="w-full text-slate-455 hover:text-slate-655 text-xs font-bold py-2 focus:outline-none" data-bs-dismiss="modal">Stay Signed In</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
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