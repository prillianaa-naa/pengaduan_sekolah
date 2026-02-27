<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pengaduan Sarana Sekolah')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #E8ECF5 0%, #F0F4F8 100%);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(99, 115, 255, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .nav-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 18px;
            font-weight: 700;
            color: #1E293B;
            text-decoration: none;
        }
        
        .nav-logo-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(99, 115, 255, 0.3);
        }
        
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 24px;
        }
        
        .nav-link {
            color: #64748B;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.3s;
            padding: 8px 12px;
            border-radius: 8px;
        }
        
        .nav-link:hover, .nav-link.active {
            color: #6366F1;
            background: rgba(99, 115, 255, 0.1);
        }
        
        .nav-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: #F8FAFC;
            border-radius: 14px;
            border: 1px solid #E2E8F0;
        }
        
        .nav-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(99, 115, 255, 0.3);
        }
        
        .nav-user-info {
            display: flex;
            flex-direction: column;
        }
        
        .nav-user-name {
            font-size: 14px;
            font-weight: 600;
            color: #1E293B;
        }
        
        .nav-user-role {
            font-size: 12px;
            color: #64748B;
        }

        /* Main Content */
        .main-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 32px 32px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                gap: 16px;
            }
            
            .nav-user-info {
                display: none;
            }
            
            .nav-container {
                padding: 12px 20px;
            }
            
            .main-content {
                padding: 20px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('siswa.home') }}" class="nav-logo">
                <div class="nav-logo-icon">
                    <i class="fas fa-school"></i>
                </div>
                <span>Pengaduan Sekolah</span>
            </a>
            
            <div class="nav-menu">
                <a href="{{ route('siswa.home') }}" class="nav-link {{ request()->routeIs('siswa.home') ? 'active' : '' }}">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
                @auth('siswa')
                    <a href="{{ route('siswa.dashboard') }}" class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('siswa.aspirasi.create') }}" class="nav-link {{ request()->routeIs('siswa.aspirasi.create') ? 'active' : '' }}">
                        <i class="fas fa-plus-circle mr-2"></i>Buat Pengaduan
                    </a>
                    <div class="nav-user">
                        <div class="nav-avatar">
                            {{ substr(auth()->guard('siswa')->user()->nama, 0, 1) }}
                        </div>
                        <div class="nav-user-info">
                            <span class="nav-user-name">{{ auth()->guard('siswa')->user()->nama }}</span>
                            <span class="nav-user-role">{{ auth()->guard('siswa')->user()->kelas }}</span>
                        </div>
                        <form action="{{ route('siswa.logout') }}" method="POST" class="ml-2">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('siswa.login') }}" class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>