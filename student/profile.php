<?php include_once '../controllers/profile-process.php'; ?>

<!-- Profile Header Area -->
<div class="profile-cover-premium shadow-sm"></div>

<div class="container pb-5 px-lg-5">
    <div class="row g-4">
        <!-- Sidebar: Identity Card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-premium rounded-4 overflow-hidden position-relative">
                <div class="card-texture-subtle position-absolute top-0 start-0 w-100 h-100 opacity-50"></div>
                <div class="card-body p-4 p-xl-5 text-center position-relative">
                    <!-- Avatar Section -->
                    <div class="avatar-container-premium mx-auto mb-4" style="margin-top: 10px;">
                        <div class="avatar-inner-premium">
                            <?php if (!empty($user['profile_pic'])): ?>
                                <img src="../assets/images/profiles/<?php echo sanitize($user['profile_pic']); ?>" alt="Profile Picture" class="w-100 h-100" style="object-fit: cover; border-radius: 20px;">
                            <?php else: ?>
                                <span><?php echo strtoupper(substr($user['username'], 0, 1)); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="status-indicator-premium bg-success"></div>
                    </div>

                    <h3 class="fw-black text-slate-900 mb-1"><?php echo sanitize($user['username']); ?></h3>
                    <p class="text-muted small mb-4">
                        <i class="fas fa-envelope-open me-2 text-indigo-400"></i><?php echo sanitize($user['email']); ?>
                    </p>

                    <div class="d-flex justify-content-center gap-2 mb-4 pb-2">
                        <span class="badge bg-indigo-50 text-primary border border-indigo-100 rounded-pill px-3 py-2 fw-bold small">
                            <i class="fas fa-user-shield me-1"></i><?php echo ucfirst($user['role']); ?>
                        </span>
                        <span class="badge bg-emerald-50 text-success border border-emerald-100 rounded-pill px-3 py-2 fw-bold small">
                            <i class="fas fa-check-circle me-1"></i>Active
                        </span>
                    </div>

                    <?php if (!empty($user['profile_pic'])): ?>
                        <form action="" method="POST" class="mb-4" onsubmit="return confirm('Are you sure you want to remove your profile picture?');">
                            <input type="hidden" name="remove_profile_pic_only" value="1">
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-4 shadow-sm">
                                <i class="fas fa-image-portrait me-2"></i>Remove Photo
                            </button>
                        </form>
                    <?php endif; ?>

                    <div class="vstack gap-3 text-start mt-4">
                        <div class="profile-info-item">
                            <div class="d-flex align-items-center">
                                <div class="icon-box-premium me-3">
                                    <i class="far fa-calendar-check"></i>
                                </div>
                                <div>
                                    <div class="text-muted small fw-bold text-uppercase tracking-tighter" style="font-size: 0.65rem;">Academic Join Date</div>
                                    <div class="fw-bold text-slate-800"><?php echo date('M d, Y', strtotime($user['created_at'])); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-info-item">
                            <div class="d-flex align-items-center">
                                <div class="icon-box-premium me-3">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <div class="text-muted small fw-bold text-uppercase tracking-tighter" style="font-size: 0.65rem;">Registered Region</div>
                                    <div class="fw-bold text-slate-800">Global Student</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-premium rounded-4 h-100 overflow-hidden">
                <div class="card-header bg-white border-0 p-4 pb-0">
                    <ul class="nav nav-pills nav-pills-premium" id="profileTabs" role="tablist">
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link active w-100" id="overview-tab" data-bs-toggle="pill" data-bs-target="#overview" type="button" role="tab">
                                <i class="fas fa-grid-2 me-2"></i>Performance Overview
                            </button>
                        </li>
                        <li class="nav-item flex-fill" role="presentation">
                            <button class="nav-link w-100" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button" role="tab">
                                <i class="fas fa-shield-halved me-2"></i>Security & Credentials
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-4 p-xl-5">
                    <div class="tab-content" id="profileTabsContent">
                        <!-- Overview Tab -->
                        <div class="tab-pane fade show active" id="overview" role="tabpanel">
                            <div class="row g-4 mb-5">
                                <div class="col-md-6">
                                    <div class="report-summary-card h-100">
                                        <i class="fas fa-award text-primary mb-3 fs-4"></i>
                                        <div class="value display-6 fw-bold text-slate-900 mb-1"><?php echo $stats_count; ?></div>
                                        <div class="label text-muted small fw-bold text-uppercase tracking-wider">Certificates Earned</div>
                                        <div class="progress mt-3" style="height: 4px; background: var(--indigo-50);">
                                            <div class="progress-bar bg-primary" style="width: 85%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="report-summary-card h-100">
                                        <i class="fas fa-chart-line text-success mb-3 fs-4"></i>
                                        <div class="value display-6 fw-bold text-slate-900 mb-1"><?php echo $avg_score; ?><span class="small fs-5 text-slate-400 ms-1">%</span></div>
                                        <div class="label text-muted small fw-bold text-uppercase tracking-wider">Academic Proficiency</div>
                                        <div class="progress mt-3" style="height: 4px; background: var(--emerald-50);">
                                            <div class="progress-bar bg-success" style="width: <?php echo $avg_score; ?>%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 rounded-4 bg-slate-50 border border-slate-100 position-relative overflow-hidden">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="fw-black text-slate-900 mb-0">Student Bio</h5>
                                    <button class="btn btn-premium-nav btn-sm py-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                        <i class="fas fa-pen-nib me-2"></i>Edit Profile
                                    </button>
                                </div>
                                <div class="text-slate-600 lh-relaxed">
                                    <?php if (!empty($user['bio'])): ?>
                                        <?php echo nl2br(sanitize($user['bio'])); ?>
                                    <?php else: ?>
                                        <div class="text-center py-4 text-muted italic">
                                            <i class="fas fa-quote-left d-block mb-3 opacity-25 fs-2"></i>
                                            Your academic biography is currently empty.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Security Tab -->
                        <div class="tab-pane fade" id="security" role="tabpanel">
                            <div class="card border-0 bg-slate-50 rounded-4 overflow-hidden mb-4">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="icon-box-premium me-3" style="width: 50px; height: 50px; font-size: 1.5rem;">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-black text-slate-900 mb-1">Passphrase Management</h5>
                                            <p class="text-muted small mb-0">Change your primary account credentials</p>
                                        </div>
                                    </div>

                                    <form action="" method="POST">
                                        <input type="hidden" name="update_password" value="1">
                                        <div class="row g-4 mb-3">
                                            <div class="col-12">
                                                <label class="small fw-bold text-slate-700 mb-2">New Password</label>
                                                <div class="input-group <?php echo isset($errors['password']) ? 'is-invalid-premium' : ''; ?>">
                                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-key text-slate-400"></i></span>
                                                    <input type="password" class="form-control border-start-0 py-3" name="password" placeholder="••••••••">
                                                </div>
                                                <?php if (isset($errors['password'])): ?>
                                                    <div class="invalid-feedback-premium"><?php echo $errors['password']; ?></div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-12">
                                                <label class="small fw-bold text-slate-700 mb-2">Verify Password</label>
                                                <div class="input-group <?php echo isset($errors['confirm_password']) ? 'is-invalid-premium' : ''; ?>">
                                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-shield text-slate-400"></i></span>
                                                    <input type="password" class="form-control border-start-0 py-3" name="confirm_password" placeholder="••••••••">
                                                </div>
                                                <?php if (isset($errors['confirm_password'])): ?>
                                                    <div class="invalid-feedback-premium"><?php echo $errors['confirm_password']; ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn update-btn mt-3 rounded-pill px-5 shadow-premium">
                                            <i class="fas fa-rotate me-2"></i>Update Security
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="p-4 rounded-4 bg-red-50 border border-red-100">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                    <div>
                                        <h5 class="text-red-600 fw-black mb-1">Archival & Destruction</h5>
                                        <p class="text-muted small mb-0">Permanently remove your student record and history.</p>
                                    </div>
                                    <button class="btn btn-outline-danger rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#deleteModal">
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
</div>

<!-- Delete Confirmation Modal (Same as before) -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-white border-0 shadow-lg">
            <div class="modal-header border-slate-100">
                <h5 class="modal-title fw-bold">Delete Account?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <p class="text-muted mb-4">This action cannot be undone. To confirm, type <strong>"DELETE"</strong> below.</p>
                <form action="" method="POST">
                    <input type="hidden" name="delete_account" value="1">
                    <div class="mb-4 w-75 mx-auto">
                        <input type="text" class="form-control bg-white text-slate-900 border-danger text-center tracking-wider" name="confirm_delete" placeholder="DELETE" required autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-danger w-75 rounded-pill shadow">Permanently Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Edit Profile Modal (Premium Redesign) -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 rounded-4 overflow-hidden shadow-premium">
            <div class="modal-header border-0 bg-indigo-600 p-4 p-xl-5 text-white position-relative">
                <div class="card-texture-subtle position-absolute top-0 start-0 w-100 h-100 opacity-10"></div>
                <div class="position-relative z-1">
                    <h4 class="modal-title fw-black mb-1">Edit Student Credentials</h4>
                    <p class="text-indigo-100 small mb-0 opacity-75">Update your public identity and account settings</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-xl-5 bg-white">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="update_profile" value="1">

                    <div class="text-center mb-5">
                        <label for="profileUpload" class="cursor-pointer position-relative d-inline-block">
                            <div class="avatar-container-premium mx-auto mb-2" style="width: 100px; height: 100px;">
                                <div class="avatar-inner-premium" style="font-size: 2rem; border-radius: 20px;">
                                    <?php if (!empty($user['profile_pic'])): ?>
                                        <img src="../assets/images/profiles/<?php echo sanitize($user['profile_pic']); ?>" alt="Profile" class="w-100 h-100" style="object-fit: cover; border-radius: 18px;">
                                    <?php else: ?>
                                        <span><?php echo strtoupper(substr($user['username'], 0, 1)); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="position-absolute bg-white text-indigo-600 rounded-circle shadow-sm d-flex align-items-center justify-content-center border"
                                style="width: 32px; height: 32px; bottom: 5px; right: -5px; z-index: 10;">
                                <i class="fas fa-camera small"></i>
                            </div>
                        </label>
                        <input type="file" id="profileUpload" name="profile_pic" class="d-none" accept="image/jpeg,image/png,image/gif">
                        <div class="small text-muted mt-2">Recommended: 400x400px JPG/PNG</div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-12">
                            <label class="small fw-bold text-slate-700 mb-2 text-uppercase tracking-wider">Public Username</label>
                            <div class="input-group <?php echo isset($errors['username']) ? 'is-invalid-premium' : ''; ?>">
                                <span class="input-group-text bg-slate-50 border-end-0 text-slate-400"><i class="fas fa-user-tag"></i></span>
                                <input type="text" class="form-control border-start-0 py-3" name="username" value="<?php echo sanitize($user['username']); ?>" required>
                            </div>
                            <?php if (isset($errors['username'])): ?>
                                <div class="invalid-feedback-premium"><?php echo $errors['username']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label class="small fw-bold text-slate-700 mb-2 text-uppercase tracking-wider">Primary Email</label>
                            <div class="input-group <?php echo isset($errors['email']) ? 'is-invalid-premium' : ''; ?>">
                                <span class="input-group-text bg-slate-50 border-end-0 text-slate-400"><i class="fas fa-at"></i></span>
                                <input type="email" class="form-control border-start-0 py-3" name="email" value="<?php echo sanitize($user['email']); ?>" required>
                            </div>
                            <?php if (isset($errors['email'])): ?>
                                <div class="invalid-feedback-premium"><?php echo $errors['email']; ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="small fw-bold text-slate-700 mb-2 text-uppercase tracking-wider">Student Biography</label>
                        <div class="input-group">
                            <span class="input-group-text bg-slate-50 border-end-0 text-slate-400 align-items-start pt-3"><i class="fas fa-quote-right"></i></span>
                            <textarea class="form-control border-start-0 py-3" name="bio" rows="4" placeholder="Brief statement about your academic goals..."><?php echo sanitize($user['bio'] ?? ''); ?></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 pt-3">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" class="btn update-btn rounded-pill px-5 shadow-premium">Commit Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-red-50 {
        background-color: #fef2f2;
    }

    .text-red-600 {
        color: #dc2626;
    }

    .border-red-100 {
        border-color: #fee2e2;
    }

    .update-btn {
        background-color: #4f46e5;
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .update-btn:hover {
        background-color: #4338ca;
        color: #fff;
        transform: translateY(-2px);
    }

    /* Modal tweaks */
    .modal-backdrop.show {
        opacity: 0.8;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    .modal-content {
        transition: transform 0.3s ease-out;
    }

    .modal.fade .modal-dialog {
        transform: scale(0.95);
    }

    .modal.show .modal-dialog {
        transform: scale(1);
    }

    .lh-relaxed {
        line-height: 1.8;
    }
</style>

<?php include_once '../includes/footer.php'; ?>