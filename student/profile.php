<?php include_once '../controllers/profile-process.php'; ?>

<!-- Profile Header Area -->
<div class="bg-gradient-to-r from-primary-500 to-primary-600 h-48 w-full rounded-b-[2rem] shadow-sm -mt-6"></div>

<div class="max-w-6xl mx-auto px-4 pb-12 -mt-24 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Sidebar: Identity Card -->
        <div class="lg:col-span-4">
            <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-premium relative overflow-hidden">
                <div class="text-center">
                    <!-- Avatar Section -->
                    <div class="relative w-24 h-24 mx-auto mb-4 mt-2">
                        <div class="w-full h-full rounded-2xl bg-primary-50 border border-slate-100 flex items-center justify-center text-3xl font-bold text-primary-600 shadow-sm overflow-hidden">
                            <?php if (!empty($user['profile_pic'])): ?>
                                <img src="../assets/images/profiles/<?php echo sanitize($user['profile_pic']); ?>" alt="Profile Picture" class="w-full h-full object-cover">
                            <?php else: ?>
                                <span><?php echo strtoupper(substr($user['username'], 0, 1)); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="absolute bottom-0 right-0 w-4.5 h-4.5 bg-emerald-500 rounded-full border-4 border-white shadow-sm"></div>
                    </div>

                    <h3 class="font-extrabold text-slate-900 text-xl mb-1"><?php echo sanitize($user['username']); ?></h3>
                    <p class="text-slate-400 text-xs font-semibold mb-4 flex items-center justify-center">
                        <i class="fas fa-envelope-open mr-2 text-primary-400"></i><?php echo sanitize($user['email']); ?>
                    </p>

                    <div class="flex justify-center gap-2 mb-6">
                        <span class="bg-primary-50 text-primary-600 border border-primary-100/30 text-xs font-bold px-3 py-1.5 rounded-full">
                            <i class="fas fa-user-shield mr-1.5"></i><?php echo ucfirst($user['role']); ?>
                        </span>
                        <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 text-xs font-bold px-3 py-1.5 rounded-full">
                            <i class="fas fa-check-circle mr-1.5"></i>Active
                        </span>
                    </div>

                    <?php if (!empty($user['profile_pic'])): ?>
                        <form action="" method="POST" class="mb-6" onsubmit="return confirm('Are you sure you want to remove your profile picture?');">
                            <input type="hidden" name="remove_profile_pic_only" value="1">
                            <button type="submit" class="border border-red-200 text-red-600 hover:bg-red-50 text-xs font-bold px-4 py-2 rounded-full transition-all focus:outline-none shadow-sm">
                                <i class="fas fa-image-portrait mr-2"></i>Remove Photo
                            </button>
                        </form>
                    <?php endif; ?>

                    <div class="space-y-4 text-left mt-6 border-t border-slate-100 pt-6">
                        <div class="flex items-center p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-9 h-9 bg-white border border-slate-200 text-slate-500 flex items-center justify-center rounded-lg text-sm mr-3 flex-shrink-0">
                                <i class="far fa-calendar-check"></i>
                            </div>
                            <div>
                                <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-0.5">Academic Join Date</div>
                                <div class="font-bold text-slate-700 text-sm"><?php echo date('M d, Y', strtotime($user['created_at'])); ?></div>
                            </div>
                        </div>
                        <div class="flex items-center p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-9 h-9 bg-white border border-slate-200 text-slate-500 flex items-center justify-center rounded-lg text-sm mr-3 flex-shrink-0">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <div class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-0.5">Registered Region</div>
                                <div class="font-bold text-slate-700 text-sm">Global Student</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="lg:col-span-8">
            <div class="bg-white border border-slate-200 rounded-3xl shadow-premium overflow-hidden">
                <div class="border-b border-slate-100 bg-slate-50 p-2">
                    <ul class="flex space-x-1" id="profileTabs">
                        <li class="flex-1">
                            <button class="tab-btn w-full text-center py-2.5 rounded-xl text-xs font-bold transition-all focus:outline-none bg-white text-primary-600 shadow-sm" data-target="#overview">
                                <i class="fas fa-chart-pie mr-2"></i>Performance Overview
                            </button>
                        </li>
                        <li class="flex-1">
                            <button class="tab-btn w-full text-center py-2.5 rounded-xl text-xs font-bold transition-all focus:outline-none text-slate-500 hover:text-primary-600" data-target="#security">
                                <i class="fas fa-shield-alt mr-2"></i>Security & Credentials
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="p-6 md:p-10">
                    <div id="profileTabsContent">
                        <!-- Overview Tab -->
                        <div class="tab-pane block" id="overview">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                                <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm h-full relative overflow-hidden group">
                                    <div class="w-10 h-10 rounded-xl bg-primary-50 border border-primary-100/30 text-primary-600 flex items-center justify-center text-lg mb-3">
                                        <i class="fas fa-award"></i>
                                    </div>
                                    <div class="text-3xl font-extrabold text-slate-800 mb-0.5"><?php echo $stats_count; ?></div>
                                    <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">Certificates Earned</div>
                                    <div class="w-full bg-slate-100 h-1.5 rounded-full mt-3 overflow-hidden">
                                        <div class="bg-primary-600 h-full rounded-full" style="width: 85%;"></div>
                                    </div>
                                </div>
                                <div class="bg-white border border-slate-200 p-6 rounded-2xl shadow-sm h-full relative overflow-hidden group">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg mb-3">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div class="text-3xl font-extrabold text-slate-800 mb-0.5"><?php echo $avg_score; ?><span class="text-slate-400 text-base font-normal ml-0.5">%</span></div>
                                    <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">Academic Proficiency</div>
                                    <div class="w-full bg-slate-100 h-1.5 rounded-full mt-3 overflow-hidden">
                                        <div class="bg-emerald-500 h-full rounded-full" style="width: <?php echo $avg_score; ?>%;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 rounded-2xl bg-slate-50/50 border border-slate-100">
                                <div class="flex justify-between items-center mb-4">
                                    <h5 class="font-extrabold text-slate-900 text-base">Student Bio</h5>
                                    <button class="text-xs text-primary-600 hover:text-primary-700 font-bold border border-primary-200 hover:bg-primary-50/50 px-3.5 py-1.5 rounded-full transition-all focus:outline-none" onclick="editProfile()">
                                        <i class="fas fa-pen-nib mr-1.5"></i>Edit Profile
                                    </button>
                                </div>
                                <div class="text-slate-650 text-xs leading-relaxed">
                                    <?php if (!empty($user['bio'])): ?>
                                        <?php echo nl2br(sanitize($user['bio'])); ?>
                                    <?php else: ?>
                                        <div class="text-center py-6 text-slate-400 italic">
                                            <i class="fas fa-quote-left d-block mb-3 opacity-25 text-2xl"></i>
                                            Your academic biography is currently empty.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Security Tab -->
                        <div class="tab-pane hidden" id="security">
                            <div class="bg-slate-50/50 border border-slate-100 rounded-2xl p-6 mb-6">
                                <div class="flex items-center mb-6">
                                    <div class="w-10 h-10 bg-white border border-slate-200 text-primary-600 flex items-center justify-center rounded-xl text-lg mr-4 flex-shrink-0">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-extrabold text-slate-900 text-sm">Passphrase Management</h5>
                                        <p class="text-slate-400 text-xs">Change your primary account credentials</p>
                                    </div>
                                </div>

                                <form action="" method="POST" class="space-y-4 max-w-md">
                                    <input type="hidden" name="update_password" value="1">
                                    
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">New Password</label>
                                        <div class="flex shadow-sm rounded-lg overflow-hidden border <?php echo isset($errors['password']) ? 'border-red-500' : 'border-slate-200'; ?> bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                                            <span class="px-3 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-key"></i></span>
                                            <input type="password" class="flex-grow px-4 py-2.5 text-sm bg-white focus:outline-none text-slate-800" name="password" placeholder="••••••••">
                                        </div>
                                        <?php if (isset($errors['password'])): ?>
                                            <div class="text-red-500 text-xs mt-1"><?php echo $errors['password']; ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Verify Password</label>
                                        <div class="flex shadow-sm rounded-lg overflow-hidden border <?php echo isset($errors['confirm_password']) ? 'border-red-500' : 'border-slate-200'; ?> bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                                            <span class="px-3 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-shield-alt"></i></span>
                                            <input type="password" class="flex-grow px-4 py-2.5 text-sm bg-white focus:outline-none text-slate-800" name="confirm_password" placeholder="••••••••">
                                        </div>
                                        <?php if (isset($errors['confirm_password'])): ?>
                                            <div class="text-red-500 text-xs mt-1"><?php echo $errors['confirm_password']; ?></div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="pt-2">
                                        <button type="submit" class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3 rounded-full shadow-md text-xs transition-all focus:outline-none hover:scale-105">
                                            <i class="fas fa-sync-alt mr-2 text-[10px]"></i>Update Security
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="p-6 rounded-2xl bg-red-50/50 border border-red-100/60 mt-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <div>
                                    <h5 class="text-red-655 text-red-600 font-extrabold text-sm mb-0.5">Archival & Destruction</h5>
                                    <p class="text-slate-400 text-xs">Permanently remove your student record and history.</p>
                                </div>
                                <button class="border border-red-200 text-red-655 text-red-600 hover:bg-red-600 hover:text-white hover:border-transparent font-bold px-5 py-2.5 rounded-full transition-all text-xs flex-shrink-0 focus:outline-none" onclick="confirmDelete()">
                                    Terminate Account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fixed inset-0 z-50 items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden" id="deleteModal" aria-hidden="true">
    <div class="bg-white rounded-3xl shadow-premium max-w-sm w-full m-4 relative p-8 border border-slate-100 text-center animate-bounce-in">
        <h5 class="text-xl font-black text-slate-900 mb-2">Delete Account?</h5>
        <p class="text-slate-400 text-xs mb-6 leading-relaxed">This action cannot be undone. To confirm, type <strong>"DELETE"</strong> below.</p>
        
        <form action="" method="POST">
            <input type="hidden" name="delete_account" value="1">
            <div class="mb-4">
                <input type="text" class="w-full bg-white text-slate-800 border-2 border-red-200 focus-border-red-500 rounded-xl px-4 py-2.5 text-center tracking-wider text-sm focus:outline-none focus:ring-0" name="confirm_delete" placeholder="DELETE" autocomplete="off">
            </div>
            <div class="flex flex-col space-y-2">
                <button type="submit" class="block w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3.5 rounded-full shadow-md transition-all focus:outline-none">
                    Permanently Delete
                </button>
                <button type="button" class="w-full text-slate-455 hover:text-slate-655 text-xs font-bold py-2 focus:outline-none" data-bs-dismiss="modal">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fixed inset-0 z-50 items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden" id="editProfileModal" aria-hidden="true">
    <div class="bg-white rounded-[32px] shadow-premium max-w-lg w-full m-4 relative border border-slate-100 overflow-hidden animate-bounce-in">
        <div class="bg-primary-600 p-6 text-white relative">
            <h4 class="text-xl font-black mb-1">Edit Student Credentials</h4>
            <p class="text-primary-100 text-xs opacity-75">Update your public identity and account settings</p>
            <button type="button" class="absolute top-6 right-6 text-white/80 hover:text-white text-lg focus:outline-none" data-bs-dismiss="modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6 bg-white">
            <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="update_profile" value="1">

                <div class="text-center">
                    <label for="profileUpload" class="cursor-pointer relative inline-block">
                        <div class="relative w-24 h-24 mx-auto mb-2">
                            <div class="w-full h-full rounded-2xl bg-primary-50 border border-slate-100 flex items-center justify-center text-3xl font-bold text-primary-600 shadow-sm overflow-hidden">
                                <?php if (!empty($user['profile_pic'])): ?>
                                    <img src="../assets/images/profiles/<?php echo sanitize($user['profile_pic']); ?>" alt="Profile" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <span><?php echo strtoupper(substr($user['username'], 0, 1)); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="absolute -bottom-1 -right-1 bg-white text-primary-600 rounded-full w-8 h-8 flex items-center justify-center border border-slate-200 shadow-sm">
                            <i class="fas fa-camera text-xs"></i>
                        </div>
                    </label>
                    <input type="file" id="profileUpload" name="profile_pic" class="hidden" accept="image/jpeg,image/png,image/gif">
                    <div class="text-[10px] text-slate-400 mt-1">Recommended: 400x400px JPG/PNG</div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Public Username</label>
                        <div class="flex shadow-sm rounded-lg overflow-hidden border <?php echo isset($errors['username']) ? 'border-red-500' : 'border-slate-200'; ?> bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                            <span class="px-3 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-user-tag"></i></span>
                            <input type="text" class="flex-grow px-4 py-2.5 text-sm bg-white focus:outline-none text-slate-800" name="username" value="<?php echo sanitize($user['username']); ?>">
                        </div>
                        <?php if (isset($errors['username'])): ?>
                            <div class="text-red-500 text-xs mt-1"><?php echo $errors['username']; ?></div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Primary Email</label>
                        <div class="flex shadow-sm rounded-lg overflow-hidden border <?php echo isset($errors['email']) ? 'border-red-500' : 'border-slate-200'; ?> bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                            <span class="px-3 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-at"></i></span>
                            <input type="email" class="flex-grow px-4 py-2.5 text-sm bg-white focus:outline-none text-slate-800" name="email" value="<?php echo sanitize($user['email']); ?>">
                        </div>
                        <?php if (isset($errors['email'])): ?>
                            <div class="text-red-500 text-xs mt-1"><?php echo $errors['email']; ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Student Biography</label>
                    <div class="flex shadow-sm rounded-lg overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                        <span class="px-3 bg-slate-50 border-r border-slate-200 flex items-start pt-3 text-slate-400 text-sm"><i class="fas fa-quote-right"></i></span>
                        <textarea class="flex-grow px-4 py-2.5 text-sm bg-white focus:outline-none text-slate-800 resize-none" name="bio" rows="4" placeholder="Brief statement about your academic goals..."><?php echo sanitize($user['bio'] ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-3 border-t border-slate-100">
                    <button type="button" class="border border-slate-200 text-slate-500 hover:bg-slate-50 font-bold px-5 py-2.5 rounded-full text-xs transition-all focus:outline-none" data-bs-dismiss="modal">Discard</button>
                    <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-6 py-2.5 rounded-full shadow-md text-xs transition-all focus:outline-none hover:scale-105">Commit Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Tab switching logic
    document.querySelectorAll('#profileTabs button').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active classes from all buttons
            document.querySelectorAll('#profileTabs button').forEach(b => {
                b.classList.remove('bg-white', 'text-primary-600', 'shadow-sm');
                b.classList.add('text-slate-500', 'hover:text-primary-600');
            });
            // Add active classes to current button
            this.classList.add('bg-white', 'text-primary-600', 'shadow-sm');
            this.classList.remove('text-slate-500', 'hover:text-primary-600');

            // Hide all tab content panes
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.add('hidden');
                pane.classList.remove('block');
            });
            // Show target pane
            const target = this.getAttribute('data-target');
            const targetEl = document.querySelector(target);
            targetEl.classList.remove('hidden');
            targetEl.classList.add('block');
        });
    });

    // Modal open handlers
    function editProfile() {
        const modal = new bootstrap.Modal(document.getElementById('editProfileModal'));
        modal.show();
    }

    function confirmDelete() {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
</script>

<?php include_once '../includes/footer.php'; ?>