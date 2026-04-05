@extends('siswa.layouts.app')

@section('title', 'Beranda - Pengaduan Sarana Sekolah')

<<<<<<< HEAD
@push('styles')
<style>
/* ===== WARNA SOLID - NO GRADIENT ===== */
:root {
    --primary: #A87B6E;
    --primary-dark: #8B6F5E;
    --primary-light: #C4A896;
    --accent: #3B82F6;
    --success: #10B981;
    --warning: #F59E0B;
    --danger: #DC2626;
    --bg-light: #F9F7F5;
    --bg-card: #FFFFFF;
    --border: #E8DDD5;
    --text: #5D4E45;
    --text-muted: #8B7355;
    --text-light: #FFFFFF;
}

/* ===== Reset & Base ===== */
* { box-sizing: border-box; }
body { font-family: 'Segoe UI', system-ui, sans-serif; color: var(--text); line-height: 1.6; }

/* ===== HERO SECTION ===== */
.hero {
    background-image: url('/images/msb-lapangan.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: var(--text-light);
    padding: 8rem 1.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
    min-height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.hero-overlay {
    position: absolute;
    inset: 0;
    background: rgba(93, 78, 69, 0.75); /* Warna coklat transparan */
    /* Atau pakai gradient: */
    /* background: linear-gradient(135deg, rgba(168, 123, 110, 0.85) 0%, rgba(93, 78, 69, 0.9) 100%); */
    z-index: 0;
}
.hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 30% 20%, rgba(255,255,255,0.1) 0%, transparent 50%);
    pointer-events: none;
}
.hero-content {
    position: relative;
    z-index: 1;
    max-width: 48rem;
    margin: 0 auto;
}
.hero-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    line-height: 1.2;
}
/* Responsive untuk mobile */
@media (max-width: 768px) {
    .hero {
        padding: 6rem 1rem;
        min-height: 400px;
        background-position: center 30%; /* Fokus ke bagian atas foto */
    }
}
.hero-subtitle {
    font-size: 1.125rem;
    opacity: 0.95;
    margin-bottom: 2rem;
}
.hero-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}
.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 2rem;
    border-radius: 0.75rem;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
}
.btn-light {
    background: var(--text-light);
    color: var(--primary);
}
.btn-light:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
.btn-outline {
    background: transparent;
    color: var(--text-light);
    border: 2px solid var(--text-light);
}
.btn-outline:hover {
    background: var(--text-light);
    color: var(--primary);
}

/* ===== STATS BAR ===== */
.stats-bar {
    background: var(--bg-card);
    border-bottom: 1px solid var(--border);
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
}
.stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: var(--text-muted);
}
.stat-item strong {
    color: var(--primary);
    font-weight: 700;
}

/* ===== SECTION BASE ===== */
.section {
    padding: 4rem 1.5rem;
}
.section.bg-light { background: var(--bg-light); }
.section-title {
    text-align: center;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 3rem;
    position: relative;
}
.section-title::after {
    content: '';
    display: block;
    width: 4rem;
    height: 3px;
    background: var(--primary);
    margin: 1rem auto 0;
    border-radius: 2px;
}

/* ===== CARA KERJA ===== */
.steps-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    max-width: 72rem;
    margin: 0 auto;
}
.step-card {
    background: var(--bg-card);
    border-radius: 1rem;
    padding: 2rem;
    text-align: center;
    box-shadow: 0 2px 12px rgba(0,0,0,0.06);
    border: 1px solid var(--border);
    transition: transform 0.2s, box-shadow 0.2s;
}
.step-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
}
.step-number {
    width: 3rem;
    height: 3rem;
    background: var(--primary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.25rem;
    margin: 0 auto 1rem;
}
.step-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 0.75rem;
}
.step-desc {
    color: var(--text-muted);
    font-size: 0.95rem;
}

/* ===== KATEGORI ===== */
.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1.5rem;
    max-width: 72rem;
    margin: 0 auto;
}
.category-card {
    background: var(--bg-card);
    border-radius: 1rem;
    padding: 1.5rem;
    text-align: center;
    border: 2px solid var(--border);
    transition: all 0.2s;
    cursor: pointer;
}
.category-card:hover {
    border-color: var(--primary);
    background: var(--bg-light);
}
.category-icon {
    width: 3.5rem;
    height: 3.5rem;
    background: var(--bg-light);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    color: var(--primary);
    font-size: 1.5rem;
}
.category-name {
    font-weight: 600;
    color: var(--text);
}

/* ===== KEUNGGULAN ===== */
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
    max-width: 72rem;
    margin: 0 auto;
}
.feature-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem;
    background: var(--bg-card);
    border-radius: 0.75rem;
    border: 1px solid var(--border);
}
.feature-icon {
    width: 2.5rem;
    height: 2.5rem;
    background: var(--primary-light);
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}
.feature-text h4 {
    font-weight: 600;
    color: var(--text);
    margin-bottom: 0.25rem;
}
.feature-text p {
    font-size: 0.9rem;
    color: var(--text-muted);
}

/* ===== CTA SECTION ===== */
.cta-section {
    background: var(--primary);
    color: var(--text-light);
    text-align: center;
    padding: 3rem 1.5rem;
}
.cta-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}
.cta-desc {
    opacity: 0.95;
    margin-bottom: 1.5rem;
    max-width: 32rem;
    margin-left: auto;
    margin-right: auto;
}
.cta-btn {
    background: var(--text-light);
    color: var(--primary);
    padding: 0.875rem 2.5rem;
    border-radius: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: transform 0.2s;
}
.cta-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* ===== FOOTER ===== */
.footer {
    background: var(--text);
    color: var(--text-light);
    padding: 2rem 1.5rem;
    text-align: center;
}
.footer-logo {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}
.footer-links {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}
.footer-links a {
    color: rgba(255,255,255,0.85);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.2s;
}
.footer-links a:hover {
    color: white;
}
.footer-copyright {
    color: rgba(255,255,255,0.7);
    font-size: 0.875rem;
}

/* ===== ANIMATIONS ===== */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-in {
    animation: fadeInUp 0.5s ease forwards;
}
.animate-delay-1 { animation-delay: 0.1s; }
.animate-delay-2 { animation-delay: 0.2s; }
.animate-delay-3 { animation-delay: 0.3s; }

/* ===== RESPONSIVE ===== */
@media (max-width: 640px) {
    .hero { padding: 3rem 1rem; }
    .hero-title { font-size: 2rem; }
    .section { padding: 3rem 1rem; }
    .section-title { font-size: 1.5rem; }
    .stats-bar { gap: 1rem; font-size: 0.85rem; }
}
</style>
@endpush

@section('content')

{{-- HERO SECTION DENGAN FOTO SEKOLAH --}}
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title">Sistem Pengaduan Sarana Sekolah</h1>
        <p class="hero-subtitle">
            Laporkan kerusakan fasilitas sekolah dengan mudah, cepat, dan transparan. 
            Suara Anda penting untuk sekolah yang lebih baik!
        </p>
        <div class="hero-buttons">
            <a href="{{ route('siswa.login') }}" class="btn btn-light">
                <i class="fas fa-sign-in-alt"></i> Login Siswa
            </a>
            <a href="{{ route('siswa.register') }}" class="btn btn-outline">
                <i class="fas fa-user-plus"></i> Registrasi
            </a>
        </div>
    </div>
</section>

{{-- STATS BAR --}}
<div class="stats-bar">
    <div class="stat-item">
        <i class="fas fa-check-circle"></i>
        <strong>100+</strong> Laporan Selesai
    </div>
    <div class="stat-item">
        <i class="fas fa-clock"></i>
        <strong>24 Jam</strong> Respon Cepat
    </div>
    <div class="stat-item">
        <i class="fas fa-shield-alt"></i>
        <strong>100%</strong> Aman & Rahasia
    </div>
</div>

{{-- CARA KERJA --}}
<section class="section bg-light">
    <h2 class="section-title">Cara Kerja</h2>
    <div class="steps-grid">
        <div class="step-card animate-in">
            <div class="step-number">1</div>
            <h3 class="step-title">Buat Pengaduan</h3>
            <p class="step-desc">Login dan isi form laporan kerusakan fasilitas dengan detail dan foto bukti</p>
        </div>
        <div class="step-card animate-in animate-delay-1">
            <div class="step-number">2</div>
            <h3 class="step-title">Diproses Admin</h3>
            <p class="step-desc">Tim admin memverifikasi dan menindaklanjuti laporan Anda secara profesional</p>
        </div>
        <div class="step-card animate-in animate-delay-2">
            <div class="step-number">3</div>
            <h3 class="step-title">Pantau Status</h3>
            <p class="step-desc">Pantau progres perbaikan secara real-time melalui dashboard pribadi</p>
        </div>
    </div>
</section>

{{-- KATEGORI PENGADUAN --}}
<section class="section">
    <h2 class="section-title">Kategori Pengaduan</h2>
    <div class="categories-grid">
        <div class="category-card">
            <div class="category-icon"><i class="fas fa-chalkboard"></i></div>
            <div class="category-name">Ruang Kelas</div>
        </div>
        <div class="category-card">
            <div class="category-icon"><i class="fas fa-restroom"></i></div>
            <div class="category-name">Toilet & MCK</div>
        </div>
        <div class="category-card">
            <div class="category-icon"><i class="fas fa-bolt"></i></div>
            <div class="category-name">Listrik & AC</div>
        </div>
        <div class="category-card">
            <div class="category-icon"><i class="fas fa-tint"></i></div>
            <div class="category-name">Air & Plumbing</div>
        </div>
        <div class="category-card">
            <div class="category-icon"><i class="fas fa-tree"></i></div>
            <div class="category-name">Lingkungan</div>
        </div>
        <div class="category-card">
            <div class="category-icon"><i class="fas fa-door-open"></i></div>
            <div class="category-name">Pintu & Jendela</div>
        </div>
        <div class="category-card">
            <div class="category-icon"><i class="fas fa-wifi"></i></div>
            <div class="category-name">Internet & IT</div>
        </div>
        <div class="category-card">
            <div class="category-icon"><i class="fas fa-ellipsis-h"></i></div>
            <div class="category-name">Lainnya</div>
        </div>
    </div>
</section>

{{-- KEUNGGULAN SISTEM --}}
<section class="section bg-light">
    <h2 class="section-title">Keunggulan Sistem</h2>
    <div class="features-grid">
        <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-bolt"></i></div>
            <div class="feature-text">
                <h4>Cepat & Mudah</h4>
                <p>Lapor dalam 3 menit via HP atau laptop</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-lock"></i></div>
            <div class="feature-text">
                <h4>Data Aman</h4>
                <p>Identitas siswa terlindungi dan rahasia</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-sync-alt"></i></div>
            <div class="feature-text">
                <h4>Update Real-time</h4>
                <p>Pantau status laporan kapan saja</p>
            </div>
        </div>
        <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
            <div class="feature-text">
                <h4>Transparan</h4>
                <p>Proses perbaikan dapat dipantau oleh semua</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="cta-section">
    <h3 class="cta-title">Siap Melaporkan Kerusakan?</h3>
    <p class="cta-desc">
        Bergabunglah dengan ratusan siswa yang telah membantu memperbaiki fasilitas sekolah melalui sistem ini.
    </p>
    <a href="{{ route('siswa.register') }}" class="cta-btn">
        <i class="fas fa-rocket"></i> Mulai Sekarang
    </a>
</section>

{{-- FOOTER --}}
<footer class="footer">
    <div class="footer-logo">
        <i class="fas fa-school"></i>
        <span>Pengaduan Sekolah</span>
    </div>
    <div class="footer-links">
        <a href="#">Tentang</a>
        <a href="#">Panduan</a>
        <a href="#">Kontak Admin</a>
        <a href="#">Privasi</a>
    </div>
    <p class="footer-copyright">
        © {{ date('Y') }} Sistem Pengaduan Sarana Sekolah. All rights reserved.
    </p>
</footer>

@endsection

@push('scripts')
<script>
// Simple scroll animation on load
document.addEventListener('DOMContentLoaded', function() {
    const animateItems = document.querySelectorAll('.animate-in');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    animateItems.forEach(item => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(item);
    });
});
</script>
@endpush
=======
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
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
