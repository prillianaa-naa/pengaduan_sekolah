<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #E8DDD5;
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }
        
        /* Sidebar */
        .sidebar {
            width: 80px;
            background: linear-gradient(180deg, #A87B6E 0%, #8B6F5E 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 4px 0 12px rgba(0,0,0,0.1);
        }
        
        .sidebar.expanded {
            width: 260px;
        }
        
        /* Mobile Sidebar */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 260px;
                box-shadow: 4px 0 24px rgba(0,0,0,0.15);
            }
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
            }
        }
        
        .sidebar-content {
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 100%;
            padding: 20px 12px;
        }
        
        .sidebar-logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px 8px;
            margin-bottom: 32px;
            flex-shrink: 0;
        }
        
        .sidebar-logo {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .sidebar-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        .sidebar-brand {
            color: white;
            font-size: 18px;
            font-weight: 700;
            display: none;
            margin-left: 12px;
            white-space: nowrap;
        }
        
        .sidebar.expanded .sidebar-brand {
            display: block;
        }
        
        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
            justify-content: center;
            overflow-y: auto;
            padding-bottom: 16px;
        }
        
        .sidebar-item {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 14px 12px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
        }
        
        .sidebar-item:active {
            transform: scale(0.98);
        }
        
        .sidebar-item:hover {
            background: rgba(255,255,255,0.15);
            color: white;
        }
        
        .sidebar-item.active {
            background: rgba(255,255,255,0.25);
            color: white;
            font-weight: 600;
        }
        
        .sidebar-item i {
            font-size: 20px;
            width: 24px;
            text-align: center;
            flex-shrink: 0;
        }
        
        .sidebar-item span {
            display: none;
            font-size: 14px;
            white-space: nowrap;
        }
        
        .sidebar.expanded .sidebar-item {
            justify-content: flex-start;
        }
        
        .sidebar.expanded .sidebar-item span {
            display: block;
        }
        
        .sidebar-footer {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid rgba(255,255,255,0.15);
            flex-shrink: 0;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 80px;
            flex: 1;
            padding: 24px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: calc(100% - 80px);
        }
        
        .main-content.expanded {
            margin-left: 260px;
            width: calc(100% - 260px);
        }
        
        /* Mobile Toggle Button */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: 16px;
            left: 16px;
            z-index: 999;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(180deg, #A87B6E 0%, #8B6F5E 100%);
            color: white;
            border: none;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: all 0.2s ease;
        }
        
        .mobile-toggle:active {
            transform: scale(0.95);
        }
        
        @media (max-width: 768px) {
            .mobile-toggle {
                display: flex;
            }
            .main-content {
                padding: 72px 16px 24px;
                width: 100%;
            }
            .sidebar-menu {
                padding: 0 4px;
            }
        }
        
        /* Overlay for Mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.4);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .sidebar-overlay.visible {
            display: block;
            opacity: 1;
        }
        
        @media (max-width: 768px) {
            .sidebar-overlay.visible {
                display: block;
            }
        }
        
        /* Prevent scroll when sidebar open on mobile */
        body.sidebar-open {
            overflow: hidden;
        }
        
        /* Smooth scrolling for sidebar menu */
        .sidebar-menu::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-menu::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 4px;
        }
        
        /* Touch optimization */
        @media (hover: none) and (pointer: coarse) {
            .sidebar-item {
                min-height: 48px;
                padding: 16px 12px;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Mobile Toggle Button -->
    <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle menu">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-content">
            <!-- Logo -->
            <div class="sidebar-logo-wrapper">
                <div class="sidebar-logo">
                    <img src="{{ asset('images/lg_musaba.png') }}" alt="Logo">
                </div>
                <span class="sidebar-brand">Admin Panel</span>
            </div>
            
            <!-- Menu -->
            <nav class="sidebar-menu" role="navigation">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" role="menuitem">
                    <i class="fas fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.aspirasi.index') }}" class="sidebar-item {{ request()->routeIs('admin.aspirasi.*') ? 'active' : '' }}" role="menuitem">
                    <i class="fas fa-file-alt"></i>
                    <span>Daftar Pengaduan</span>
                </a>
                <a href="{{ route('admin.siswa.index') }}" class="sidebar-item {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}" role="menuitem">
                    <i class="fas fa-users"></i>
                    <span>Data Siswa</span>
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="sidebar-item {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" role="menuitem">
                    <i class="fas fa-tags"></i>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('admin.laporan.index') }}" class="sidebar-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}" role="menuitem">
                    <i class="fas fa-chart-bar"></i>
                    <span>Laporan</span>
                </a>
            </nav>
            
            <!-- Logout -->
            <div class="sidebar-footer">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-item" role="menuitem">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const mobileToggle = document.getElementById('mobileToggle');
            const overlay = document.getElementById('sidebarOverlay');
            const toggleIcon = mobileToggle.querySelector('i');
            
            // Check if mobile
            const isMobile = () => window.innerWidth <= 768;
            
            // Toggle sidebar
            function toggleSidebar() {
                if (isMobile()) {
                    // Mobile behavior
                    sidebar.classList.toggle('mobile-open');
                    overlay.classList.toggle('visible');
                    document.body.classList.toggle('sidebar-open');
                    
                    // Change icon
                    if (sidebar.classList.contains('mobile-open')) {
                        toggleIcon.classList.remove('fa-bars');
                        toggleIcon.classList.add('fa-times');
                    } else {
                        toggleIcon.classList.remove('fa-times');
                        toggleIcon.classList.add('fa-bars');
                    }
                } else {
                    // Desktop behavior
                    sidebar.classList.toggle('expanded');
                    mainContent.classList.toggle('expanded');
                }
            }
            
            // Close sidebar on mobile
            function closeMobileSidebar() {
                if (isMobile() && sidebar.classList.contains('mobile-open')) {
                    sidebar.classList.remove('mobile-open');
                    overlay.classList.remove('visible');
                    document.body.classList.remove('sidebar-open');
                    toggleIcon.classList.remove('fa-times');
                    toggleIcon.classList.add('fa-bars');
                }
            }
            
            // Event listeners
            mobileToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleSidebar();
            });
            
            overlay.addEventListener('click', closeMobileSidebar);
            
            // Close on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    closeMobileSidebar();
                }
            });
            
            // Close when clicking on menu item (mobile)
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.addEventListener('click', () => {
                    if (isMobile() && sidebar.classList.contains('mobile-open')) {
                        setTimeout(closeMobileSidebar, 150);
                    }
                });
            });
            
            // Handle resize
            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    if (!isMobile()) {
                        // Reset mobile states when switching to desktop
                        sidebar.classList.remove('mobile-open');
                        overlay.classList.remove('visible');
                        document.body.classList.remove('sidebar-open');
                        toggleIcon.classList.remove('fa-times');
                        toggleIcon.classList.add('fa-bars');
                    }
                }, 250);
            });
            
            // Prevent body scroll when sidebar is open on mobile
            const observer = new MutationObserver(() => {
                if (isMobile() && sidebar.classList.contains('mobile-open')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            });
            observer.observe(sidebar, { attributes: true, attributeFilter: ['class'] });
        });
    </script>
    
    @stack('scripts')
</body>
</html>