@extends('admin.layouts.app')

@section('title', 'Detail Pengaduan')

@push('styles')
<style>
/* ===== Page Header ===== */
.detail-header {
    margin-bottom: 1.5rem;
}
.detail-header h1 {
    font-size: 1.875rem;
    font-weight: 700;
    color: #5D4E45;
}
.back-link {
    color: #A87B6E;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s;
    font-weight: 500;
}
.back-link:hover {
    color: #8B6F5E;
    transform: translateX(-4px);
}

/* ===== Timeline - Horizontal Layout ===== */
.detail-section {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    margin-bottom: 1.5rem;
}
.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #5D4E45;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.section-title i {
    color: #A87B6E;
}

/* Timeline Container */
.status-timeline {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    position: relative;
    padding: 1rem 0;
}

/* Step */
.status-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    flex: 0 0 auto;
    min-width: 100px;
    position: relative;
    z-index: 2;
}

/* Dot */
.status-dot {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
    background: #E2E8F0;
    border: 3px solid white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}
.status-dot.active {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    transform: scale(1.05);
}

/* Label */
.status-label {
    font-size: 0.7rem;
    font-weight: 600;
    color: #94A3B8;
    text-align: center;
    transition: all 0.3s ease;
    max-width: 100px;
}
.status-label.active {
    color: #10B981;
}

/* Line between steps */
.status-line {
    flex: 1;
    height: 3px;
    background: #E2E8F0;
    margin: 0 0.5rem;
    transition: all 0.3s ease;
    position: relative;
    top: -0.5rem;
}
.status-line.active {
    background: linear-gradient(90deg, #10B981, #059669);
    box-shadow: 0 0 6px rgba(16, 185, 129, 0.3);
}

/* ===== Info Section ===== */
.info-section {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    margin-bottom: 1.5rem;
}
.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1rem;
}
.info-item label {
    display: block;
    font-size: 0.8rem;
    color: #8B7355;
    margin-bottom: 0.25rem;
    font-weight: 500;
}
.info-value {
    padding: 0.5rem 1rem;
    background: #F9F7F5;
    border-radius: 0.5rem;
    font-weight: 600;
    color: #5D4E45;
    font-size: 0.9rem;
}
.description-box {
    padding: 0.75rem 1rem;
    background: #F9F7F5;
    border-radius: 0.5rem;
    color: #5D4E45;
    line-height: 1.6;
    font-size: 0.9rem;
}
.photo-box img {
    max-width: 100%;
    max-height: 300px;
    border-radius: 0.75rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    object-fit: cover;
}

/* ===== Form Styles ===== */
.form-section {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    margin-bottom: 1.5rem;
}
.form-group {
    margin-bottom: 1rem;
}
.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: #5D4E45;
    margin-bottom: 0.5rem;
}
.form-select,
.form-textarea {
    width: 100%;
    padding: 0.6rem 1rem;
    border: 1.5px solid #D4C4B7;
    border-radius: 0.75rem;
    font-size: 0.875rem;
    transition: all 0.3s;
    background: white;
}
.form-select:focus,
.form-textarea:focus {
    outline: none;
    border-color: #A87B6E;
    box-shadow: 0 0 0 4px rgba(168, 123, 110, 0.1);
}
.form-textarea {
    resize: vertical;
    min-height: 100px;
}
.btn-submit {
    width: 100%;
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #A87B6E 0%, #8B6F5E 100%);
    color: white;
    border: none;
    border-radius: 0.75rem;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}
.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(168, 123, 110, 0.4);
}

/* ===== Student Info ===== */
.student-info {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.info-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}
.info-row label {
    display: block;
    font-size: 0.8rem;
    color: #8B7355;
    margin-bottom: 0.25rem;
}
.info-row .value {
    padding: 0.5rem 1rem;
    background: #F9F7F5;
    border-radius: 0.5rem;
    color: #5D4E45;
    font-weight: 500;
    font-size: 0.9rem;
}

/* ===== Alert ===== */
.alert {
    padding: 0.75rem 1rem;
    border-radius: 0.75rem;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.alert-success {
    background: #D1FAE5;
    border: 1px solid #6EE7B7;
    color: #065F46;
}

/* ===== Responsive ===== */
@media (max-width: 1024px) {
    .info-grid {
        grid-template-columns: 1fr;
    }
}
@media (max-width: 768px) {
    .status-timeline {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    .status-step {
        flex-direction: row;
        width: 100%;
        justify-content: flex-start;
        gap: 1rem;
        min-width: auto;
    }
    .status-line {
        display: none;
    }
    .status-label {
        text-align: left;
        max-width: none;
        margin-top: 0;
    }
}
</style>
@endpush

@section('content')

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<!-- Header -->
<div class="detail-header">
    <a href="{{ route('admin.aspirasi.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <h1>Detail Pengaduan - {{ $ticketCode }}</h1>
</div>

<!-- Status Timeline -->
<div class="detail-section">
    <h3 class="section-title"><i class="fas fa-stream"></i> Status Pengaduan</h3>
    
    @php
        $currentStatus = $aspirasi->aspirasi->status ?? 'Menunggu';
        $step = match($currentStatus) {
            'Selesai' => 2,
            'Proses' => 1,
            default => 0,
        };
    @endphp
    
    <div class="status-timeline">
        <!-- Step 1: Pengajuan -->
        <div class="status-step">
            <div class="status-dot {{ $step >= 0 ? 'active' : '' }}">
                <i class="fas fa-check"></i>
            </div>
            <span class="status-label {{ $step >= 0 ? 'active' : '' }}">Pengajuan</span>
        </div>
        
        <!-- Line 1 -->
        <div class="status-line {{ $step >= 1 ? 'active' : '' }}"></div>
        
        <!-- Step 2: Diproses -->
        <div class="status-step">
            <div class="status-dot {{ $step >= 1 ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
            </div>
            <span class="status-label {{ $step >= 1 ? 'active' : '' }}">Diproses</span>
        </div>
        
        <!-- Line 2 -->
        <div class="status-line {{ $step >= 2 ? 'active' : '' }}"></div>
        
        <!-- Step 3: Selesai -->
        <div class="status-step">
            <div class="status-dot {{ $step >= 2 ? 'active' : '' }}">
                <i class="fas fa-flag-checkered"></i>
            </div>
            <span class="status-label {{ $step >= 2 ? 'active' : '' }}">Selesai</span>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Left: Info Pengaduan -->
    <div class="lg:col-span-2 info-section">
        <h2 class="section-title">
            <i class="fas fa-info-circle"></i>
            Informasi Pengaduan
        </h2>
        
        <div class="space-y-4">
            <div class="info-grid">
                <div class="info-item">
                    <label>Judul</label>
                    <div class="info-value">{{ $aspirasi->judul ?? Str::limit($aspirasi->ket, 30) }}</div>
                </div>
                <div class="info-item">
                    <label>Kategori</label>
                    <div class="info-value">{{ $aspirasi->aspirasi->kategori->ket_kategori ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <label>Lokasi</label>
                    <div class="info-value">{{ $aspirasi->lokasi }}</div>
                </div>
                <div class="info-item">
                    <label>Prioritas</label>
                    <div class="info-value">{{ $aspirasi->prioritas ?? 'Sedang' }}</div>
                </div>
            </div>
            
            <div>
                <label class="block text-sm text-[#8B7355] mb-1">Deskripsi</label>
                <div class="description-box">{{ $aspirasi->ket }}</div>
            </div>
            
            @if($aspirasi->foto)
            <div>
                <label class="block text-sm text-[#8B7355] mb-2">Foto Bukti</label>
                <div class="photo-box">
                    <img src="{{ asset('storage/' . $aspirasi->foto) }}" alt="Foto Bukti">
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Right: Form Tanggapan + Info Siswa -->
    <div class="space-y-6">
        
        <!-- Form Tanggapan -->
        <div class="form-section">
            <h2 class="section-title">
                <i class="fas fa-comment-alt"></i>
                Tanggapan
            </h2>
            
            <form action="{{ route('admin.aspirasi.update', $aspirasi->aspirasi->id_aspirasi) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Menunggu" {{ $currentStatus == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="Proses" {{ $currentStatus == 'Proses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Selesai" {{ $currentStatus == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Feedback</label>
                        <textarea name="feedback" rows="4" class="form-textarea" placeholder="Tulis tanggapan...">{{ $aspirasi->aspirasi->feedback ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Siswa -->
        <div class="student-info">
            <h2 class="section-title">
                <i class="fas fa-user"></i>
                Pelapor
            </h2>
            
            <div class="info-list">
                <div class="info-row">
                    <label>NIS</label>
                    <div class="value">{{ $aspirasi->siswa->nis }}</div>
                </div>
                <div class="info-row">
                    <label>Nama</label>
                    <div class="value">{{ $aspirasi->siswa->nama }}</div>
                </div>
                <div class="info-row">
                    <label>Kelas</label>
                    <div class="value">{{ $aspirasi->siswa->kelas }}</div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection