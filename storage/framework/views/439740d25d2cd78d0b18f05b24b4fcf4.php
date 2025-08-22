<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $__env->yieldContent('title', 'SIMPAD - Sistem Informasi Manajemen Pajak Daerah'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Keuangan Daerah">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('assets/img/semut.svg')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('assets/img/semut-pemda.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('assets/img/semut-pemda.png')); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Modern Design System Variables */
        :root {
            --primary-green: #00712D;
            --primary-orange: #FF6600;
            --secondary-green: #D5ED9F;
            --accent-green: #4CAF50;
            --neutral-100: #FFFBE6;
            --neutral-200: #F8F9FA;
            --neutral-300: #E9ECEF;
            --neutral-400: #DEE2E6;
            --neutral-500: #ADB5BD;
            --neutral-600: #6C757D;
            --neutral-700: #495057;
            --neutral-800: #343A40;
            --neutral-900: #212529;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 8px rgba(0,0,0,0.12);
            --shadow-lg: 0 8px 16px rgba(0,0,0,0.15);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
        }

        html {
            overflow-x: hidden;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: var(--neutral-200);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            width: 100%;
        }

        /* Modern Navbar - Hidden */
        .navbar {
            display: none;
        }

        .navbar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: white !important;
            text-decoration: none;
        }

        .navbar .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .navbar .dropdown-menu {
            background-color: white;
            border: 1px solid var(--neutral-300);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 8px;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }

        .mobile-menu-toggle:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        /* Modern Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--neutral-100) 0%, white 100%);
            color: var(--neutral-800);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            border-right: 1px solid var(--neutral-300);
            box-shadow: var(--shadow-md);
            z-index: 1000;
            transition: var(--transition);
            box-sizing: border-box;
            display: block;
            visibility: visible;
        }

        /* Sidebar Collapsed State */
        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed .sidebar-logo {
            width: 35px;
            height: 35px;
        }

        .sidebar.collapsed .sidebar-nav a {
            justify-content: center;
            padding: 15px;
        }

        .sidebar.collapsed .sidebar-nav a span {
            display: none;
        }

        .sidebar.collapsed .sidebar-nav .dropdown {
            display: none;
        }

        /* Main content adjustment when sidebar is collapsed */
        body.sidebar-collapsed main {
            margin-left: 70px;
        }

        body.sidebar-collapsed .modern-footer {
            margin-left: 70px;
        }

        /* Add spans to sidebar links for text */
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: var(--neutral-700);
            text-decoration: none;
            transition: var(--transition);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            border-left: 3px solid transparent;
            position: relative;
        }

        .sidebar a span {
            margin-left: 12px;
            transition: var(--transition);
        }

        .sidebar-header {
            padding: 24px 24px 24px 24px;
            border-bottom: 1px solid var(--neutral-300);
            margin-bottom: 24px;
            text-align: center;
        }

        .sidebar-logo {
            height: 45px;
            max-width: 200px;
            object-fit: contain;
        }

        .sidebar-nav {
            padding: 0 16px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar a {
            color: var(--neutral-700);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 16px;
            margin-bottom: 4px;
            border-radius: var(--radius-md);
            transition: var(--transition);
            font-weight: 500;
            font-size: 0.95rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
        }

        .sidebar a i {
            width: 20px;
            margin-right: 12px;
            font-size: 1rem;
        }

        .sidebar a:hover {
            background: linear-gradient(135deg, var(--secondary-green) 0%, #C8E6C9 100%);
            color: var(--primary-green);
            transform: translateX(4px);
        }

        .sidebar a.active {
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--accent-green) 100%);
            color: white;
            box-shadow: var(--shadow-sm);
        }

        .sidebar a.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 100%;
            background: var(--primary-orange);
            border-radius: 0 4px 4px 0;
        }

        /* Dropdown Styles */
        .sidebar .dropdown {
            margin-bottom: 4px;
        }

        .sidebar .dropdown-toggle {
            position: relative;
            font-weight: 500;
            font-size: 0.95rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar .dropdown-toggle::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            transition: var(--transition);
        }

        .sidebar .dropdown.show .dropdown-toggle::after {
            transform: translateY(-50%) rotate(180deg);
        }

        .sidebar .dropdown-menu {
            background: var(--neutral-100);
            border: none;
            border-radius: var(--radius-md);
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.06);
            margin: 8px 0 16px 0;
            padding: 8px;
            position: static !important;
            transform: none !important;
            width: 100% !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar .dropdown-menu a {
            padding: 8px 16px 8px 40px;
            font-size: 0.9rem;
            font-weight: 500;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-bottom: 2px;
        }

        /* Content Area */
        .content {
            margin-left: 280px;
            min-height: 100vh;
            width: calc(100% - 280px);
            transition: var(--transition);
            box-sizing: border-box;
            padding: 0;
            overflow-x: auto;
            background-color: var(--neutral-200);
        }

        /* Main content adjustment when sidebar is collapsed */
        body.sidebar-collapsed .content {
            margin-left: 70px;
            width: calc(100% - 70px);
        }

        body.sidebar-collapsed footer {
            margin-left: 70px;
            width: calc(100% - 70px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
                width: 300px;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
                width: 100%;
                padding: 16px;
            }

            footer {
                margin-left: 0;
                width: 100%;
            }

            .modern-footer {
                margin-left: 0;
                width: 100%;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1035;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 8px 16px;
            }

            .sidebar {
                width: 280px;
            }

            .content {
                padding: 12px;
            }
        }

        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: var(--neutral-200);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: var(--neutral-400);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--neutral-500);
        }

        /* Compact Footer */
        .modern-footer {
            background: linear-gradient(135deg, var(--neutral-100) 0%, white 100%);
            border-top: 1px solid var(--neutral-300);
            margin-left: 280px;
            width: calc(100% - 280px);
            transition: var(--transition);
            box-sizing: border-box;
            padding: 0;
        }

        .footer-container {
            max-width: 100%;
            padding: 20px 30px;
            box-sizing: border-box;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        /* Footer Left - Brand */
        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .footer-logo-small {
            height: 32px;
            width: auto;
        }

        .brand-info {
            display: flex;
            flex-direction: column;
        }

        .brand-name {
            font-weight: 600;
            font-size: 1rem;
            color: var(--primary-green);
            line-height: 1.2;
        }

        .brand-desc {
            font-size: 0.75rem;
            color: var(--neutral-600);
            line-height: 1.2;
        }

        /* Footer Center - System Info */
        .system-info {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: var(--neutral-700);
            white-space: nowrap;
        }

        .info-item i {
            font-size: 0.8rem;
            color: var(--primary-green);
        }

        .info-item .text-success {
            color: #28a745 !important;
        }

        /* Footer Right - Meta */
        .footer-meta {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 4px;
        }

        .copyright {
            font-size: 0.8rem;
            color: var(--neutral-600);
        }

        .version-info {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .version {
            background: var(--primary-green);
            color: white;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 500;
        }

        .build {
            color: var(--neutral-500);
            font-size: 0.7rem;
        }

        /* Footer Responsive */
        @media (max-width: 768px) {
            .modern-footer {
                margin-left: 0;
                width: 100%;
            }

            .footer-container {
                padding: 15px 20px;
            }

            .footer-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .system-info {
                flex-direction: column;
                gap: 8px;
            }

            .footer-meta {
                align-items: center;
            }
        }

        @media (max-width: 480px) {
            .system-info {
                gap: 6px;
            }

            .info-item {
                font-size: 0.75rem;
            }
        }

        /* Collapsed sidebar footer adjustment */
        body.sidebar-collapsed .modern-footer {
            margin-left: 70px;
            width: calc(100% - 70px);
        }

        @media (max-width: 768px) {
            footer {
                margin-left: 0;
            }
        }
    </style>
    
    <!-- Additional page-specific styles -->
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <!-- Modern Navbar - Hidden for full sidebar experience -->
    <nav class="navbar" style="display: none;">
        <button class="mobile-menu-toggle" id="mobile-menu-toggle">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand" href="#">SIMPAD</a>
        <div class="user-info">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle me-2"></i>
                    <?php echo e(Auth::user()?->name ?? 'User'); ?>

                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <!-- Modern Responsive Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="<?php echo e(asset('assets/img/logo-header.png')); ?>" alt="Logo Bapenda" class="sidebar-logo">
        </div>
        
        <div class="sidebar-nav">
            <?php if(Auth::user()): ?>
                <?php
                    $role = Auth::user()->role->name ?? '';
                ?>

                <?php if($role === 'psi'): ?>
                    <a href="<?php echo e(url('/dashboard')); ?>" class="<?php echo e(request()->is('dashboard') ? 'active' : ''); ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Executive Summary</span>
                    </a>
                    
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-plus"></i>
                            <span>Pendaftaran</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo e(url('/subjek_pajak')); ?>">
                                <i class="fas fa-user me-2"></i>Subjek Pajak
                            </a>
                            <a class="dropdown-item" href="<?php echo e(url('/objek_pajak')); ?>">
                                <i class="fas fa-building me-2"></i>Objek Pajak
                            </a>
                        </div>
                    </div>
                    
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-database"></i>
                            <span>Pendataan</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo e(url('/sptpd')); ?>">
                                <i class="fas fa-file-invoice me-2"></i>SPTPD
                            </a>
                        </div>
                    </div>
                    

                    <a href="<?php echo e(url('/kecamatan')); ?>" class="<?php echo e(request()->is('kecamatan') ? 'active' : ''); ?>">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Kecamatan</span>
                    </a>
                    <a href="<?php echo e(url('/upt')); ?>" class="<?php echo e(request()->is('upt') ? 'active' : ''); ?>">
                        <i class="fas fa-building"></i>
                        <span>UPT</span>
                    </a>
                    
                <?php elseif($role === 'upt'): ?>
                    <a href="<?php echo e(url('/dashboard')); ?>" class="<?php echo e(request()->is('dashboard') ? 'active' : ''); ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Executive Summary</span>
                    </a>
                    
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-plus"></i>
                            <span>Pendaftaran</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo e(url('/subjek_pajak')); ?>">
                                <i class="fas fa-user me-2"></i>Subjek Pajak
                            </a>
                            <a class="dropdown-item" href="<?php echo e(url('/objek_pajak')); ?>">
                                <i class="fas fa-building me-2"></i>Objek Pajak
                            </a>
                        </div>
                    </div>
                    
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-database"></i>
                            <span>Pendataan</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo e(url('/sptpd')); ?>">
                                <i class="fas fa-file-invoice me-2"></i>SPTPD
                            </a>
                        </div>
                    </div>
                    

                    <a href="<?php echo e(url('/kecamatan')); ?>" class="<?php echo e(request()->is('kecamatan') ? 'active' : ''); ?>">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Kecamatan</span>
                    </a>
                    <a href="<?php echo e(url('/upt')); ?>" class="<?php echo e(request()->is('upt') ? 'active' : ''); ?>">
                        <i class="fas fa-building"></i>
                        <span>UPT</span>
                    </a>
                    
                <?php elseif($role === 'pegawai'): ?>
                    <a href="<?php echo e(url('/dashboard')); ?>" class="<?php echo e(request()->is('dashboard') ? 'active' : ''); ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Executive Summary</span>
                    </a>
                    
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-plus"></i>
                            <span>Pendaftaran</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo e(url('/subjek_pajak')); ?>">
                                <i class="fas fa-user me-2"></i>Subjek Pajak
                            </a>
                        </div>
                    </div>
                    
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-database"></i>
                            <span>Pendataan</span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo e(url('/sptpd')); ?>">
                                <i class="fas fa-file-invoice me-2"></i>SPTPD
                            </a>
                        </div>
                    </div>
                    
                <?php elseif($role === 'wp'): ?>
                    <a href="<?php echo e(route('wp.dashboard')); ?>" class="<?php echo e(request()->routeIs('wp.dashboard') ? 'active' : ''); ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Executive Summary</span>
                    </a>
                    <a href="<?php echo e(route('wp.sptpd')); ?>" class="<?php echo e(request()->routeIs('wp.sptpd') ? 'active' : ''); ?>">
                        <i class="fas fa-file-invoice"></i>
                        <span>SPTPD Saya</span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Compact Footer -->
    <footer class="modern-footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-left">
                    <div class="footer-brand">
                        <img src="<?php echo e(asset('assets/img/logo-header.png')); ?>" alt="Logo SIMPAD" class="footer-logo-small">
                        <div class="brand-info">
                            <span class="brand-name">SIMPAD</span>
                            <span class="brand-desc">Sistem Informasi Manajemen Pajak Daerah</span>
                        </div>
                    </div>
                </div>
                
                <div class="footer-right">
                    <div class="footer-meta">
                        <span class="copyright">&copy; <?php echo e(date('Y')); ?> <?php echo e(config('app.name', 'SIMPAD Kabupaten Bogor')); ?></span>
                        <div class="version-info">
                            <span class="version">Version 2.0.1</span>
                            <span class="build">Build <?php echo e(date('Y.m.d')); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Responsive Sidebar Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            // Toggle desktop sidebar (dari dashboard - sidebarToggle)
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
            
            // Toggle desktop sidebar (dari sidebar header - sidebarCollapseBtn)
            if (sidebarCollapseBtn && sidebar) {
                sidebarCollapseBtn.addEventListener('click', function() {
                    // Toggle sidebar visibility
                    sidebar.classList.toggle('collapsed');
                    
                    // Add/remove class to body for main content adjustment
                    document.body.classList.toggle('sidebar-collapsed');
                    
                    // Update button icon
                    const icon = sidebarCollapseBtn.querySelector('i');
                    if (sidebar.classList.contains('collapsed')) {
                        icon.className = 'fas fa-indent';
                    } else {
                        icon.className = 'fas fa-bars';
                    }
                });
            }

            // Toggle mobile menu
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');
                });
            }

            // Close sidebar when overlay is clicked
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                });
            }

            // Close sidebar when link is clicked on mobile
            const sidebarLinks = sidebar.querySelectorAll('a:not(.dropdown-toggle)');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        sidebar.classList.remove('show');
                        sidebarOverlay.classList.remove('show');
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                }
            });

            // Initialize Bootstrap dropdowns in sidebar
            const dropdownElements = sidebar.querySelectorAll('.dropdown-toggle');
            dropdownElements.forEach(element => {
                new bootstrap.Dropdown(element);
            });

            // Smooth scrolling for sidebar
            sidebar.addEventListener('scroll', function() {
                // Add any scroll-based effects here if needed
            });
        });
    </script>
    
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH E:\Project\simpad\resources\views/layouts/app.blade.php ENDPATH**/ ?>