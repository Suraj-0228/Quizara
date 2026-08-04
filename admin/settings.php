<?php include_once 'controllers/settings-process.php'; ?>

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
    <div>
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2">Settings & Configuration</h2>
        <p class="text-slate-500 text-sm md:text-base mb-0">Manage global application settings and platform preferences.</p>
    </div>
    <div class="flex-shrink-0">
        <div class="bg-primary-50 text-primary-600 border border-primary-100/30 text-sm font-bold px-4 py-2.5 rounded-full flex items-center shadow-sm">
            <i class="fas fa-server mr-2 text-primary-500 text-xs"></i>
            <span>System Engine Online</span>
        </div>
    </div>
</div>

<?php flash('message'); ?>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Sidebar Navigation -->
    <div class="lg:col-span-3">
        <div class="bg-white border border-slate-200 rounded-3xl p-4 shadow-sm sticky top-[100px] z-10 space-y-2" id="v-pills-tab">
            <button type="button" class="tab-btn w-full flex items-center p-3 rounded-2xl text-left text-sm font-bold transition-all focus:outline-none bg-primary-600 text-white shadow-sm" data-bs-target="#v-pills-general">
                <div class="w-8 h-8 rounded-xl bg-white/15 flex items-center justify-center mr-3 text-sm flex-shrink-0">
                    <i class="fas fa-sliders-h text-xs"></i>
                </div>
                <span class="uppercase tracking-wider text-xs">General</span>
            </button>
            <button type="button" class="tab-btn w-full flex items-center p-3 rounded-2xl text-left text-sm font-bold transition-all focus:outline-none text-slate-500 hover:text-primary-600" data-bs-target="#v-pills-system">
                <div class="w-8 h-8 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center mr-3 text-sm flex-shrink-0">
                    <i class="fas fa-shield-alt text-xs"></i>
                </div>
                <span class="uppercase tracking-wider text-xs">Security</span>
            </button>
            <button type="button" class="tab-btn w-full flex items-center p-3 rounded-2xl text-left text-sm font-bold transition-all focus:outline-none text-slate-500 hover:text-primary-600" data-bs-target="#v-pills-email">
                <div class="w-8 h-8 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center mr-3 text-sm flex-shrink-0">
                    <i class="fas fa-envelope-open-text text-xs"></i>
                </div>
                <span class="uppercase tracking-wider text-xs">Messaging</span>
            </button>
        </div>
    </div>

    <!-- content -->
    <div class="lg:col-span-9">
        <form action="" method="POST">
            <div id="v-pills-tabContent">

                <!-- General Settings -->
                <div class="tab-pane block" id="v-pills-general">
                    <div class="bg-white border border-slate-200 rounded-3xl shadow-premium overflow-hidden mb-6">
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h5 class="font-extrabold text-slate-900 text-base flex items-center"><i class="fas fa-fingerprint text-primary-500 mr-2.5"></i>Site Identity</h5>
                        </div>
                        <div class="p-6 md:p-8 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Platform Name</label>
                                    <div class="flex shadow-sm rounded-lg overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                                        <span class="px-3 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-globe"></i></span>
                                        <input type="text" class="flex-grow px-4 py-2.5 text-sm bg-white focus:outline-none text-slate-800" name="site_name" value="<?php echo isset($settings['site_name']) ? sanitize($settings['site_name']) : 'Quizara'; ?>" placeholder="Site name...">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Contact Email</label>
                                    <div class="flex shadow-sm rounded-lg overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all">
                                        <span class="px-3 bg-slate-50 border-r border-slate-200 flex items-center text-slate-400 text-sm"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="flex-grow px-4 py-2.5 text-sm bg-white focus:outline-none text-slate-800" name="contact_email" value="<?php echo isset($settings['contact_email']) ? sanitize($settings['contact_email']) : ''; ?>" placeholder="support@domain.com">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Site Description</label>
                                <textarea class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm text-slate-800 font-medium focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-all resize-none" name="site_description" rows="3" placeholder="Brief description of your platform..."><?php echo isset($settings['site_description']) ? sanitize($settings['site_description']) : ''; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-200 rounded-3xl shadow-premium overflow-hidden">
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h5 class="font-extrabold text-slate-900 text-base flex items-center"><i class="fas fa-layer-group text-primary-500 mr-2.5"></i>Display Preferences</h5>
                        </div>
                        <div class="p-6 md:p-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <h6 class="font-extrabold text-slate-800 text-sm mb-1">Pagination Limit</h6>
                                <p class="text-slate-400 text-sm">How many items should we show per page in administrative tables?</p>
                            </div>
                            <div class="w-full md:w-auto">
                                <div class="flex shadow-sm rounded-lg overflow-hidden border border-slate-200 bg-white focus-within:ring-2 focus-within:ring-primary-500/20 focus-within:border-primary-600 transition-all relative min-w-[200px]">
                                    <select class="w-full pl-4 pr-10 py-2.5 text-sm bg-white focus:outline-none text-slate-800 cursor-pointer appearance-none" name="items_per_page">
                                        <option value="10" <?php echo (isset($settings['items_per_page']) && $settings['items_per_page'] == '10') ? 'selected' : ''; ?>>10 Rows Per Page</option>
                                        <option value="20" <?php echo (isset($settings['items_per_page']) && $settings['items_per_page'] == '20') ? 'selected' : ''; ?>>20 Rows Per Page</option>
                                        <option value="50" <?php echo (isset($settings['items_per_page']) && $settings['items_per_page'] == '50') ? 'selected' : ''; ?>>50 Rows Per Page</option>
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-4 top-3.5 text-slate-400 pointer-events-none text-sm"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="tab-pane hidden" id="v-pills-system">
                    <div class="bg-white border border-slate-200 rounded-3xl shadow-premium overflow-hidden">
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h5 class="font-extrabold text-slate-900 text-base flex items-center"><i class="fas fa-user-lock text-rose-500 mr-2.5"></i>Access Control</h5>
                        </div>
                        <div class="p-6 md:p-8 space-y-4">
                            <!-- Maintenance Mode Switch -->
                            <div class="flex items-center justify-between p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-sm transition-all">
                                <div class="flex items-center min-w-0">
                                    <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-amber-500 flex items-center justify-center text-base mr-4 flex-shrink-0">
                                        <i class="fas fa-tools"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <h6 class="font-extrabold text-slate-800 text-sm truncate mb-0.5">Maintenance Mode</h6>
                                        <p class="text-slate-400 text-sm truncate">Put the site into read-only mode for maintenance.</p>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer select-none">
                                    <input type="checkbox" name="maintenance_mode" value="1" <?php echo (isset($settings['maintenance_mode']) && $settings['maintenance_mode'] == '1') ? 'checked' : ''; ?> class="sr-only peer">
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                                </label>
                            </div>

                            <!-- Open Registration Switch -->
                            <div class="flex items-center justify-between p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-sm transition-all">
                                <div class="flex items-center min-w-0">
                                    <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-emerald-500 flex items-center justify-center text-base mr-4 flex-shrink-0">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <div class="min-w-0">
                                        <h6 class="font-extrabold text-slate-800 text-sm truncate mb-0.5">Open Registration</h6>
                                        <p class="text-slate-400 text-sm truncate">Allow new students to create accounts on the platform.</p>
                                    </div>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer select-none">
                                    <input type="checkbox" name="allow_registration" value="1" <?php echo (isset($settings['allow_registration']) && $settings['allow_registration'] == '1') ? 'checked' : ''; ?> class="sr-only peer">
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Messaging/Email Settings -->
                <div class="tab-pane hidden" id="v-pills-email">
                    <div class="bg-white border border-slate-200 rounded-3xl shadow-premium overflow-hidden">
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h5 class="font-extrabold text-slate-900 text-base flex items-center"><i class="fas fa-paper-plane text-blue-500 mr-2.5"></i>Email Relay</h5>
                        </div>
                        <div class="p-8 text-center max-w-sm mx-auto">
                            <div class="w-16 h-16 bg-primary-50 border border-primary-100/30 text-primary-600 flex items-center justify-center rounded-2xl mx-auto mb-4 text-2xl">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>
                            <h4 class="font-extrabold text-slate-800 text-base mb-1">Email Configuration</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">Messaging services are currently handled by the core system relay. SMTP configuration will be available in future updates.</p>
                            <button type="button" class="border border-slate-200 text-slate-400 font-bold px-6 py-2 rounded-full text-sm cursor-not-allowed mt-4 focus:outline-none" disabled>Coming Soon</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Footer Actions -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-slate-100 mt-6">
                <button type="button" class="border border-slate-200 text-slate-500 hover:bg-slate-50 font-bold px-5 py-2.5 rounded-full text-sm transition-all focus:outline-none" onclick="window.history.back()">Discard Changes</button>
                <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold px-6 py-2.5 rounded-full shadow-md text-sm transition-all focus:outline-none hover:scale-105">
                    Save Configuration <i class="fas fa-check-circle ml-1.5 text-xs"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Tab switching logic
    document.querySelectorAll('#v-pills-tab button').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active classes from all buttons
            document.querySelectorAll('#v-pills-tab button').forEach(b => {
                b.classList.remove('bg-primary-600', 'text-white', 'shadow-sm');
                b.classList.add('text-slate-500', 'hover:text-primary-600');
                
                // Reset internal icon square wrapper classes
                const iconBox = b.querySelector('.w-8');
                if (iconBox) {
                    iconBox.classList.remove('bg-white/15');
                    iconBox.classList.add('bg-slate-50', 'border', 'border-slate-200');
                }
            });
            // Add active classes to current button
            this.classList.add('bg-primary-600', 'text-white', 'shadow-sm');
            this.classList.remove('text-slate-500', 'hover:text-primary-600');
            
            const iconBox = this.querySelector('.w-8');
            if (iconBox) {
                iconBox.classList.remove('bg-slate-50', 'border', 'border-slate-200');
                iconBox.classList.add('bg-white/15');
            }

            // Hide all tab content panes
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.add('hidden');
                pane.classList.remove('block');
            });
            // Show target pane
            const target = this.getAttribute('data-bs-target');
            const targetEl = document.querySelector(target);
            targetEl.classList.remove('hidden');
            targetEl.classList.add('block');
        });
    });
</script>

<?php include_once '../includes/admin-footer.php'; ?>