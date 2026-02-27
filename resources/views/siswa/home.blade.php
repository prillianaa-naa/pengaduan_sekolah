@extends('siswa.layouts.app')

@section('title', 'Beranda - Pengaduan Sarana Sekolah')

@section('content')
<!-- Hero Section -->
<div class="relative bg-white rounded-3xl p-12 mb-8 overflow-hidden shadow-sm border border-indigo-100">
    <!-- Background Decorations -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full -mr-32 -mt-32 opacity-60"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-blue-100 to-cyan-100 rounded-full -ml-24 -mb-24 opacity-60"></div>
    
    <div class="relative z-10 grid md:grid-cols-2 gap-10 items-center">
        <div>
            <!-- Title -->
            <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-5 leading-tight">
                Sampaikan Aspirasi &<br>
                <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Pengaduan Sarana Sekolah</span>
            </h1>
            
            <!-- Subtitle -->
            <p class="text-slate-600 text-lg mb-8 leading-relaxed">
                Platform digital untuk menyampaikan pengaduan terkait sarana dan prasarana sekolah dengan mudah, cepat, dan terpercaya
            </p>
            
            <!-- Buttons -->
            <div class="flex gap-4 flex-wrap">
                @guest('siswa')
                    <a href="{{ route('siswa.login') }}" class="group inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-xl font-semibold hover:shadow-xl hover:-translate-y-1 transition-all">
                        <i class="fas fa-sign-in-alt group-hover:translate-x-1 transition-transform"></i>
                        Login Sekarang
                    </a>
                    <a href="{{ route('siswa.register') }}" class="inline-flex items-center gap-2 bg-white text-slate-700 px-8 py-4 rounded-xl font-semibold hover:bg-slate-50 transition-all border-2 border-slate-200 hover:border-indigo-300">
                        <i class="fas fa-user-plus"></i>
                        Daftar Akun
                    </a>
                @else
                    <a href="{{ route('siswa.aspirasi.create') }}" class="group inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-xl font-semibold hover:shadow-xl hover:-translate-y-1 transition-all">
                        <i class="fas fa-plus-circle group-hover:rotate-90 transition-transform"></i>
                        Buat Pengaduan
                    </a>
                    <a href="{{ route('siswa.dashboard') }}" class="inline-flex items-center gap-2 bg-white text-slate-700 px-8 py-4 rounded-xl font-semibold hover:bg-slate-50 transition-all border-2 border-slate-200 hover:border-indigo-300">
                        <i class="fas fa-chart-line"></i>
                        Lihat Dashboard
                    </a>
                @endguest
            </div>
            
            <!-- Trust Indicators -->
            <div class="flex items-center gap-6 mt-10 pt-6 border-t border-slate-200">
                <div class="flex items-center gap-2 text-sm text-slate-600">
                    <i class="fas fa-check-circle text-emerald-500"></i>
                    <span>Aman & Terpercaya</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-slate-600">
                    <i class="fas fa-bolt text-yellow-500"></i>
                    <span>Respon Cepat</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-slate-600">
                    <i class="fas fa-shield-alt text-indigo-500"></i>
                    <span>Data Terlindungi</span>
                </div>
            </div>
        </div>
        
        <!-- Illustration -->
        <div class="relative flex justify-center items-center">
            <div class="relative w-80 h-80">
                <!-- Floating Elements -->
                <div class="absolute top-0 right-0 w-20 h-20 bg-yellow-300 rounded-2xl rotate-12 opacity-60 animate-bounce" style="animation-duration: 3s;"></div>
                <div class="absolute bottom-10 left-0 w-16 h-16 bg-pink-300 rounded-full opacity-60 animate-pulse"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-br from-indigo-200 to-purple-200 rounded-full opacity-40 blur-2xl"></div>
                
                <!-- Main Icon -->
                <div class="relative w-48 h-48 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl flex items-center justify-center text-white text-7xl shadow-2xl transform hover:scale-105 transition-transform duration-300">
                    <i class="fas fa-school"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Grid -->
<div class="grid md:grid-cols-3 gap-6 mb-8">
    <!-- Feature 1 -->
    <div class="group bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-indigo-300 hover:-translate-y-2">
        <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-orange-400 rounded-2xl flex items-center justify-center text-white text-2xl mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg">
            <i class="fas fa-bolt"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-3">Cepat & Mudah</h3>
        <p class="text-slate-600 leading-relaxed">Ajukan pengaduan hanya dalam beberapa klik dan dapatkan respon cepat dari pihak sekolah</p>
    </div>
    
    <!-- Feature 2 -->
    <div class="group bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-indigo-300 hover:-translate-y-2">
        <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-rose-400 rounded-2xl flex items-center justify-center text-white text-2xl mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg">
            <i class="fas fa-shield-alt"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-3">Aman & Terpercaya</h3>
        <p class="text-slate-600 leading-relaxed">Data Anda terlindungi dengan enkripsi dan setiap pengaduan akan ditindaklanjuti dengan serius</p>
    </div>
    
    <!-- Feature 3 -->
    <div class="group bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-indigo-300 hover:-translate-y-2">
        <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-teal-400 rounded-2xl flex items-center justify-center text-white text-2xl mb-6 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300 shadow-lg">
            <i class="fas fa-chart-line"></i>
        </div>
        <h3 class="text-xl font-bold text-slate-800 mb-3">Pantau Progress</h3>
        <p class="text-slate-600 leading-relaxed">Lacak status pengaduan Anda secara real-time dari pengajuan hingga selesai ditangani</p>
    </div>
</div>

<!-- How It Works -->
<div class="bg-white rounded-3xl p-10 shadow-sm border border-slate-200">
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-slate-800 mb-3">Cara Menggunakan</h2>
        <p class="text-slate-600">Ikuti 4 langkah mudah ini untuk menyampaikan pengaduan Anda</p>
    </div>
    
    <div class="grid md:grid-cols-4 gap-6">
        <!-- Step 1 -->
        <div class="text-center relative group">
            <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-5 shadow-lg group-hover:scale-110 transition-transform duration-300">
                1
            </div>
            <h3 class="font-bold text-slate-800 mb-2 text-lg">Login / Daftar</h3>
            <p class="text-slate-600 text-sm leading-relaxed">Masuk dengan akun siswa atau daftar jika belum memiliki akun</p>
        </div>
        
        <!-- Step 2 -->
        <div class="text-center relative group">
            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-cyan-500 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-5 shadow-lg group-hover:scale-110 transition-transform duration-300">
                2
            </div>
            <h3 class="font-bold text-slate-800 mb-2 text-lg">Buat Pengaduan</h3>
            <p class="text-slate-600 text-sm leading-relaxed">Pilih kategori, lokasi, dan jelaskan detail pengaduan Anda</p>
        </div>
        
        <!-- Step 3 -->
        <div class="text-center relative group">
            <div class="w-20 h-20 bg-gradient-to-br from-emerald-500 to-teal-500 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-5 shadow-lg group-hover:scale-110 transition-transform duration-300">
                3
            </div>
            <h3 class="font-bold text-slate-800 mb-2 text-lg">Pantau Status</h3>
            <p class="text-slate-600 text-sm leading-relaxed">Ikuti perkembangan pengaduan Anda hingga selesai ditangani</p>
        </div>
        
        <!-- Step 4 -->
        <div class="text-center group">
            <div class="w-20 h-20 bg-gradient-to-br from-pink-500 to-rose-500 text-white rounded-2xl flex items-center justify-center text-2xl font-bold mx-auto mb-5 shadow-lg group-hover:scale-110 transition-transform duration-300">
                <i class="fas fa-check"></i>
            </div>
            <h3 class="font-bold text-slate-800 mb-2 text-lg">Selesai</h3>
            <p class="text-slate-600 text-sm leading-relaxed">Pengaduan ditindaklanjuti dan sarana diperbaiki</p>
        </div>
    </div>
</div>
@endsection