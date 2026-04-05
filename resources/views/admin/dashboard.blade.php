@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@push('styles')
<style>
/* ===== Dashboard Specific Styles ===== */
/* Scoped dengan prefix .dashboard- agar tidak konflik dengan layout */

    /* Header */
    .dashboard-header {
        background: #F5F0EB;
        border-radius: 16px;
        padding: 16px 24px;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .dashboard-header-title {
        font-size: 20px;
        font-weight: 600;
        color: #5D4E45;
    }
    .dashboard-header-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .dashboard-search-box {
        position: relative;
    }
    .dashboard-search-box input {
        width: 250px;
        padding: 10px 16px 10px 40px;
        border: 1px solid #D4C4B7;
        border-radius: 20px;
        background: white;
        font-size: 14px;
    }
    .dashboard-search-box input:focus {
        outline: none;
        border-color: #A87B6E;
    }
    .dashboard-search-box i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #A87B6E;
    }
    .dashboard-user-profile {
        display: flex;
        align-items: center;
        gap: 10px;
        background: white;
        padding: 8px 16px;
        border-radius: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .dashboard-user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 14px;
    }
    .dashboard-user-info {
        display: flex;
        flex-direction: column;
    }
    .dashboard-user-name {
        font-size: 14px;
        font-weight: 600;
        color: #5D4E45;
    }
    .dashboard-user-role {
        font-size: 12px;
        color: #A87B6E;
    }

    /* Welcome Card */
    .dashboard-welcome-card {
        background: linear-gradient(135deg, #F5F0EB 0%, #E8DDD5 100%);
        border-radius: 20px;
        padding: 40px;
        min-height: 280px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(168, 123, 110, 0.15);
        margin-bottom: 24px;
    }
    .dashboard-welcome-content {
        position: relative;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .dashboard-welcome-text h2 {
        font-size: 28px;
        font-weight: 700;
        color: #5D4E45;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .dashboard-welcome-text p {
        color: #8B7355;
    }
    .dashboard-welcome-icon {
        position: relative;
        width: 120px;
        height: 120px;
    }
    .dashboard-icon-circle {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
        color: white;
        position: relative;
        z-index: 2;
        box-shadow: 0 8px 24px rgba(251, 191, 36, 0.4);
        animation: dashboard-bounce 2s infinite;
    }
    .dashboard-pulse-ring {
        position: absolute;
        inset: 0;
        border-radius: 50%;
        border: 3px solid #FBBF24;
        animation: dashboard-pulse 2s infinite;
    }
    @keyframes dashboard-bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    @keyframes dashboard-pulse {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(1.5); opacity: 0; }
    }

    /* Floating Shapes */
    .dashboard-floating-shape {
        position: absolute;
        border-radius: 50%;
        opacity: 0.1;
        animation: dashboard-float 20s infinite ease-in-out;
    }
    .dashboard-shape-1 {
        width: 200px; height: 200px;
        background: linear-gradient(135deg, #FBBF24, #F59E0B);
        top: -50px; right: -50px;
        animation-delay: 0s;
    }
    .dashboard-shape-2 {
        width: 150px; height: 150px;
        background: linear-gradient(135deg, #A87B6E, #8B6F5E);
        bottom: 80px; left: -30px;
        animation-delay: 3s;
    }
    .dashboard-shape-3 {
        width: 100px; height: 100px;
        background: linear-gradient(135deg, #3B82F6, #2563EB);
        top: 50%; right: 20%;
        animation-delay: 6s;
    }
    @keyframes dashboard-float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        25% { transform: translateY(-20px) rotate(90deg); }
        50% { transform: translateY(0) rotate(180deg); }
        75% { transform: translateY(20px) rotate(270deg); }
    }

    /* Quick Access Section */
    .dashboard-section-title {
        font-size: 18px;
        font-weight: 600;
        color: #5D4E45;
        margin-bottom: 16px;
    }
    .dashboard-cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    .dashboard-stat-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: all 0.3s;
        cursor: pointer;
    }
    .dashboard-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(168, 123, 110, 0.15);
    }
    .dashboard-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
        margin-bottom: 12px;
    }
    .dashboard-stat-icon.gold { background: linear-gradient(135deg, #FBBF24, #F59E0B); }
    .dashboard-stat-icon.green { background: linear-gradient(135deg, #10B981, #059669); }
    .dashboard-stat-icon.blue { background: linear-gradient(135deg, #3B82F6, #2563EB); }
    .dashboard-stat-label {
        font-size: 13px;
        color: #5D4E45;
        margin-bottom: 4px;
    }
    .dashboard-stat-value {
        font-size: 20px;
        font-weight: 700;
        color: #A87B6E;
    }

    /* Notifications Section */
    .dashboard-notifications-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
    .dashboard-notifications-title {
        font-size: 18px;
        font-weight: 600;
        color: #5D4E45;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .dashboard-notifications-title i { color: #A87B6E; }
    .dashboard-see-all {
        font-size: 13px;
        color: #A87B6E;
        text-decoration: none;
        cursor: pointer;
    }
    .dashboard-see-all:hover { text-decoration: underline; }
    .dashboard-notifications-list {
        background: white;
        border-radius: 16px;
        padding: 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .dashboard-notification-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background: #F5F0EB;
        border-radius: 12px;
        margin-bottom: 8px;
        cursor: pointer;
        transition: all 0.3s;
    }
    .dashboard-notification-item:hover {
        background: #E8DDD5;
        transform: translateX(4px);
    }
    .dashboard-notification-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #FBBF24, #F59E0B);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
        flex-shrink: 0;
    }
    .dashboard-notification-content {
        flex: 1;
        min-width: 0;
    }
    .dashboard-notification-title {
        font-size: 14px;
        font-weight: 600;
        color: #5D4E45;
        margin-bottom: 2px;
    }
    .dashboard-notification-text {
        font-size: 12px;
        color: #8B7355;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .dashboard-notification-arrow {
        color: #A87B6E;
        font-size: 12px;
    }

    /* Wave Animation */
    .dashboard-hand-wave {
        animation: dashboard-wave 2.5s infinite;
        display: inline-block;
    }
    @keyframes dashboard-wave {
        0%, 100% { transform: rotate(0deg); }
        10%, 30% { transform: rotate(-10deg); }
        20%, 40% { transform: rotate(10deg); }
        50% { transform: rotate(0deg); }
    }

/* Responsive *
    
    /* Tablet (1024px) */
    @media (max-width: 1024px) {
        .dashboard-cards-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .dashboard-search-box input {
            width: 180px;
        }
    }
    
    /* Mobile Landscape (768px) */
    @media (max-width: 768px) {
        /* Header adjustments */
        .dashboard-header {
            flex-direction: column;
            gap: 16px;
            padding: 16px;
        }
        
        .dashboard-header-right {
            width: 100%;
            justify-content: space-between;
        }
        
        .dashboard-search-box {
            flex: 1;
            max-width: 200px;
        }
        
        .dashboard-search-box input {
            width: 100%;
            font-size: 13px;
            padding: 8px 12px 8px 36px;
        }
        
        .dashboard-user-info {
            display: none;
        }
        
        .dashboard-user-profile {
            padding: 6px 12px;
        }
        
        .dashboard-user-avatar {
            width: 28px;
            height: 28px;
            font-size: 12px;
        }
        
        /* Welcome card */
        .dashboard-welcome-card {
            padding: 24px 20px;
            min-height: auto;
        }
        
        .dashboard-welcome-content {
            flex-direction: column;
            text-align: center;
            gap: 24px;
        }
        
        .dashboard-welcome-text h2 {
            font-size: 22px;
            justify-content: center;
        }
        
        .dashboard-welcome-icon {
            width: 100px;
            height: 100px;
        }
        
        .dashboard-icon-circle {
            width: 80px;
            height: 80px;
            font-size: 32px;
        }
        
        /* Cards grid */
        .dashboard-cards-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        
        .dashboard-stat-card {
            padding: 16px;
        }
        
        /* Notifications */
        .dashboard-notifications-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
        
        .dashboard-notification-item {
            padding: 10px;
        }
        
        .dashboard-notification-icon {
            width: 36px;
            height: 36px;
            font-size: 14px;
        }
        
        .dashboard-notification-title {
            font-size: 13px;
        }
        
        .dashboard-notification-text {
            font-size: 11px;
        }
    }
    
    /* Mobile Portrait (480px) */
    @media (max-width: 480px) {
        /* Hide search on small mobile */
        .dashboard-search-box {
            display: none;
        }
        
        .dashboard-header-right {
            justify-content: flex-end;
        }
        
        .dashboard-welcome-card {
            padding: 20px 16px;
        }
        
        .dashboard-welcome-text h2 {
            font-size: 18px;
        }
        
        .dashboard-welcome-text p {
            font-size: 13px;
        }
        
        .dashboard-section-title {
            font-size: 16px;
        }
        
        .dashboard-stat-icon {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }
        
        .dashboard-stat-label {
            font-size: 12px;
        }
        
        .dashboard-stat-value {
            font-size: 18px;
        }
        
        .dashboard-notification-arrow {
            display: none;
        }
    }
    
    /* Very small screens (360px) */
    @media (max-width: 360px) {
        .dashboard-user-profile {
            padding: 4px 8px;
        }
        
        .dashboard-user-avatar {
            width: 24px;
            height: 24px;
            font-size: 10px;
        }
        
        .dashboard-welcome-text h2 {
            font-size: 16px;
        }
        
        .dashboard-icon-circle {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }
        
        .dashboard-stat-card {
            padding: 12px;
        }
    }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="dashboard-header">
    <h1 class="dashboard-header-title">Dashboard</h1>
    <div class="dashboard-header-right">
        <div class="dashboard-search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Search...">
        </div>
        <div class="dashboard-user-profile">
            <div class="dashboard-user-avatar">
                {{ substr(auth()->guard('admin')->user()->name, 0, 1) }}
            </div>
            <div class="dashboard-user-info">
                <span class="dashboard-user-name">{{ auth()->guard('admin')->user()->name }}</span>
                <span class="dashboard-user-role">Admin</span>
            </div>
        </div>
    </div>
</div>

<!-- Welcome Card dengan Animasi -->
<div class="dashboard-welcome-card">
    <!-- Background Animated Shapes -->
    <div class="absolute inset-0 overflow-hidden rounded-2xl">
        <div class="dashboard-floating-shape dashboard-shape-1"></div>
        <div class="dashboard-floating-shape dashboard-shape-2"></div>
        <div class="dashboard-floating-shape dashboard-shape-3"></div>
        
        <!-- Grid Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg width="100%" height="100%">
                <defs>
                    <pattern id="dashboard-grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="#A87B6E" stroke-width="1"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#dashboard-grid)" />
            </svg>
        </div>
    </div>

    <!-- Content -->
    <div class="dashboard-welcome-content">
        <div class="dashboard-welcome-text">
            <h2>
                <i class="fas fa-hand-wave dashboard-hand-wave text-[#F59E0B]"></i>
                Selamat Datang Admin
            </h2>
            <p class="text-lg">{{ auth()->guard('admin')->user()->name }}</p>
            <p class="text-sm mt-2">Panel Administrasi Pengaduan Sarana Sekolah</p>
        </div>
        
        <!-- Animated Icon -->
        <div class="dashboard-welcome-icon">
            <div class="dashboard-icon-circle">
                <i class="fas fa-school"></i>
            </div>
            <div class="dashboard-pulse-ring"></div>
        </div>
    </div>
</div>

<!-- Quick Access & Notifications Grid -->
<div class="grid grid-cols-3 gap-6">
    <!-- Quick Access (Left - 2 columns) -->
    <div class="col-span-2">
        <h3 class="dashboard-section-title">Quick Access</h3>
        
        <div class="dashboard-cards-grid">
            <!-- Card 1: Tiket Pengaduan -->
            <div class="dashboard-stat-card">
                <div class="dashboard-stat-icon gold">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <div class="dashboard-stat-label">Tiket order pengaduan sarana sekolah</div>
                <div class="dashboard-stat-value">{{ $totalAspirasi ?? 0 }} Pengaduan</div>
            </div>
            
            <!-- Card 2: Monitor Pengaduan -->
            <div class="dashboard-stat-card">
                <div class="dashboard-stat-icon green">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="dashboard-stat-label">Monitor Pengaduan Sarana Sekolah</div>
                <div class="dashboard-stat-value">{{ $selesai ?? 0 }} Selesai</div>
            </div>
            
            <!-- Card 3: User Manager -->
            <div class="dashboard-stat-card">
                <div class="dashboard-stat-icon blue">
                    <i class="fas fa-users"></i>
                </div>
                <div class="dashboard-stat-label">User manager pengaduan sarana sekolah</div>
                <div class="dashboard-stat-value">{{ $totalSiswa ?? 0 }} User</div>
            </div>
        </div>
    </div>

    <!-- Notifications (Right - 1 column) -->
    <div>
        <div class="dashboard-notifications-header">
            <h3 class="dashboard-notifications-title">
                <i class="fas fa-bell"></i>
                Notifications
            </h3>
            <a href="{{ route('admin.aspirasi.index') }}" class="dashboard-see-all">See all</a>
        </div>
        
        <div class="dashboard-notifications-list">
            @forelse($aspirasis ?? [] as $item)
            <div class="dashboard-notification-item" onclick="window.location.href='{{ route('admin.aspirasi.show', $item->id_pelaporan) }}'">
                <div class="dashboard-notification-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="dashboard-notification-content">
                    <div class="dashboard-notification-title">{{ $item->siswa->nama }}</div>
                    <div class="dashboard-notification-text">{{ Str::limit($item->ket, 30) }}</div>
                </div>
                <i class="fas fa-chevron-right dashboard-notification-arrow"></i>
            </div>
            @empty
            <div class="text-center py-8 text-[#8B7355]">
                <i class="fas fa-inbox text-3xl mb-2 opacity-50"></i>
                <p class="text-sm">Belum ada notifikasi</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection