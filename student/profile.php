<?php include_once '../controllers/profile-process.php'; ?>

<!-- Top Profile Header Cover Banner -->
<div class="bg-gradient-to-r from-primary-700 via-primary-600 to-slate-800 h-52 w-full rounded-b-[2.5rem] shadow-sm -mt-6 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
</div>

<div class="max-w-6xl mx-auto px-4 pb-12 -mt-28 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- SIDEBAR: STUDENT IDENTITY CARD -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white border border-slate-200 rounded-[32px] p-6 md:p-7 shadow-premium relative overflow-hidden">
                <div class="text-center">
                    
                    <!-- Avatar Frame -->
                    <div class="relative w-28 h-28 mx-auto mb-4 mt-2">
                        <div class="w-full h-full rounded-3xl bg-primary-50 border-2 border-primary-100 flex items-center justify-center text-4xl font-extrabold text-primary-600 shadow-md overflow-hidden">
                            <?php if (!empty($user['profile_pic'])): ?>
                                <img src="../assets/images/profiles/<?php echo sanitize($user['profile_pic']); ?>" alt="Profile Picture" class="w-full h-full object-cover">
                            <?php else: ?>
                                <span><?php echo strtoupper(substr($user['username'], 0, 1)); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="absolute bottom-1 right-1 w-5 h-5 bg-emerald-500 rounded-full border-4 border-white shadow-sm" title="Active Account"></div>
                    </div>

                    <!-- User Name & Email -->
                    <h3 class="font-black text-slate-900 text-2xl mb-1 tracking-tight"><?php echo sanitize($user['username']); ?></h3>
                    <p class="text-slate-400 text-sm font-semibold mb-4 flex items-center justify-center">
                        <i class="fas fa-envelope mr-2 text-primary-500"></i><?php echo sanitize($user['email']); ?>
                    </p>

                    <!-- Status Badges -->
                    <div class="flex flex-wrap justify-center gap-2 mb-6">
                        <span class="bg-primary-50 text-primary-600 border border-primary-100/40 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">
                            <i class="fas fa-user-shield mr-1.5"></i><?php echo ucfirst($user['role']); ?>
                        </span>
                        <span class="bg-emerald-50 text-emerald-600 border border-emerald-100 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">
                            <i class="fas fa-check-circle mr-1.5"></i>Verified
                        </span>
                    </div>

                    <!-- Primary Profile Actions -->
                    <div class="flex flex-col gap-2.5 mb-6">
                        <button type="button" onclick="editProfile()" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 rounded-full shadow-md hover:scale-[1.02] transition-all text-sm flex items-center justify-center focus:outline-none">
                            <i class="fas fa-pen-nib mr-2 text-xs"></i> Edit Profile Details
                        </button>
                        
                        <?php if (!empty($user['profile_pic'])): ?>
                            <form action="" method="POST" onsubmit="return confirm('Are you sure you want to remove your profile picture?');">
                                <input type="hidden" name="remove_profile_pic_only" value="1">
                                <button type="submit" class="w-full border border-rose-200 text-rose-600 hover:bg-rose-50 text-xs font-bold py-2 rounded-full transition-all focus:outline-none">
                                    <i class="fas fa-trash-alt mr-1.5"></i> Remove Photo
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <!-- Identity Detail Meta Rows -->
                    <div class="space-y-3 text-left border-t border-slate-100 pt-6">
                        <div class="flex items-center p-3 bg-slate-50/70 rounded-2xl border border-slate-100">
                            <div class="w-9 h-9 bg-white border border-slate-200 text-slate-500 flex items-center justify-center rounded-xl text-sm mr-3 flex-shrink-0 shadow-sm">
                                <i class="far fa-calendar-alt text-primary-600"></i>
                            </div>
                            <div>
                                <div class="text-slate-400 text-[11px] font-bold uppercase tracking-wider mb-0.5">Joined Date</div>
                                <div class="font-bold text-slate-800 text-xs"><?php echo date('M d, Y', strtotime($user['created_at'])); ?></div>
                            </div>
                        </div>

                        <div class="flex items-center p-3 bg-slate-50/70 rounded-2xl border border-slate-100">
                            <div class="w-9 h-9 bg-white border border-slate-200 text-slate-500 flex items-center justify-center rounded-xl text-sm mr-3 flex-shrink-0 shadow-sm">
                                <i class="fas fa-globe text-amber-500"></i>
                            </div>
                            <div>
                                <div class="text-slate-400 text-[11px] font-bold uppercase tracking-wider mb-0.5">Academic Division</div>
                                <div class="font-bold text-slate-800 text-xs">Global Student Portal</div>
                            </div>
                        </div>

                        <!-- Direct Link to Settings -->
                        <a href="settings.php" class="flex items-center justify-between p-3.5 bg-primary-50/50 hover:bg-primary-50 rounded-2xl border border-primary-100/50 transition-all text-primary-600 group">
                            <div class="flex items-center">
                                <i class="fas fa-cog mr-2.5 text-primary-600 group-hover:rotate-45 transition-transform"></i>
                                <span class="text-xs font-bold">Account & Security Settings</span>
                            </div>
                            <i class="fas fa-chevron-right text-xs opacity-60"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <!-- MAIN CONTENT: ACADEMIC DASHBOARD & PORTFOLIO -->
        <div class="lg:col-span-8 space-y-7">
            
            <!-- 1. ACADEMIC HIGHLIGHT METRICS (4-GRID) -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <!-- Stat 1: Quizzes Attempted -->
                <div class="bg-white border border-slate-200 p-5 rounded-3xl shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-base mb-3 shadow-sm">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="text-2xl font-black text-slate-900 mb-0.5"><?php echo $stats_count; ?></div>
                    <div class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Quizzes Taken</div>
                </div>

                <!-- Stat 2: Academic Proficiency -->
                <div class="bg-white border border-slate-200 p-5 rounded-3xl shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base mb-3 shadow-sm">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="text-2xl font-black text-slate-900 mb-0.5"><?php echo $avg_score; ?><span class="text-slate-400 text-sm font-semibold">%</span></div>
                    <div class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Accuracy</div>
                </div>

                <!-- Stat 3: Certificates Earned -->
                <div class="bg-white border border-slate-200 p-5 rounded-3xl shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center text-base mb-3 shadow-sm">
                        <i class="fas fa-award"></i>
                    </div>
                    <div class="text-2xl font-black text-slate-900 mb-0.5"><?php echo $certs_count; ?></div>
                    <div class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Certificates</div>
                </div>

                <!-- Stat 4: High Mode Unlocks -->
                <div class="bg-white border border-slate-200 p-5 rounded-3xl shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-base mb-3 shadow-sm">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="text-2xl font-black text-slate-900 mb-0.5"><?php echo $premium_count; ?></div>
                    <div class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">High Unlocks</div>
                </div>
            </div>

            <!-- 2. PROFICIENCY PROGRESS CARD -->
            <div class="bg-white border border-slate-200 rounded-[32px] p-6 md:p-8 shadow-premium">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h4 class="font-extrabold text-slate-900 text-base mb-0.5 flex items-center">
                            <i class="fas fa-graduation-cap text-primary-600 mr-2"></i> Overall Academic Standing
                        </h4>
                        <p class="text-slate-400 text-xs font-semibold">Based on total scores across all completed quiz assessments.</p>
                    </div>
                    <span class="bg-primary-50 text-primary-600 border border-primary-100 text-xs font-black px-3.5 py-1.5 rounded-full">
                        <?php 
                            if ($avg_score >= 85) echo '🏆 Scholar Master';
                            else if ($avg_score >= 70) echo '⭐ Advanced Learner';
                            else if ($avg_score >= 50) echo '📚 Active Scholar';
                            else echo '🌱 Beginner';
                        ?>
                    </span>
                </div>
                <div class="w-full bg-slate-100 h-3 rounded-full overflow-hidden p-0.5 border border-slate-200/60">
                    <div class="bg-gradient-to-r from-primary-600 to-amber-500 h-full rounded-full transition-all duration-1000" style="width: <?php echo max(5, min(100, $avg_score)); ?>%;"></div>
                </div>
            </div>

            <!-- 3. STUDENT BIOGRAPHY BOX -->
            <div class="bg-white border border-slate-200 rounded-[32px] p-6 md:p-8 shadow-premium">
                <div class="flex justify-between items-center mb-4 pb-3 border-b border-slate-100">
                    <h4 class="font-extrabold text-slate-900 text-base flex items-center">
                        <i class="fas fa-quote-left text-amber-500 mr-2.5"></i> Student Biography & Statement
                    </h4>
                    <button type="button" onclick="editProfile()" class="text-xs text-primary-600 hover:text-primary-700 font-bold border border-primary-200 hover:bg-primary-50 px-3.5 py-1.5 rounded-full transition-all focus:outline-none">
                        <i class="fas fa-pen-nib mr-1.5"></i> Edit Bio
                    </button>
                </div>
                <div class="text-slate-700 text-sm leading-relaxed font-medium">
                    <?php if (!empty($user['bio'])): ?>
                        <?php echo nl2br(sanitize($user['bio'])); ?>
                    <?php else: ?>
                        <div class="text-center py-6 text-slate-400 italic bg-slate-50/60 rounded-2xl border border-dashed border-slate-200">
                            <i class="fas fa-user-edit block mb-2 opacity-30 text-2xl"></i>
                            Your academic biography is empty. Click "Edit Bio" to share your goals!
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- 4. EARNED HONORS & BADGES SHOWCASE -->
            <div class="bg-white border border-slate-200 rounded-[32px] p-6 md:p-8 shadow-premium">
                <h4 class="font-extrabold text-slate-900 text-base mb-4 flex items-center">
                    <i class="fas fa-medal text-amber-500 mr-2.5"></i> Academic Honors & Achievements
                </h4>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <!-- Badge 1: Starter -->
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 text-center">
                        <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center text-xl mx-auto mb-2 shadow-sm">
                            <i class="fas fa-seedling"></i>
                        </div>
                        <strong class="text-slate-800 text-xs font-extrabold block">Quiz Scholar</strong>
                        <span class="text-slate-400 text-[10px] font-semibold block mt-0.5">Joined Quizara</span>
                    </div>

                    <!-- Badge 2: Accuracy Expert -->
                    <div class="p-4 rounded-2xl <?php echo $avg_score >= 70 ? 'bg-emerald-50/70 border border-emerald-100' : 'bg-slate-50 border border-slate-100 opacity-50'; ?> text-center">
                        <div class="w-12 h-12 rounded-full <?php echo $avg_score >= 70 ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-400'; ?> flex items-center justify-center text-xl mx-auto mb-2 shadow-sm">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <strong class="text-slate-800 text-xs font-extrabold block">Accuracy Expert</strong>
                        <span class="text-slate-400 text-[10px] font-semibold block mt-0.5">70%+ Score Avg</span>
                    </div>

                    <!-- Badge 3: Certified -->
                    <div class="p-4 rounded-2xl <?php echo $certs_count > 0 ? 'bg-amber-50/70 border border-amber-100' : 'bg-slate-50 border border-slate-100 opacity-50'; ?> text-center">
                        <div class="w-12 h-12 rounded-full <?php echo $certs_count > 0 ? 'bg-amber-400 text-slate-900' : 'bg-slate-200 text-slate-400'; ?> flex items-center justify-center text-xl mx-auto mb-2 shadow-sm">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <strong class="text-slate-800 text-xs font-extrabold block">Certified Pro</strong>
                        <span class="text-slate-400 text-[10px] font-semibold block mt-0.5">Earned Certificate</span>
                    </div>

                    <!-- Badge 4: High Mode Challenger -->
                    <div class="p-4 rounded-2xl <?php echo $premium_count > 0 ? 'bg-indigo-50/70 border border-indigo-100' : 'bg-slate-50 border border-slate-100 opacity-50'; ?> text-center">
                        <div class="w-12 h-12 rounded-full <?php echo $premium_count > 0 ? 'bg-indigo-600 text-white' : 'bg-slate-200 text-slate-400'; ?> flex items-center justify-center text-xl mx-auto mb-2 shadow-sm">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <strong class="text-slate-800 text-xs font-extrabold block">High Mode Hero</strong>
                        <span class="text-slate-400 text-[10px] font-semibold block mt-0.5">Premium Unlocked</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Edit Profile Credentials Modal -->
<div class="modal fixed inset-0 z-50 items-center justify-center bg-slate-900/60 backdrop-blur-sm hidden" id="editProfileModal" aria-hidden="true">
    <div class="bg-white rounded-[32px] shadow-premium max-w-lg w-full m-4 relative border border-slate-100 overflow-hidden animate-bounce-in">
        <div class="bg-primary-600 p-6 text-white relative">
            <h4 class="text-xl font-black mb-1">Edit Profile Credentials</h4>
            <p class="text-primary-100 text-xs font-medium opacity-80">Update your public identity, photo, and academic bio</p>
            <button type="button" class="absolute top-6 right-6 text-white/80 hover:text-white text-lg focus:outline-none" data-bs-dismiss="modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-6 md:p-8 bg-white">
            <form action="" method="POST" enctype="multipart/form-data" class="space-y-5">
                <input type="hidden" name="update_profile" value="1">

                <div class="text-center">
                    <label for="profileUpload" class="cursor-pointer relative inline-block">
                        <div class="relative w-24 h-24 mx-auto mb-2">
                            <div class="w-full h-full rounded-3xl bg-primary-50 border-2 border-primary-100 flex items-center justify-center text-3xl font-bold text-primary-600 shadow-sm overflow-hidden">
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
                    <div class="text-[11px] text-slate-400 mt-1">Recommended: JPG or PNG under 2MB</div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="username" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Public Username</label>
                        <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border <?php echo isset($errors['username']) ? 'border-red-500' : 'border-slate-200'; ?> bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                            <span class="px-4 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-user-tag"></i></span>
                            <input type="text" class="flex-grow px-4 py-3 text-sm bg-white focus:outline-none text-slate-800 font-medium" id="username" name="username" value="<?php echo sanitize($user['username']); ?>">
                        </div>
                        <?php if (isset($errors['username'])): ?>
                            <p class="error-text text-red-600 text-sm mt-1.5 font-semibold"><?php echo $errors['username']; ?></p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Primary Email</label>
                        <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border <?php echo isset($errors['email']) ? 'border-red-500' : 'border-slate-200'; ?> bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                            <span class="px-4 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-at"></i></span>
                            <input type="email" class="flex-grow px-4 py-3 text-sm bg-white focus:outline-none text-slate-800 font-medium" id="email" name="email" value="<?php echo sanitize($user['email']); ?>">
                        </div>
                        <?php if (isset($errors['email'])): ?>
                            <p class="error-text text-red-600 text-sm mt-1.5 font-semibold"><?php echo $errors['email']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <label for="bio" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Student Biography</label>
                    <div class="premium-input-group flex shadow-sm rounded-xl overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                        <span class="px-4 bg-slate-50 border-r border-slate-200 flex items-start pt-3 text-slate-400 text-sm"><i class="fas fa-quote-right"></i></span>
                        <textarea class="flex-grow px-4 py-3 text-sm bg-white focus:outline-none text-slate-800 resize-none font-medium" id="bio" name="bio" rows="3" placeholder="Brief statement about your academic goals..."><?php echo sanitize($user['bio'] ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-3 border-t border-slate-100">
                    <button type="button" class="border border-slate-200 text-slate-500 hover:bg-slate-50 font-bold px-5 py-2.5 rounded-full text-xs transition-all focus:outline-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-6 py-2.5 rounded-full shadow-md text-xs transition-all focus:outline-none hover:scale-105">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editProfile() {
    const modal = new bootstrap.Modal(document.getElementById('editProfileModal'));
    modal.show();
}
</script>

<?php include_once '../includes/footer.php'; ?>