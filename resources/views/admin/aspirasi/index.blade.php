@extends('admin.layouts.app')

@section('title', 'Daftar Pengaduan')

@push('styles')
<style>
/* ===== Page Header ===== */
.page-header {
    margin-bottom: 1.5rem;
}
.page-title-wrapper {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
}
.page-icon {
    width: 3rem;
    height: 3rem;
    background: linear-gradient(135deg, #A87B6E 0%, #8B6F5E 100%);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    box-shadow: 0 4px 12px rgba(168, 123, 110, 0.3);
}
.page-title {
    font-size: 1.875rem;
    font-weight: 700;
    color: #5D4E45;
}

/* ===== Filters Card ===== */
.filters-card {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    margin-bottom: 1.5rem;
}
.filter-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}
.filter-group {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.filter-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: #5D4E45;
    min-width: 80px;
}
.filter-select,
.filter-input {
    flex: 1;
    padding: 0.5rem 1rem;
    border: 1.5px solid #D4C4B7;
    border-radius: 0.75rem;
    background: #F5F0EB;
    font-size: 0.875rem;
    transition: all 0.3s;
}
.filter-select:focus,
.filter-input:focus {
    outline: none;
    border-color: #A87B6E;
    background: white;
    box-shadow: 0 0 0 4px rgba(168, 123, 110, 0.1);
}

/* ===== Status Tabs ===== */
.status-tabs {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
}
.status-tab {
    padding: 0.625rem 1.5rem;
    border-radius: 0.75rem;
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.status-tab i {
    font-size: 0.875rem;
}
.status-tab.active-all {
    background: linear-gradient(135deg, #A87B6E 0%, #8B6F5E 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(168, 123, 110, 0.3);
}
.status-tab.active-menunggu {
    background: linear-gradient(135deg, #FBBF24 0%, #F59E0B 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
}
.status-tab.active-proses {
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}
.status-tab.inactive {
    background: white;
    color: #8B7355;
}
.status-tab.inactive:hover {
    background: #F5F0EB;
}

/* ===== Table Container ===== */
.table-container {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    overflow: hidden;
}
.table-wrapper {
    overflow-x: auto;
}
.data-table {
    width: 100%;
    border-collapse: collapse;
}
.data-table thead {
    background: #F9F7F5;
}
.data-table th {
    padding: 1rem 1.5rem;
    text-align: left;
    font-size: 0.875rem;
    font-weight: 600;
    color: #5D4E45;
    border-bottom: 2px solid #E8DDD5;
}
.data-table td {
    padding: 1rem 1.5rem;
    font-size: 0.875rem;
    color: #5D4E45;
    border-bottom: 1px solid #E8DDD5;
}
.data-table tr:hover {
    background: #FAF7F5;
}
.ticket-code {
    font-weight: 600;
    color: #A87B6E;
}
.category-badge {
    padding: 0.25rem 0.75rem;
    background: #F5F0EB;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    color: #5D4E45;
    font-weight: 500;
}
.status-badge {
    padding: 0.375rem 1rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-block;
}
.status-menunggu {
    background: #FEF3C7;
    color: #92400E;
}
.status-proses {
    background: #D1FAE5;
    color: #065F46;
}
.status-selesai {
    background: #DBEAFE;
    color: #1E40AF;
}
.action-buttons {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}
.btn-detail {
    background: #8B6F5E;
    color: white;
    padding: 0.375rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s;
}
.btn-detail:hover {
    background: #6B5A4E;
    transform: translateY(-1px);
}
.btn-delete {
    background: transparent;
    color: #DC2626;
    padding: 0.375rem;
    border-radius: 0.5rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
}
.btn-delete:hover {
    background: #FEE2E2;
}

/* ===== Empty State ===== */
.empty-state {
    padding: 3rem 1.5rem;
    text-align: center;
    color: #8B7355;
}
.empty-state i {
    font-size: 3rem;
    margin-bottom: 0.75rem;
    opacity: 0.5;
}

/* ===== Pagination ===== */
.pagination-wrapper {
    padding: 1rem 1.5rem;
    border-top: 1px solid #E8DDD5;
}

/* ===== Responsive ===== */
@media (max-width: 768px) {
    .filter-row {
        grid-template-columns: 1fr;
    }
    .status-tabs {
        justify-content: flex-start;
    }
    .data-table {
        font-size: 0.75rem;
    }
    .data-table th,
    .data-table td {
        padding: 0.75rem 1rem;
    }
}
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="page-title-wrapper">
        <div class="page-icon">
            <i class="fas fa-file-alt"></i>
        </div>
        <h1 class="page-title">Daftar Pengaduan</h1>
    </div>
</div>

<!-- Filters -->
<div class="filters-card">
    <div class="filter-row">
        <div class="filter-group">
            <label class="filter-label">Kategori:</label>
            <select name="kategori" id="filterKategori" class="filter-select">
                <option value="">Pilih kategori di sini...</option>
                @foreach($kategoris ?? [] as $kategori)
                    <option value="{{ $kategori->id_kategori }}" {{ request('kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                        {{ $kategori->ket_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="filter-group">
            <label class="filter-label">Tanggal:</label>
            <input type="date" name="tanggal" id="filterTanggal" value="{{ request('tanggal') }}" class="filter-input">
        </div>
    </div>
</div>

<!-- Status Tabs (Only 3 tabs, no Laporan button) -->
<div class="status-tabs">
    <a href="{{ route('admin.aspirasi.index', array_merge(request()->except('status'), ['status' => ''])) }}" 
       class="status-tab {{ !request('status') || request('status') == 'all' ? 'active-all' : 'inactive' }}">
        <i class="fas fa-list"></i>All
    </a>
    <a href="{{ route('admin.aspirasi.index', array_merge(request()->except('status'), ['status' => 'Menunggu'])) }}" 
       class="status-tab {{ request('status') == 'Menunggu' ? 'active-menunggu' : 'inactive' }}">
        <i class="fas fa-clock"></i>Menunggu
    </a>
    <a href="{{ route('admin.aspirasi.index', array_merge(request()->except('status'), ['status' => 'Proses'])) }}" 
       class="status-tab {{ request('status') == 'Proses' ? 'active-proses' : 'inactive' }}">
        <i class="fas fa-cog"></i>Diproses
    </a>
</div>

<!-- Table -->
<div class="table-container">
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="w-16">No.</th>
                    <th>Kode Tiket</th>
                    <th>Judul Pengaduan</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th class="w-32 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aspirasis ?? [] as $index => $item)
                <tr>
                    <td>{{ $aspirasis->firstItem() + $index }}</td>
                    <td class="ticket-code">SK-{{ str_pad($item->id_pelaporan, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ Str::limit($item->judul ?? $item->ket, 40) }}</td>
                    <td><span class="category-badge">{{ $item->aspirasi->kategori->ket_kategori }}</span></td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td>
                        @if($item->aspirasi->status == 'Menunggu')
                            <span class="status-badge status-menunggu">Menunggu</span>
                        @elseif($item->aspirasi->status == 'Proses')
                            <span class="status-badge status-proses">Diproses</span>
                        @else
                            <span class="status-badge status-selesai">Selesai</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="action-buttons">
                            <a href="{{ route('admin.aspirasi.show', $item->id_pelaporan) }}" class="btn-detail">
                                Detail
                            </a>
                            <button onclick="deleteItem({{ $item->id_pelaporan }})" class="btn-delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Belum ada data pengaduan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if(isset($aspirasis) && $aspirasis->hasPages())
    <div class="pagination-wrapper">
        {{ $aspirasis->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// Auto submit filter
document.getElementById('filterKategori').addEventListener('change', function() {
    updateUrl('kategori', this.value);
});

document.getElementById('filterTanggal').addEventListener('change', function() {
    updateUrl('tanggal', this.value);
});

function updateUrl(key, value) {
    const url = new URL(window.location);
    if (value) {
        url.searchParams.set(key, value);
    } else {
        url.searchParams.delete(key);
    }
    window.location.href = url;
}

function deleteItem(id) {
    if (confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/admin/aspirasi/' + id;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush