<?php
require_once '../controllers/profile-process.php';

$pageTitle = 'Account Settings';
// Note: header.php is already included by profile-process.php if needed, 
// but let's ensure header is present and pageTitle is accurate.
?>

<div class="max-w-4xl mx-auto py-8 px-4">
    <!-- Page Title & Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl md:text-3xl font-black text-slate-900 flex items-center">
                <i class="fas fa-cog text-primary-600 mr-3"></i> Account & Security Settings
            </h2>
            <p class="text-slate-500 text-sm font-semibold mt-1">Manage your security credentials, notification preferences, and account lifecycle.</p>
        </div>
        <div class="flex items-center space-x-2">
            <span class="bg-primary-50 text-primary-600 border border-primary-100/30 text-xs font-bold px-3 py-1.5 rounded-full flex items-center shadow-sm">
                <i class="fas fa-shield-alt text-emerald-500 mr-1.5"></i> Protected Session
            </span>
        </div>
    </div>

    <?php flash('message'); ?>

    <div class="space-y-8">
        <!-- 1. PASSPHRASE & SECURITY MANAGEMENT -->
        <div class="bg-white border border-slate-200 rounded-[32px] p-6 md:p-8 shadow-premium relative overflow-hidden">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-primary-50 border border-primary-100/40 text-primary-600 flex items-center justify-center rounded-2xl text-xl mr-4 flex-shrink-0 shadow-sm">
                    <i class="fas fa-lock"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-slate-900 text-lg mb-0.5">Passphrase & Security Management</h3>
                    <p class="text-slate-400 text-sm font-medium">Update your account login password to maintain high security.</p>
                </div>
            </div>

            <form action="" method="POST" id="changePasswordForm" class="space-y-5 max-w-lg">
                <input type="hidden" name="update_password" value="1">
                <input type="hidden" name="redirect_to" value="settings.php">

                <!-- Current Password Field -->
                <div>
                    <label for="current_password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Current Password</label>
                    <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border <?php echo isset($errors['current_password']) ? 'border-red-500' : 'border-slate-200'; ?> bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all relative">
                        <span class="px-4 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-lock"></i></span>
                        <input type="password" class="flex-grow px-4 py-3 text-sm bg-white focus:outline-none text-slate-800 font-medium pr-12" id="current_password" name="current_password" placeholder="••••••••">
                        <button type="button" onclick="togglePasswordVisibility('current_password', this)" class="absolute right-0 top-0 bottom-0 px-4 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors" title="Toggle Password Visibility">
                            <i class="fas fa-eye text-sm"></i>
                        </button>
                    </div>
                    <?php if (isset($errors['current_password'])): ?>
                        <p class="error-text text-red-600 text-sm mt-1.5 font-semibold"><?php echo $errors['current_password']; ?></p>
                    <?php endif; ?>
                </div>

                <!-- New Password Field -->
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">New Password</label>
                    <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border <?php echo isset($errors['password']) ? 'border-red-500' : 'border-slate-200'; ?> bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all relative">
                        <span class="px-4 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-key"></i></span>
                        <input type="password" class="flex-grow px-4 py-3 text-sm bg-white focus:outline-none text-slate-800 font-medium pr-12" id="password" name="password" placeholder="••••••••">
                        <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute right-0 top-0 bottom-0 px-4 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors" title="Toggle Password Visibility">
                            <i class="fas fa-eye text-sm"></i>
                        </button>
                    </div>
                    <?php if (isset($errors['password'])): ?>
                        <p class="error-text text-red-600 text-sm mt-1.5 font-semibold"><?php echo $errors['password']; ?></p>
                    <?php endif; ?>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="confirm_password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Verify New Password</label>
                    <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border <?php echo isset($errors['confirm_password']) ? 'border-red-500' : 'border-slate-200'; ?> bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all relative">
                        <span class="px-4 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-shield-alt"></i></span>
                        <input type="password" class="flex-grow px-4 py-3 text-sm bg-white focus:outline-none text-slate-800 font-medium pr-12" id="confirm_password" name="confirm_password" placeholder="••••••••">
                        <button type="button" onclick="togglePasswordVisibility('confirm_password', this)" class="absolute right-0 top-0 bottom-0 px-4 text-slate-400 hover:text-slate-600 focus:outline-none transition-colors" title="Toggle Password Visibility">
                            <i class="fas fa-eye text-sm"></i>
                        </button>
                    </div>
                    <?php if (isset($errors['confirm_password'])): ?>
                        <p class="error-text text-red-600 text-sm mt-1.5 font-semibold"><?php echo $errors['confirm_password']; ?></p>
                    <?php endif; ?>
                </div>

                <div class="pt-2">
                    <button type="submit" class="inline-flex items-center bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3.5 rounded-full shadow-md text-sm transition-all focus:outline-none hover:scale-[1.02]">
                        <i class="fas fa-sync-alt mr-2.5 text-xs"></i> Update Password
                    </button>
                </div>
            </form>
        </div>

        <!-- 2. PREFERENCES & SYSTEM SETTINGS -->
        <div class="bg-white border border-slate-200 rounded-[32px] p-6 md:p-8 shadow-premium relative overflow-hidden">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-amber-50 border border-amber-100 text-amber-500 flex items-center justify-center rounded-2xl text-xl mr-4 flex-shrink-0 shadow-sm">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-slate-900 text-lg mb-0.5">Notification & System Preferences</h3>
                    <p class="text-slate-400 text-sm font-medium">Control email alerts, receipts, and user platform preferences.</p>
                </div>
            </div>

            <div class="space-y-5 max-w-xl">
                <!-- Toggle 1: Email Receipts -->
                <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="pr-4">
                        <strong class="text-slate-800 text-sm font-extrabold block mb-0.5">Automated Purchase Receipts</strong>
                        <span class="text-slate-400 text-xs font-medium block">Receive instant digital receipts on your registered Gmail after payment.</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                        <input type="checkbox" class="sr-only peer" checked disabled>
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500"></div>
                    </label>
                </div>

                <!-- Toggle 2: Academic Quiz Reminders -->
                <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="pr-4">
                        <strong class="text-slate-800 text-sm font-extrabold block mb-0.5">Quiz Completion Alerts</strong>
                        <span class="text-slate-400 text-xs font-medium block">Get notified when new quizzes or certificates are awarded.</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer flex-shrink-0">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- 3. ACCOUNT DELETION (DANGER ZONE) -->
        <div class="bg-rose-50/60 border border-rose-200/80 rounded-[32px] p-6 md:p-8 shadow-sm relative overflow-hidden">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center mb-2">
                        <i class="fas fa-exclamation-triangle text-rose-600 text-lg mr-2.5"></i>
                        <h3 class="font-extrabold text-rose-900 text-base">Account Archival & Destruction</h3>
                    </div>
                    <p class="text-slate-600 text-sm font-medium leading-relaxed max-w-lg">
                        Permanently delete your Quizara student record, attempt history, certificates, and saved preferences. This action cannot be reversed.
                    </p>
                </div>
                <button type="button" onclick="confirmDelete()" class="border-2 border-rose-300 text-rose-700 hover:bg-rose-600 hover:text-white hover:border-transparent font-bold px-6 py-3 rounded-full transition-all text-sm flex-shrink-0 shadow-sm focus:outline-none">
                    <i class="fas fa-trash-alt mr-2 text-xs"></i> Terminate Account
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Account Delete Confirmation Modal -->
<div class="modal fixed inset-0 z-50 items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden" id="deleteModal" aria-hidden="true">
    <div class="bg-white rounded-3xl shadow-premium max-w-sm w-full m-4 relative p-8 border border-slate-100 text-center animate-bounce-in">
        <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-2xl flex items-center justify-center text-xl mx-auto mb-4">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h5 class="text-xl font-black text-slate-900 mb-2">Delete Student Account?</h5>
        <p class="text-slate-400 text-sm mb-6 leading-relaxed">This action is permanent and cannot be undone. Type <strong>"DELETE"</strong> below to confirm.</p>
        
        <form action="" method="POST" class="space-y-4">
            <input type="hidden" name="delete_account" value="1">
            <div>
                <input type="text" class="w-full bg-white text-slate-800 border-2 border-rose-200 focus:border-rose-500 rounded-xl px-4 py-3 text-center tracking-widest text-sm font-mono focus:outline-none" name="confirm_delete" placeholder="DELETE" autocomplete="off">
            </div>
            <div class="flex flex-col space-y-2 pt-2">
                <button type="submit" class="block w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3.5 rounded-full shadow-md transition-all focus:outline-none">
                    Permanently Delete
                </button>
                <button type="button" class="w-full text-slate-400 hover:text-slate-600 text-sm font-bold py-2 focus:outline-none" data-bs-dismiss="modal">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
    if (input) {
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
}

function confirmDelete() {
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>

<?php include_once '../includes/footer.php'; ?>
