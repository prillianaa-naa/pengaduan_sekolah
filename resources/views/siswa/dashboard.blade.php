@extends('siswa.layouts.app')

@section('title', 'Dashboard - Pengaduan Sarana Sekolah')

@push('styles')
<style>
/* ===== Welcome Section ===== */
.welcome-section { padding: 8px 0; margin-bottom: 2rem; }
.welcome-title { font-size: 1.875rem; font-weight: 700; color: #5D4E45; margin-bottom: 0.5rem; }
.welcome-subtitle { color: #8B7355; }

/* ===== Stats Grid ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
    margin-bottom: 2rem;
}

/* ===== Stat Card ===== */
.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 1rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    border: 1px solid #E8DDD5;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: transform 0.3s, box-shadow 0.3s;
}
.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(168,123,110,0.1);
}
.stat-icon {
    width: 3rem; height: 3rem;
    border-radius: 0.75rem;
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 1.25rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.stat-icon.bg-gold { background: linear-gradient(135deg, #FBBF24, #F59E0B); }
.stat-icon.bg-yellow { background: linear-gradient(135deg, #FCD34D, #FBBF24); }
.stat-icon.bg-brown { background: linear-gradient(135deg, #A87B6E, #8B6F5E); }
.stat-icon.bg-green { background: linear-gradient(135deg, #10B981, #059669); }
.stat-info .stat-number { font-size: 1.875rem; font-weight: 700; color: #5D4E45; }
.stat-info .stat-label { font-size: 0.875rem; color: #8B7355; font-weight: 500; }

/* ===== Table Container ===== */
.table-container {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    border: 1px solid #E8DDD5;
    overflow: hidden;
}
.table-header {
    padding: 1.5rem;
    border-bottom: 1px solid #E8DDD5;
    display: flex; justify-content: space-between; align-items: center;
    flex-wrap: wrap; gap: 1rem;
}
.table-title {
    font-size: 1.25rem; font-weight: 700; color: #5D4E45;
    display: flex; align-items: center; gap: 0.5rem;
}
.table-title i { color: #A87B6E; }

/* ===== Add Button ===== */
.btn-add {
    display: inline-flex; align-items: center; gap: 0.5rem;
    background: linear-gradient(135deg, #A87B6E, #8B6F5E);
    color: white; padding: 0.625rem 1.25rem;
    border-radius: 0.75rem; font-weight: 600; font-size: 0.875rem;
    text-decoration: none; transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 4px 12px rgba(168,123,110,0.3);
}
.btn-add:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(168,123,110,0.4); }

/* ===== Table ===== */
.table-wrapper { overflow-x: auto; }
.data-table { width: 100%; border-collapse: collapse; }
.data-table thead { background: #F9F7F5; }
.data-table th {
    padding: 1rem 1.5rem;
    text-align: left;
    font-size: 0.875rem;
    font-weight: 600;
    color: #5D4E45;
    border-bottom: 2px solid #E8DDD5;
}
.data-table td {
    padding: 1rem 1.5rem; font-size: 0.875rem; color: #5D4E45;
    border-bottom: 1px solid #E8DDD5;
}
.data-table tr:hover { background: #FAF7F5; }
.data-table .ticket-code { font-weight: 600; color: #A87B6E; }
.data-table th.text-center {text-align: center;}
.data-table td.text-center {text-align: center; vertical-align: middle;}

/* ===== Badges ===== */
.category-badge {
    padding: 0.25rem 0.75rem;
    background: #F5F0EB;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    color: #5D4E45;
    font-weight: 500;
    display: inline-block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 150px;
}
.status-badge {
    padding: 0.375rem 1rem; border-radius: 9999px;
    font-size: 0.75rem; font-weight: 600;
    display: inline-flex; align-items: center; gap: 0.375rem;
}
.status-menunggu { background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; }
.status-proses { background: #D1FAE5; color: #065F46; border: 1px solid #A7F3D0; }
.status-selesai { background: #DBEAFE; color: #1E40AF; border: 1px solid #BFDBFE; }

.priority-badge {
    padding: 0.25rem 0.625rem; border-radius: 9999px;
    font-size: 0.7rem; font-weight: 600;
    display: inline-flex; align-items: center; gap: 0.25rem;
}
.priority-tinggi { background: #FEE2E2; color: #DC2626; border: 1px solid #FCA5A5; }
.priority-sedang { background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; }
.priority-rendah { background: #DBEAFE; color: #1E40AF; border: 1px solid #BFDBFE; }

/* ===== Action Buttons ===== */
.btn-photo, .btn-detail {
    width: 2rem; height: 2rem; border-radius: 0.5rem;
    display: inline-flex; align-items: center; justify-content: center;
    border: none; cursor: pointer; transition: all 0.3s;
    text-decoration: none; font-size: 0.875rem;
}
.btn-photo {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 0.5rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #F1F5F9;
    color: #64748B;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 1rem;
}
.btn-photo:hover {
    background: #E2E8F0;
    color: #A87B6E;
    transform: scale(1.05);
}
.btn-detail {
    background: #8B6F5E; color: white;
}
.btn-detail:hover { background: #6B5A4E; transform: translateY(-1px); }
.btn-photo .fa-image-slash,
.text-\[\#CBD5E1\] {
    font-size: 1.25rem;
    opacity: 0.5;
}

/* ===== Photo Modal ===== */
.photo-modal {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.8); z-index: 1000;
    align-items: center; justify-content: center; padding: 2rem;
}
.photo-modal.show { display: flex; }
.photo-modal img {
    max-width: 90%; max-height: 90vh;
    border-radius: 1rem; box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}
.photo-modal-close {
    position: absolute; top: 2rem; right: 2rem;
    background: white; color: #1E293B;
    width: 3rem; height: 3rem; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    border: none; cursor: pointer; font-size: 1.5rem;
    transition: background 0.3s;
}
.photo-modal-close:hover { background: #F1F5F9; }

/* ===== Empty State ===== */
.empty-state { padding: 3rem 1.5rem; text-align: center; color: #8B7355; }
.empty-icon {
    width: 5rem; height: 5rem; background: #F5F0EB;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    color: #A87B6E; font-size: 1.875rem; margin: 0 auto 1rem;
}
.empty-state h3 { font-size: 1.125rem; font-weight: 600; color: #5D4E45; margin-bottom: 0.5rem; }
.empty-state p { margin-bottom: 1rem; }

/* ===== Pagination ===== */
.pagination-wrapper {
    padding: 1rem 1.5rem; border-top: 1px solid #E8DDD5;
    display: flex; justify-content: space-between; align-items: center;
    flex-wrap: wrap; gap: 1rem;
}
.pagination-info { font-size: 0.875rem; color: #8B7355; }
.pagination-buttons { display: flex; align-items: center; gap: 0.5rem; }
.page-btn {
    padding: 0.5rem 1rem; font-size: 0.875rem; color: #5D4E45;
    text-decoration: none; border: 1px solid #E2E8F0;
    border-radius: 0.5rem; background: white;
    transition: all 0.3s; display: inline-flex; align-items: center; gap: 0.375rem;
}
.page-btn:hover { background: #F5F0EB; border-color: #A87B6E; }
.page-btn.active {
    background: linear-gradient(135deg, #A87B6E, #8B6F5E);
    color: white; border-color: #A87B6E; font-weight: 600;
    box-shadow: 0 2px 8px rgba(168,123,110,0.3);
}
.page-btn.disabled { color: #D4C4B7; cursor: not-allowed; }
.page-ellipsis { padding: 0 0.5rem; color: #8B7355; }

/* ===== Responsive ===== */
@media (max-width: 1024px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
    .stats-grid { grid-template-columns: 1fr; }
    .table-header { flex-direction: column; align-items: flex-start; }
    .pagination-wrapper { flex-direction: column; align-items: flex-start; }
}
@media (max-width: 640px) {
    .stats-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
<!-- Welcome Section -->
<div class="welcome-section">
    <h1 class="welcome-title">Selamat Datang, {{ auth()->guard('siswa')->user()->nama }}! 👋</h1>
    <p class="welcome-subtitle">Kelola dan pantau pengaduan sarana sekolah Anda di sini</p>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon bg-gold"><i class="fas fa-ticket-alt"></i></div>
        <div class="stat-info">
            <div class="stat-number">{{ $aspirasis->total() ?? 0 }}</div>
            <p class="stat-label">Total Pengaduan</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-yellow"><i class="fas fa-clock"></i></div>
        <div class="stat-info">
            <div class="stat-number">{{ $aspirasis->where('aspirasi.status', 'Menunggu')->count() }}</div>
            <p class="stat-label">Menunggu</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-brown"><i class="fas fa-cog"></i></div>
        <div class="stat-info">
            <div class="stat-number">{{ $aspirasis->where('aspirasi.status', 'Proses')->count() }}</div>
            <p class="stat-label">Diproses</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon bg-green"><i class="fas fa-check"></i></div>
        <div class="stat-info">
            <div class="stat-number">{{ $aspirasis->where('aspirasi.status', 'Selesai')->count() }}</div>
            <p class="stat-label">Selesai</p>
        </div>
    </div>
</div>

<!-- Table Container -->
<div class="table-container">
    <div class="table-header">
        <h2 class="table-title"><i class="fas fa-list-ul"></i> Daftar Pengaduan</h2>
        <a href="{{ route('siswa.aspirasi.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Pengaduan
        </a>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="w-16">No.</th>
                    <th>Kode Tiket</th>
                    <th>Judul Aspirasi</th>
                    <th>Prioritas</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class="w-24 text-center">Foto</th>
                    <th class="w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aspirasis as $index => $item)
                <tr>
                    <td>{{ $aspirasis->firstItem() + $index }}</td>
                    <td class="ticket-code">
                        {{ 'SK-' . strtoupper(substr($item->siswa->kelas, 0, 3)) . '-' . str_pad($item->id_pelaporan, 4, '0', STR_PAD_LEFT) }}
                    </td>
                    <td>
                        <div class="font-semibold text-[#5D4E45]">
                            {{ Str::limit($item->judul ?? $item->ket, 40) }}
                        </div>
                    </td>
                    <td>
                        @php $prioritas = $item->prioritas ?? 'Sedang'; @endphp
                        @if($prioritas == 'Tinggi')
                            <span class="priority-badge priority-tinggi"><i class="fas fa-arrow-up"></i> Tinggi</span>
                        @elseif($prioritas == 'Rendah')
                            <span class="priority-badge priority-rendah"><i class="fas fa-arrow-down"></i> Rendah</span>
                        @else
                            <span class="priority-badge priority-sedang"><i class="fas fa-arrow-right"></i> Sedang</span>
                        @endif
                    </td>
                    <td>
                        <span class="category-badge" title="{{ $item->aspirasi->kategori->ket_kategori }}">
                            {{ Str::limit($item->aspirasi->kategori->ket_kategori, 15) }}
                        </span>
                    </td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td>
                        @php $status = $item->aspirasi->status ?? 'Menunggu'; @endphp
                        @if($status == 'Menunggu')
                            <span class="status-badge status-menunggu"><i class="fas fa-clock"></i> Menunggu</span>
                        @elseif($status == 'Proses')
                            <span class="status-badge status-proses"><i class="fas fa-cog"></i> Diproses</span>
                        @else
                            <span class="status-badge status-selesai"><i class="fas fa-check"></i> Selesai</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if(!empty($item->foto))
                            @php
                                $fotoPath = $item->foto;
                                if (!str_starts_with($fotoPath, 'aspirasi-foto/')) {
                                    $fotoPath = 'aspirasi-foto/' . $fotoPath;
                                }
                                $fullUrl = asset('storage/' . $fotoPath);
                            @endphp
                            
                            <!-- Thumbnail kecil -->
                            <img src="{{ $fullUrl }}" 
                                alt="Foto" 
                                onclick="viewPhoto('{{ $fullUrl }}')"
                                style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px; cursor: pointer; border: 2px solid #E8DDD5;"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            
                            <!-- Fallback icon jika gambar gagal load -->
                            <button onclick="viewPhoto('{{ $fullUrl }}')" 
                                    style="display: none; width: 40px; height: 40px; background: #E2E8F0; border: none; border-radius: 8px; cursor: pointer; color: #A87B6E; font-size: 20px;">
                                <i class="fas fa-image"></i>
                            </button>
                        @else
                            <div style="width: 40px; height: 40px; background: #F1F5F9; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #CBD5E1; font-size: 20px;">
                                <i class="fas fa-image-slash"></i>
                            </div>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('siswa.aspirasi.show', $item->id_pelaporan) }}" 
                        class="btn-detail" 
                        title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="empty-state">
                        <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                        <h3>Belum Ada Pengaduan</h3>
                        <p>Mulai buat pengaduan pertama Anda untuk sarana sekolah yang lebih baik</p>
                        <a href="{{ route('siswa.aspirasi.create') }}" class="btn-add">
                            <i class="fas fa-plus"></i> Buat Pengaduan
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($aspirasis->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-info">
            Menampilkan {{ $aspirasis->firstItem() ?? 0 }} - {{ $aspirasis->lastItem() ?? 0 }} dari {{ $aspirasis->total() }} data
        </div>
        <div class="pagination-buttons">
            {{ $aspirasis->links() }}
        </div>
    </div>
    @endif
</div>

<!-- Photo Modal -->
<div id="photoModal" class="photo-modal" onclick="closePhotoModal()">
    <button class="photo-modal-close" onclick="closePhotoModal(); event.stopPropagation();">
        <i class="fas fa-times"></i>
    </button>
    <img id="modalImage" src="" alt="Foto Bukti">
</div>
@endsection

@push('scripts')
<script>
function viewPhoto(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('photoModal').classList.add('show');
    document.body.style.overflow = 'hidden';
}
function closePhotoModal() {
    document.getElementById('photoModal').classList.remove('show');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closePhotoModal();
});
</script>
@endpush