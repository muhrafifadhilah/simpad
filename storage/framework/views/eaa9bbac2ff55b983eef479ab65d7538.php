<?php $__env->startSection('content'); ?>
<div class="login-container">
    <div class="login-background">
        <div class="login-overlay"></div>
    </div>
    
    <div class="login-content">
        <!-- Logo Section -->
        <div class="login-logo">
            <img src="<?php echo e(asset('assets/img/semut.svg')); ?>" alt="Logo Kabupaten Bogor" class="logo-img">
            <h1 class="login-title">SIMPAD</h1>
            <p class="login-subtitle">Sistem Informasi Pengelolaan Anggaran Daerah</p>
        <p class="login-location">Kabupaten Bogor</p>
        </div>
        
        <!-- Login Form -->
        <div class="login-form-container">
            <form method="POST" action="<?php echo e(route('login')); ?>" class="login-form">
                <?php echo csrf_field(); ?>
                
                <div class="form-header">
                    <h2 class="form-title">Masuk ke Sistem</h2>
                    <p class="form-subtitle">Silakan masuk menggunakan akun Anda</p>
                </div>
                
                <?php if(session('status')): ?>
                    <div class="alert alert-success modern-alert">
                        <i class="fas fa-check-circle"></i>
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger modern-alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="userid" class="form-label">User ID</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" 
                               id="userid"
                               name="userid" 
                               class="form-input <?php $__errorArgs = ['userid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               placeholder="Masukkan User ID Anda" 
                               value="<?php echo e(old('userid')); ?>"
                               autocomplete="off" 
                               required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" 
                               id="password"
                               name="password" 
                               class="form-input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               placeholder="Masukkan Password Anda" 
                               autocomplete="off" 
                               required>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>
                
                <div class="form-options">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="remember" id="remember">
                        <span class="checkmark"></span>
                        <span class="checkbox-label">Ingat Saya</span>
                    </label>
                </div>
                
                <button type="submit" class="login-button">
                    <i class="fas fa-sign-in-alt"></i>
                    Masuk ke Sistem
                </button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
    /* Modern Login Page Styles */
    .login-container {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .login-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 50%, var(--secondary-green) 100%);
        z-index: 1;
    }

    .login-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(2px);
    }

    .login-content {
        position: relative;
        z-index: 2;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        max-width: 1200px;
        width: 100%;
        padding: 2rem;
        box-sizing: border-box;
    }

    /* Logo Section */
    .login-logo {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        padding: 2rem;
    }

    .logo-img {
        width: 120px;
        height: 120px;
        object-fit: contain;
        margin-bottom: 1.5rem;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .login-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin: 0 0 0.5rem 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        letter-spacing: 2px;
    }

    .login-subtitle {
        font-size: 1.1rem;
        font-weight: 400;
        margin: 0 0 0.25rem 0;
        opacity: 0.95;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
    }

    .login-location {
        font-size: 1rem;
        font-weight: 500;
        margin: 0;
        opacity: 0.9;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
    }

    /* Form Container */
    .login-form-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: var(--radius-lg);
        padding: 3rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(255, 255, 255, 0.2);
        max-width: 450px;
        width: 100%;
        justify-self: center;
    }

    .form-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--neutral-800);
        margin: 0 0 0.5rem 0;
    }

    .form-subtitle {
        font-size: 0.95rem;
        color: var(--neutral-600);
        margin: 0;
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--neutral-700);
        margin-bottom: 0.5rem;
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        color: var(--neutral-500);
        font-size: 1rem;
        z-index: 3;
    }

    .form-input {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border: 2px solid var(--neutral-300);
        border-radius: var(--radius-md);
        font-size: 1rem;
        transition: var(--transition);
        background-color: white;
        box-sizing: border-box;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary-green);
        box-shadow: 0 0 0 3px rgba(0, 113, 45, 0.1);
    }

    .form-input.is-invalid {
        border-color: #dc3545;
    }

    .password-toggle {
        position: absolute;
        right: 1rem;
        background: none;
        border: none;
        color: var(--neutral-500);
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 4px;
        transition: var(--transition);
        z-index: 3;
    }

    .password-toggle:hover {
        color: var(--neutral-700);
        background-color: var(--neutral-200);
    }

    /* Checkbox Styling */
    .form-options {
        margin-bottom: 2rem;
    }

    .checkbox-wrapper {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 0.9rem;
        color: var(--neutral-700);
    }

    .checkbox-wrapper input[type="checkbox"] {
        display: none;
    }

    .checkmark {
        width: 18px;
        height: 18px;
        border: 2px solid var(--neutral-400);
        border-radius: 4px;
        margin-right: 0.75rem;
        position: relative;
        transition: var(--transition);
    }

    .checkbox-wrapper input[type="checkbox"]:checked + .checkmark {
        background-color: var(--primary-green);
        border-color: var(--primary-green);
    }

    .checkbox-wrapper input[type="checkbox"]:checked + .checkmark::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 12px;
        font-weight: bold;
    }

    /* Login Button */
    .login-button {
        width: 100%;
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
        color: white;
        border: none;
        border-radius: var(--radius-md);
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        box-shadow: var(--shadow-md);
    }

    .login-button:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .login-button:active {
        transform: translateY(0);
    }

    /* Modern Alert */
    .modern-alert {
        padding: 1rem;
        border-radius: var(--radius-md);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.9rem;
        border: none;
    }

    .alert-success {
        background-color: #d1e7dd;
        color: #0a3622;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #58151c;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .login-content {
            grid-template-columns: 1fr;
            gap: 2rem;
            padding: 1rem;
        }

        .login-logo {
            padding: 1rem;
        }

        .logo-img {
            width: 80px;
            height: 80px;
        }

        .login-title {
            font-size: 2.5rem;
        }

        .login-form-container {
            padding: 2rem;
        }
    }

    @media (max-width: 480px) {
        .login-form-container {
            padding: 1.5rem;
        }

        .login-title {
            font-size: 2rem;
        }

        .form-title {
            font-size: 1.5rem;
        }
    }

    /* Hide navbar and sidebar on login page */
    .navbar, .sidebar {
        display: none !important;
    }
    
    /* Hide footer on login page */
    footer, .modern-footer {
        display: none !important;
    }

    /* Reset body styles for login page */
    body {
        margin: 0 !important;
        padding: 0 !important;
        overflow: auto !important;
        background: none !important;
        background-color: transparent !important;
    }
    
    /* Remove any main content margin that might cause white space */
    main {
        margin-left: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        background: none !important;
    }
    
    /* Override content class from layout */
    .content {
        margin-left: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        background: none !important;
        background-color: transparent !important;
        min-height: 100vh !important;
    }
    
    /* Ensure full width container */
    .container-fluid, .container {
        margin: 0 !important;
        padding: 0 !important;
        max-width: 100% !important;
        width: 100% !important;
    }
    
    /* Override any inherited styles */
    html {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        height: 100% !important;
        overflow-x: hidden !important;
    }
</style>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\simpad\resources\views/auth/login.blade.php ENDPATH**/ ?>