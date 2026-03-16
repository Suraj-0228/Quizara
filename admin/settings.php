<?php include_once 'controllers/settings-process.php'; ?>

<div class="container py-5">
    <!-- Page Header -->
    <div class="row mb-5 align-items-center">
        <div class="col-md-8">
            <h2 class="fw-black text-slate-900 mb-2">Settings & Configuration</h2>
            <p class="text-slate-500 small fw-medium">Manage global application settings and platform preferences.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <div class="d-inline-flex bg-slate-50 rounded-pill p-2 border border-slate-200">
                <span class="px-3 py-1 text-slate-600 small fw-bold"><i class="fas fa-server text-indigo-500 me-2"></i>System Engine Online</span>
            </div>
        </div>
    </div>

    <?php if ($message): ?>
        <div class="alert alert-<?php echo $messageType; ?> glass-alert mb-5 border-0 border-start border-<?php echo $messageType; ?> border-4 shadow-premium">
            <div class="d-flex align-items-center p-2">
                <i class="fas fa-<?php echo $messageType == 'success' ? 'check-circle' : 'exclamation-circle'; ?> fs-4 me-3 text-<?php echo $messageType; ?>"></i>
                <div class="fw-bold text-slate-800"><?php echo $message; ?></div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Sidebar Navigation -->
        <div class="col-lg-3">
            <div class="card glass-card border-0 shadow-premium sticky-top" style="top: 100px; z-index: 10; border-radius: 20px;">
                <div class="nav flex-column nav-pills p-3" id="v-pills-tab" role="tablist">
                    <button class="nav-link active d-flex align-items-center p-3 mb-2 rounded-4" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab">
                        <div class="icon-square-vibrant bg-indigo-50 text-indigo-600 me-3">
                            <i class="fas fa-sliders-h"></i>
                        </div>
                        <span class="fw-bold small text-uppercase tracking-wider">General</span>
                    </button>
                    <button class="nav-link d-flex align-items-center p-3 mb-2 rounded-4" id="v-pills-system-tab" data-bs-toggle="pill" data-bs-target="#v-pills-system" type="button" role="tab">
                        <div class="icon-square-vibrant bg-rose-50 text-rose-600 me-3">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <span class="fw-bold small text-uppercase tracking-wider">Security</span>
                    </button>
                    <button class="nav-link d-flex align-items-center p-3 mb-2 rounded-4" id="v-pills-email-tab" data-bs-toggle="pill" data-bs-target="#v-pills-email" type="button" role="tab">
                        <div class="icon-square-vibrant bg-blue-50 text-blue-600 me-3">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <span class="fw-bold small text-uppercase tracking-wider">Messaging</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- content -->
        <div class="col-lg-9">
            <form action="" method="POST">
                <div class="tab-content" id="v-pills-tabContent">

                    <!-- General Settings -->
                    <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel">
                        <div class="card glass-card border-0 shadow-premium mb-4 rounded-4 overflow-hidden">
                            <div class="card-header bg-slate-50 border-bottom border-slate-100 py-3 px-4">
                                <h5 class="fw-black text-slate-800 mb-0"><i class="fas fa-fingerprint text-indigo-500 me-2"></i>Site Identity</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label text-slate-400 x-small fw-black text-uppercase tracking-widest">Platform Name</label>
                                        <div class="premium-input-group">
                                            <i class="fas fa-globe input-icon"></i>
                                            <input type="text" class="premium-control" name="site_name" value="<?php echo isset($settings['site_name']) ? sanitize($settings['site_name']) : 'Quizara'; ?>" placeholder=" ">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label text-slate-400 x-small fw-black text-uppercase tracking-widest">Contact Email</label>
                                        <div class="premium-input-group">
                                            <i class="fas fa-at input-icon"></i>
                                            <input type="email" class="premium-control" name="contact_email" value="<?php echo isset($settings['contact_email']) ? sanitize($settings['contact_email']) : ''; ?>" placeholder=" ">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-slate-400 x-small fw-black text-uppercase tracking-widest">Site Description</label>
                                        <textarea class="form-control premium-control" name="site_description" rows="3" placeholder="Brief description of your platform..."><?php echo isset($settings['site_description']) ? sanitize($settings['site_description']) : ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card glass-card border-0 shadow-premium mb-4 rounded-4 overflow-hidden">
                            <div class="card-header bg-slate-50 border-bottom border-slate-100 py-3 px-4">
                                <h5 class="fw-black text-slate-800 mb-0"><i class="fas fa-layer-group text-indigo-500 me-2"></i>Display Preferences</h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row align-items-center g-4">
                                    <div class="col-md-8">
                                        <h6 class="fw-bold text-slate-900 mb-1">Pagination Limit</h6>
                                        <p class="text-slate-500 small fw-medium mb-0">How many items should we show per page in administrative tables?</p>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-select premium-control border-slate-200" name="items_per_page">
                                            <option value="10" <?php echo (isset($settings['items_per_page']) && $settings['items_per_page'] == '10') ? 'selected' : ''; ?>>10 Rows Per Page</option>
                                            <option value="20" <?php echo (isset($settings['items_per_page']) && $settings['items_per_page'] == '20') ? 'selected' : ''; ?>>20 Rows Per Page</option>
                                            <option value="50" <?php echo (isset($settings['items_per_page']) && $settings['items_per_page'] == '50') ? 'selected' : ''; ?>>50 Rows Per Page</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Settings -->
                    <div class="tab-pane fade" id="v-pills-system" role="tabpanel">
                        <div class="card glass-card border-0 shadow-premium mb-4 rounded-4 overflow-hidden">
                            <div class="card-header bg-slate-50 border-bottom border-slate-100 py-3 px-4">
                                <h5 class="fw-black text-slate-800 mb-0"><i class="fas fa-user-lock text-rose-500 me-2"></i>Access Control</h5>
                            </div>
                            <div class="card-body p-4">
                                <!-- Maintenance Mode -->
                                <div class="d-flex align-items-center justify-content-between p-4 rounded-4 bg-slate-50 border border-slate-100 mb-4 hover-lift transition-all">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-square-vibrant bg-amber-50 text-amber-600 me-4">
                                            <i class="fas fa-tools fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-black text-slate-900 mb-1">Maintenance Mode</h6>
                                            <p class="text-slate-500 small fw-medium mb-0">Put the site into read-only mode for maintenance.</p>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch p-0 m-0">
                                        <input class="form-check-input fs-3 cursor-pointer ms-0" type="checkbox" name="maintenance_mode" <?php echo (isset($settings['maintenance_mode']) && $settings['maintenance_mode'] == '1') ? 'checked' : ''; ?>>
                                    </div>
                                </div>

                                <!-- Registration -->
                                <div class="d-flex align-items-center justify-content-between p-4 rounded-4 bg-slate-50 border border-slate-100 mb-0 hover-lift transition-all">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-square-vibrant bg-emerald-50 text-emerald-600 me-4">
                                            <i class="fas fa-user-plus fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-black text-slate-900 mb-1">Open Registration</h6>
                                            <p class="text-slate-500 small fw-medium mb-0">Allow new students to create accounts on the platform.</p>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch p-0 m-0">
                                        <input class="form-check-input fs-3 cursor-pointer ms-0" type="checkbox" name="allow_registration" <?php echo (isset($settings['allow_registration']) && $settings['allow_registration'] == '1') ? 'checked' : ''; ?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email Settings (Placeholder for future expansion) -->
                    <div class="tab-pane fade" id="v-pills-email" role="tabpanel">
                        <div class="card glass-card border-0 shadow-premium mb-4 rounded-4 overflow-hidden">
                            <div class="card-header bg-slate-50 border-bottom border-slate-100 py-3 px-4">
                                <h5 class="fw-black text-slate-800 mb-0"><i class="fas fa-paper-plane text-blue-500 me-2"></i>Email Relay</h5>
                            </div>
                            <div class="card-body p-5 text-center">
                                <div class="icon-square-vibrant bg-blue-50 text-blue-600 mx-auto mb-4" style="width: 80px; height: 80px; border-radius: 25px;">
                                    <i class="fas fa-envelope-open-text fa-2x"></i>
                                </div>
                                <h4 class="fw-black text-slate-900 mb-2">Email Configuration</h4>
                                <p class="text-slate-500 small fw-medium mb-4 mx-auto" style="max-width: 400px;">Messaging services are currently handled by the core system relay. SMTP configuration will be available in future enterprise updates.</p>
                                <button type="button" class="btn btn-outline-slate rounded-pill px-4" disabled>Coming Soon</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="d-flex justify-content-end gap-3 mt-5 pb-5">
                    <button type="button" class="btn btn-outline-slate rounded-pill px-4 fw-bold" onclick="window.history.back()">Discard Changes</button>
                    <button type="submit" class="btn btn-indigo rounded-pill px-5 py-3 shadow-premium fw-black hover-scale">
                        Save Configuration <i class="fas fa-check-circle ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
</div>

<?php include_once '../includes/admin-footer.php'; ?>