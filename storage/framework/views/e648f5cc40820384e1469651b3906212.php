

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="profile-header mb-4">
                <div class="profile-header-content">
                    <div class="header-left d-flex align-items-center">
                        <button class="sidebar-toggle-btn me-3" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div>
                            <h2 class="header-title">Profile Pengguna</h2>
                            <p class="header-subtitle">Kelola informasi akun dan pengaturan</p>
                        </div>
                    </div>
                    <?php if(Auth::user()): ?>
                        <div class="user-profile-modern dropdown">
                            <div class="profile-container" data-bs-toggle="dropdown">
                                <div class="profile-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="profile-info">
                                    <span class="profile-name"><?php echo e(Auth::user()->userid); ?></span>
                                    <?php if(Auth::user()->role): ?>
                                        <small class="profile-role"><?php echo e(ucfirst(Auth::user()->role->name)); ?></small>
                                    <?php endif; ?>
                                </div>
                                <i class="fas fa-chevron-down profile-dropdown-icon"></i>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end modern-dropdown">
                                <li><a class="dropdown-item" href="<?php echo e(route('profile.index')); ?>"><i class="fas fa-user-circle me-2"></i>Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success modern-alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger modern-alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <div class="row">
                <!-- Profile Information Card -->
                <div class="col-md-4">
                    <div class="profile-card">
                        <div class="profile-card-header">
                            <div class="profile-avatar-large">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <h3 class="profile-name"><?php echo e($user->userid); ?></h3>
                            <div class="role-badge role-<?php echo e($user->role->name); ?>">
                                <i class="fas fa-shield-alt me-1"></i>
                                <?php echo e($profileData['role_display']); ?>

                            </div>
                            <p class="role-description"><?php echo e($profileData['description']); ?></p>
                        </div>

                        <div class="profile-card-body">
                            <div class="profile-stats">
                                <div class="stat-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <div class="stat-info">
                                        <span class="stat-label">Bergabung</span>
                                        <span class="stat-value"><?php echo e($profileData['created_at']->format('d M Y')); ?></span>
                                    </div>
                                </div>
                                
                                <?php if(isset($profileData['pegawai'])): ?>
                                    <div class="stat-item">
                                        <i class="fas fa-id-badge"></i>
                                        <div class="stat-info">
                                            <span class="stat-label">NIP</span>
                                            <span class="stat-value"><?php echo e($profileData['pegawai']->nip); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if(isset($profileData['subjek_pajak'])): ?>
                                    <div class="stat-item">
                                        <i class="fas fa-id-card"></i>
                                        <div class="stat-info">
                                            <span class="stat-label">NPWPD</span>
                                            <span class="stat-value"><?php echo e($profileData['subjek_pajak']->npwpd); ?></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="permissions-section">
                                <h5 class="permissions-title">
                                    <i class="fas fa-key me-2"></i>Hak Akses
                                </h5>
                                <ul class="permissions-list">
                                    <?php $__currentLoopData = $profileData['permissions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="permission-item">
                                            <i class="fas fa-check text-success me-2"></i>
                                            <?php echo e($permission); ?>

                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Edit Form -->
                <div class="col-md-8">
                    <div class="edit-profile-card">
                        <div class="card-header-modern">
                            <div class="card-title-section">
                                <h3 class="card-title">
                                    <i class="fas fa-edit me-2"></i>
                                    Edit Profile
                                </h3>
                                <p class="card-subtitle">Perbarui informasi akun Anda</p>
                            </div>
                        </div>

                        <div class="card-body-modern">
                            <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>

                                <!-- Basic Information -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-user me-2"></i>Informasi Akun
                                    </h5>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">User ID</label>
                                                <input type="text" class="form-control" value="<?php echo e($user->userid); ?>" readonly>
                                                <small class="form-text text-muted">User ID tidak dapat diubah</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Role</label>
                                                <input type="text" class="form-control" value="<?php echo e($profileData['role_display']); ?>" readonly>
                                                <small class="form-text text-muted">Role ditentukan oleh administrator</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Role Specific Information -->
                                <?php if($user->role->name === 'pegawai'): ?>
                                    <div class="form-section">
                                        <h5 class="section-title">
                                            <i class="fas fa-id-badge me-2"></i>Informasi Pegawai
                                        </h5>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Nama Lengkap</label>
                                                    <input type="text" name="nama" class="form-control <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                           value="<?php echo e(old('nama', $profileData['pegawai']->nama ?? '')); ?>" required>
                                                    <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">NIP</label>
                                                    <input type="text" name="nip" class="form-control <?php $__errorArgs = ['nip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                           value="<?php echo e(old('nip', $profileData['pegawai']->nip ?? '')); ?>" required>
                                                    <?php $__errorArgs = ['nip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Jabatan</label>
                                                    <input type="text" name="jabatan" class="form-control <?php $__errorArgs = ['jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                           value="<?php echo e(old('jabatan', $profileData['pegawai']->jabatan ?? '')); ?>" required>
                                                    <?php $__errorArgs = ['jabatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif($user->role->name === 'wp'): ?>
                                    <div class="form-section">
                                        <h5 class="section-title">
                                            <i class="fas fa-building me-2"></i>Informasi Wajib Pajak
                                        </h5>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Nama Pemilik/Penanggung Jawab</label>
                                                    <input type="text" name="pemilik" class="form-control <?php $__errorArgs = ['pemilik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                           value="<?php echo e(old('pemilik', $profileData['subjek_pajak']->pemilik ?? '')); ?>" required>
                                                    <?php $__errorArgs = ['pemilik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Alamat</label>
                                                    <textarea name="alamat" class="form-control <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="3" required><?php echo e(old('alamat', $profileData['subjek_pajak']->alamat ?? '')); ?></textarea>
                                                    <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">No. HP</label>
                                                    <input type="text" name="nohp" class="form-control <?php $__errorArgs = ['nohp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                           value="<?php echo e(old('nohp', $profileData['subjek_pajak']->nohp ?? '')); ?>" required>
                                                    <?php $__errorArgs = ['nohp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                           value="<?php echo e(old('email', $profileData['subjek_pajak']->email ?? '')); ?>" required>
                                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Password Change Section -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-lock me-2"></i>Ubah Password
                                    </h5>
                                    <p class="text-muted mb-3">Kosongkan jika tidak ingin mengubah password</p>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Password Saat Ini</label>
                                                <input type="password" name="current_password" class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Password Baru</label>
                                                <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Konfirmasi Password Baru</label>
                                                <input type="password" name="password_confirmation" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary modern-btn">
                                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                                    </button>
                                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary modern-btn ms-2">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Profile Page Styles */
.profile-header {
    background: linear-gradient(135deg, var(--secondary-green) 0%, #B8E6B8 100%);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    border: 1px solid rgba(255,255,255,0.3);
    backdrop-filter: blur(10px);
    padding: 1.5rem 2rem;
}

.profile-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-left {
    display: flex;
    align-items: center;
}

.sidebar-toggle-btn {
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: var(--radius-md);
    color: var(--primary-green);
    padding: 12px 16px;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}

.sidebar-toggle-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    color: var(--primary-green);
    transform: translateY(-1px);
    box-shadow: var(--shadow-sm);
}

.header-title {
    color: var(--primary-green);
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    letter-spacing: -0.025em;
}

.header-subtitle {
    color: var(--neutral-700);
    font-size: 0.95rem;
    margin: 0;
    opacity: 0.8;
}

/* Profile Card */
.profile-card {
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    border: 1px solid var(--neutral-200);
    overflow: hidden;
    margin-bottom: 2rem;
}

.profile-card-header {
    background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
    color: white;
    padding: 2rem;
    text-align: center;
}

.profile-avatar-large {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.9;
}

.profile-name {
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0 0 0.5rem 0;
}

.role-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    margin-bottom: 1rem;
}

.role-badge.role-psi {
    background: rgba(255, 193, 7, 0.2);
    color: #856404;
    border: 1px solid rgba(255, 193, 7, 0.5);
}

.role-badge.role-upt {
    background: rgba(0, 123, 255, 0.2);
    color: #004085;
    border: 1px solid rgba(0, 123, 255, 0.5);
}

.role-badge.role-pegawai {
    background: rgba(40, 167, 69, 0.2);
    color: #155724;
    border: 1px solid rgba(40, 167, 69, 0.5);
}

.role-badge.role-wp {
    background: rgba(108, 117, 125, 0.2);
    color: #495057;
    border: 1px solid rgba(108, 117, 125, 0.5);
}

.role-description {
    font-size: 0.9rem;
    opacity: 0.9;
    margin: 0;
}

.profile-card-body {
    padding: 2rem;
}

.profile-stats {
    margin-bottom: 2rem;
}

.stat-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    padding: 0.75rem;
    background: var(--neutral-100);
    border-radius: var(--radius-md);
}

.stat-item i {
    font-size: 1.2rem;
    color: var(--primary-green);
    margin-right: 1rem;
    width: 20px;
    text-align: center;
}

.stat-info {
    display: flex;
    flex-direction: column;
}

.stat-label {
    font-size: 0.8rem;
    color: var(--neutral-600);
    margin-bottom: 0.25rem;
}

.stat-value {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--neutral-800);
}

.permissions-section {
    border-top: 1px solid var(--neutral-200);
    padding-top: 2rem;
}

.permissions-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--neutral-800);
    margin-bottom: 1rem;
}

.permissions-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.permission-item {
    padding: 0.5rem 0;
    font-size: 0.9rem;
    color: var(--neutral-700);
    display: flex;
    align-items: center;
}

/* Edit Profile Card */
.edit-profile-card {
    background: white;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    border: 1px solid var(--neutral-200);
    overflow: hidden;
}

.card-header-modern {
    background: linear-gradient(135deg, var(--primary-green) 0%, #005A23 100%);
    color: white;
    padding: 1.5rem 2rem;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
}

.card-subtitle {
    font-size: 0.85rem;
    opacity: 0.9;
    margin: 0.25rem 0 0 0;
}

.card-body-modern {
    padding: 2rem;
}

.form-section {
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid var(--neutral-200);
}

.form-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--neutral-800);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-weight: 600;
    color: var(--neutral-700);
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--neutral-300);
    border-radius: var(--radius-md);
    font-size: 0.95rem;
    transition: var(--transition);
}

.form-control:focus {
    outline: none;
    border-color: var(--accent-green);
    box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.form-text {
    font-size: 0.8rem;
    margin-top: 0.25rem;
}

.form-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding-top: 2rem;
    border-top: 1px solid var(--neutral-200);
}

.modern-btn {
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius-md);
    font-weight: 500;
    font-size: 0.95rem;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    text-decoration: none;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.btn-secondary {
    background: var(--neutral-500);
    color: white;
}

.btn-secondary:hover {
    background: var(--neutral-600);
    color: white;
    text-decoration: none;
}

.modern-alert {
    padding: 1rem 1.5rem;
    border-radius: var(--radius-md);
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    border: none;
    font-size: 0.95rem;
}

.alert-success {
    background-color: #d1e7dd;
    color: #0a3622;
}

.alert-danger {
    background-color: #f8d7da;
    color: #58151c;
}

/* User Profile Dropdown in Header */
.user-profile-modern .profile-container {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 16px;
    background: rgba(255,255,255,0.2);
    border-radius: var(--radius-md);
    border: 1px solid rgba(255,255,255,0.3);
    cursor: pointer;
    transition: var(--transition);
}

.user-profile-modern .profile-container:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-1px);
    box-shadow: var(--shadow-sm);
}

.profile-avatar {
    width: 40px;
    height: 40px;
    background: var(--primary-green);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.1rem;
}

.profile-info {
    display: flex;
    flex-direction: column;
}

.profile-name {
    font-weight: 600;
    color: var(--primary-green);
    font-size: 0.95rem;
}

.profile-role {
    color: var(--neutral-700);
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.profile-dropdown-icon {
    color: var(--primary-green);
    font-size: 0.8rem;
    transition: var(--transition);
}

.modern-dropdown {
    border: none;
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-lg);
    padding: 8px;
    margin-top: 8px;
}

.modern-dropdown .dropdown-item {
    border-radius: var(--radius-sm);
    padding: 12px 16px;
    transition: var(--transition);
    display: flex;
    align-items: center;
}

.modern-dropdown .dropdown-item:hover {
    background: var(--neutral-100);
    transform: translateX(4px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-header-content {
        flex-direction: column;
        gap: 1rem;
    }
    
    .row {
        flex-direction: column;
    }
    
    .col-md-4, .col-md-8 {
        max-width: 100%;
    }
}
</style>

<script>
// Sidebar Toggle Functionality
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function() {
            // Toggle sidebar visibility
            sidebar.classList.toggle('collapsed');
            
            // Add/remove class to body for main content adjustment
            document.body.classList.toggle('sidebar-collapsed');
            
            // Update button icon
            const icon = sidebarToggle.querySelector('i');
            if (sidebar.classList.contains('collapsed')) {
                icon.className = 'fas fa-indent';
            } else {
                icon.className = 'fas fa-bars';
            }
        });
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Project\simpad\resources\views/profile/index.blade.php ENDPATH**/ ?>