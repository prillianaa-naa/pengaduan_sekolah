@extends('siswa.layouts.app')

@section('title', 'Detail Pengaduan')

<style>
.detail-container {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    border-radius: 1.5rem;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    overflow: hidden;
}
.detail-header {
    background: linear-gradient(135deg, #F5F0EB 0%, #E8DDD5 100%);
    padding: 2rem 2.5rem;
    border-bottom: 1px solid #D4C4B7;
}
.detail-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #5D4E45;
    margin-bottom: 0.5rem;
}
.detail-meta {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    font-size: 0.875rem;
    color: #8B7355;
}
.detail-meta span {
    display: flex;
    align-items: center;
    gap: 0.375rem;
}
.detail-body {
    padding: 2.5rem;
}
.detail-section {
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #E2E8F0;
}
.detail-section:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}
.section-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #5D4E45;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.section-title i {
    color: #A87B6E;
}
.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}
.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.375rem;
}
.info-label {
    font-size: 0.8rem;
    color: #94A3B8;
    font-weight: 500;
}
.info-value {
    font-size: 0.95rem;
    color: #334155;
    font-weight: 500;
}
.info-value strong {
    color: #1E293B;
}
.keterangan-box {
    background: #F8FAFC;
    padding: 1.25rem;
    border-radius: 0.875rem;
    border-left: 4px solid #A87B6E;
    font-size: 0.95rem;
    color: #475569;
    line-height: 1.6;
}
.photo-box {
    text-align: center;
    padding: 1rem;
}

.photo-box img {
    max-width: 100%;
    max-height: 400px;
    border-radius: 1rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: transform 0.3s;
}

.photo-box img:hover {
    transform: scale(1.02);
}

.photo-placeholder {
    background: #F1F5F9;
    padding: 3rem 2rem;
    border-radius: 1rem;
    color: #94A3B8;
    text-align: center;
}

.photo-placeholder i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

/* Photo Modal */
.photo-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.9);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    cursor: zoom-out;
}

.photo-modal.show {
    display: flex;
}

.photo-modal img {
    max-width: 95%;
    max-height: 95vh;
    border-radius: 1rem;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}

.photo-modal-close {
    position: absolute;
    top: 2rem;
    right: 2rem;
    background: white;
    color: #1E293B;
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
    font-size: 1.5rem;
    transition: all 0.3s;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

.photo-modal-close:hover {
    background: #F1F5F9;
    transform: rotate(90deg);
}

.status-timeline {
    display: flex;
    align-items: center;
    gap: 1rem;
}
.status-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    flex: 1;
}
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
}
.status-dot.active {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
}
.status-dot.pending {
    background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
}
.status-label {
    font-size: 0.75rem;
    font-weight: 600;
    color: #64748B;
    text-align: center;
}
.status-label.active {
    color: #10B981;
}
.status-line {
    flex: 1;
    height: 3px;
    background: #E2E8F0;
    margin: 0 0.5rem;
}
.status-line.active {
    background: linear-gradient(90deg, #10B981, #059669);
}
.feedback-box {
    background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
    border: 1px solid #6EE7B7;
    padding: 1.25rem;
    border-radius: 0.875rem;
    color: #065F46;
}
.feedback-box .feedback-title {
    font-weight: 600;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.detail-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid #E2E8F0;
}
.btn-back {
    background: #E2E8F0;
    color: #475569;
    padding: 0.75rem 1.5rem;
    border-radius: 0.75rem;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
}
.btn-back:hover {
    background: #CBD5E1;
}
.btn-edit {
    background: linear-gradient(135deg, #A87B6E 0%, #8B6F5E 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 0.75rem;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s;
}
.btn-edit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(168,123,110,0.3);
}
@media (max-width: 768px) {
    .info-grid {
        grid-template-columns: 1fr;
    }
    .detail-header,
    .detail-body {
        padding: 1.5rem;
    }
    .status-timeline {
        flex-wrap: wrap;
    }
    .status-line {
        display: none;
    }
}

/* Animasi untuk feedback baru */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.feedback-box {
    animation: fadeInUp 0.4s ease;
}

/* Highlight timeline saat status berubah */
.status-dot.active {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
    100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}
</style>

@section('content')
<!-- Auto-refresh setiap 30 detik untuk update status/feedback -->
<meta http-equiv="refresh" content="30">

<div class="detail-container">
    <!-- Header -->
    <div class="detail-header">
        <h1 class="detail-title">{{ $aspirasi->judul ?? Str::limit($aspirasi->ket, 50) }}</h1>
        <div class="detail-meta">
            <span><i class="fas fa-ticket-alt"></i> {{ $ticketCode }}</span>
            <span><i class="fas fa-calendar"></i> {{ $aspirasi->created_at->format('d F Y') }}</span>
            <span><i class="fas fa-clock"></i> {{ $aspirasi->created_at->format('H:i') }} WIB</span>
        </div>
    </div>

    <!-- Body -->
    <div class="detail-body">
        <!-- Status Timeline -->
        <div class="detail-section">
            <h3 class="section-title"><i class="fas fa-stream"></i> Status Pengaduan</h3>
            
            @php
                // ✅ Ambil status dari relasi aspirasi (bukan dari input_aspirasi)
                $status = $aspirasi->aspirasi->status ?? 'Menunggu';
            @endphp
            
            <div class="status-timeline">
                <!-- Step 1: Dikirim -->
                <div class="status-step">
                    <div class="status-dot {{ in_array($status, ['Menunggu', 'Proses', 'Selesai']) ? 'active' : '' }}"
                        style="background: {{ in_array($status, ['Menunggu', 'Proses', 'Selesai']) ? 'linear-gradient(135deg, #10B981 0%, #059669 100%)' : '#E2E8F0' }}">
                        <i class="fas fa-check"></i>
                    </div>
                    <span class="status-label {{ in_array($status, ['Menunggu', 'Proses', 'Selesai']) ? 'active' : '' }}">Dikirim</span>
                </div>
                <div class="status-line {{ in_array($status, ['Proses', 'Selesai']) ? 'active' : '' }}"></div>
                
                <!-- Step 2: Diproses -->
                <div class="status-step">
                    <div class="status-dot {{ in_array($status, ['Proses', 'Selesai']) ? 'active' : '' }}"
                        style="background: {{ in_array($status, ['Proses', 'Selesai']) ? 'linear-gradient(135deg, #10B981 0%, #059669 100%)' : '#E2E8F0' }}">
                        <i class="fas fa-cog"></i>
                    </div>
                    <span class="status-label {{ in_array($status, ['Proses', 'Selesai']) ? 'active' : '' }}">Diproses</span>
                </div>
                <div class="status-line {{ $status == 'Selesai' ? 'active' : '' }}"></div>
                
                <!-- Step 3: Selesai -->
                <div class="status-step">
                    <div class="status-dot {{ $status == 'Selesai' ? 'active' : '' }}"
                        style="background: {{ $status == 'Selesai' ? 'linear-gradient(135deg, #10B981 0%, #059669 100%)' : '#E2E8F0' }}">
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                    <span class="status-label {{ $status == 'Selesai' ? 'active' : '' }}">Selesai</span>
                </div>
            </div>
            
            <!-- Last Updated -->
            @if(($aspirasi->aspirasi->updated_at ?? $aspirasi->created_at) != $aspirasi->created_at)
            <p class="text-xs text-[#10B981] mt-3 text-center">
                <i class="fas fa-sync-alt"></i> Terakhir diupdate: {{ ($aspirasi->aspirasi->updated_at ?? $aspirasi->created_at)->diffForHumans() }}
            </p>
            @endif
        </div>

        <!-- Info Grid -->
        <div class="detail-section">
            <h3 class="section-title"><i class="fas fa-info-circle"></i> Informasi Pengaduan</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Kategori</span>
                    <span class="info-value"><strong>{{ $aspirasi->kategori->ket_kategori }}</strong></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Prioritas</span>
                    <span class="info-value">
                        @if(($aspirasi->prioritas ?? 'Sedang') == 'Tinggi')
                            <span class="priority-badge priority-tinggi"><i class="fas fa-arrow-up"></i> Tinggi</span>
                        @elseif(($aspirasi->prioritas ?? 'Sedang') == 'Rendah')
                            <span class="priority-badge priority-rendah"><i class="fas fa-arrow-down"></i> Rendah</span>
                        @else
                            <span class="priority-badge priority-sedang"><i class="fas fa-arrow-right"></i> Sedang</span>
                        @endif
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Lokasi</span>
                    <span class="info-value"><strong>{{ $aspirasi->lokasi }}</strong></span>
                </div>
                <div class="info-item">
                    <span class="info-label">Pelapor</span>
                    <span class="info-value"><strong>{{ $aspirasi->siswa->nama }}</strong> ({{ $aspirasi->siswa->kelas }})</span>
                </div>
            </div>
        </div>

        <!-- Keterangan -->
        <div class="detail-section">
            <h3 class="section-title"><i class="fas fa-sticky-note"></i> Keterangan</h3>
            <div class="keterangan-box">
                {{ $aspirasi->ket }}
            </div>
        </div>

        <!-- Foto Bukti -->
        <div class="detail-section">
            <h3 class="section-title"><i class="fas fa-image"></i> Foto Bukti</h3>
            
            @if(!empty($aspirasi->foto) && $aspirasi->foto != '')
                <div class="photo-box">
                    <img src="{{ asset('storage/' . $aspirasi->foto) }}" 
                        alt="Foto Bukti" 
                        onclick="openPhotoModal(this.src)"
                        onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'photo-placeholder\'><i class=\'fas fa-exclamation-triangle\'></i><p>Gagal memuat foto. Pastikan file ada di folder storage.</p></div>';"
                        style="cursor: pointer; max-width: 100%; max-height: 400px; border-radius: 1rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <p class="text-sm text-[#94A3B8] mt-2">
                        <i class="fas fa-search-plus"></i> Klik foto untuk memperbesar
                    </p>
                </div>
            @else
                <div class="photo-placeholder">
                    <i class="fas fa-image-slash"></i>
                    <p>Tidak ada foto yang diunggah</p>
                </div>
            @endif
        </div>

        <!-- Feedback Admin -->
        @if(($aspirasi->aspirasi->feedback ?? '') != '')
        <div class="detail-section">
            <h3 class="section-title"><i class="fas fa-comment-alt"></i> Feedback dari Admin</h3>
            <div class="feedback-box">
                <div class="feedback-title">
                    <i class="fas fa-user-shield"></i> Administrator
                </div>
                <p>{{ $aspirasi->aspirasi->feedback }}</p>
                <p class="text-sm opacity-75 mt-2">
                    <i class="fas fa-clock"></i> {{ ($aspirasi->aspirasi->updated_at ?? $aspirasi->created_at)->diffForHumans() }}
                </p>
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="detail-actions">
            <a href="{{ route('siswa.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            @if($aspirasi->status == 'Menunggu')
            <a href="{{ route('siswa.aspirasi.edit', $aspirasi->id_pelaporan) }}" class="btn-edit">
                <i class="fas fa-edit"></i> Edit Pengaduan
            </a>
            @endif
        </div>
    </div>
</div>

<!-- Photo Modal -->
<div id="photoModal" class="photo-modal" onclick="closePhotoModal()">
    <button class="photo-modal-close" onclick="closePhotoModal()"><i class="fas fa-times"></i></button>
    <img id="modalImage" src="" alt="Foto Bukti">
</div>
@endsection

@push('scripts')
<script>
function openPhotoModal(src) {
    // Buat modal jika belum ada
    let modal = document.getElementById('photoModal');
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'photoModal';
        modal.className = 'photo-modal';
        modal.onclick = closePhotoModal;
        
        const closeBtn = document.createElement('button');
        closeBtn.className = 'photo-modal-close';
        closeBtn.innerHTML = '<i class="fas fa-times"></i>';
        closeBtn.onclick = function(e) {
            e.stopPropagation();
            closePhotoModal();
        };
        
        const img = document.createElement('img');
        img.id = 'modalImage';
        
        modal.appendChild(closeBtn);
        modal.appendChild(img);
        document.body.appendChild(modal);
    }
    
    // Set source dan tampilkan
    document.getElementById('modalImage').src = src;
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function closePhotoModal() {
    const modal = document.getElementById('photoModal');
    if (modal) {
        modal.classList.remove('show');
        document.body.style.overflow = '';
    }
}

// Close modal dengan Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePhotoModal();
    }
});
</script>
@endpush