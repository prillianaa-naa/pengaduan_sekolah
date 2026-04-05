@extends('admin.layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="mb-6">
    <div class="flex items-center gap-3 mb-2">
        <div class="w-12 h-12 bg-gradient-to-br from-[#8B5CF6] to-[#7C3AED] rounded-xl flex items-center justify-center text-white text-2xl">
            <i class="fas fa-file-alt"></i>
        </div>
        <h1 class="text-3xl font-bold text-[#5D4E45]">Laporan Pengaduan</h1>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gradient-to-br from-[#FBBF24] to-[#F59E0B] rounded-xl flex items-center justify-center text-white text-xl">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-[#5D4E45]">{{ $totalPengaduan }}</div>
                <div class="text-sm text-[#8B7355]">Total Pengaduan</div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gradient-to-br from-[#FCD34D] to-[#FBBF24] rounded-xl flex items-center justify-center text-white text-xl">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-[#5D4E45]">{{ $menunggu }}</div>
                <div class="text-sm text-[#8B7355]">Menunggu</div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gradient-to-br from-[#3B82F6] to-[#2563EB] rounded-xl flex items-center justify-center text-white text-xl">
                <i class="fas fa-cog"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-[#5D4E45]">{{ $proses }}</div>
                <div class="text-sm text-[#8B7355]">Diproses</div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-gradient-to-br from-[#10B981] to-[#059669] rounded-xl flex items-center justify-center text-white text-xl">
                <i class="fas fa-check"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-[#5D4E45]">{{ $selesai }}</div>
                <div class="text-sm text-[#8B7355]">Selesai</div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Form -->
<div class="bg-white rounded-2xl p-6 shadow-sm mb-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-[#5D4E45]">Filter Laporan</h2>
        @if(request('tanggal_mulai') || request('tanggal_selesai'))
        <a href="{{ route('admin.laporan.index') }}" class="text-sm text-red-500 hover:text-red-700 font-medium">
            <i class="fas fa-times-circle mr-1"></i> Reset Filter
        </a>
        @endif
    </div>
    
    <form action="{{ route('admin.laporan.generate') }}" method="GET" id="filterForm">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-[#5D4E45] mb-2">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" 
                       class="w-full px-4 py-2 border border-[#D4C4B7] rounded-xl focus:outline-none focus:border-[#A87B6E] transition-all"
                       value="{{ request('tanggal_mulai') }}"
                       onchange="autoSubmit()">
            </div>
            <div>
                <label class="block text-sm font-semibold text-[#5D4E45] mb-2">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" 
                       class="w-full px-4 py-2 border border-[#D4C4B7] rounded-xl focus:outline-none focus:border-[#A87B6E] transition-all"
                       value="{{ request('tanggal_selesai') }}"
                       onchange="autoSubmit()">
            </div>
        </div>
    </form>
    
    <p class="text-xs text-[#8B7355] mt-3">
        <i class="fas fa-info-circle"></i> Pilih tanggal untuk filter otomatis. Kosongkan untuk tampil semua data.
    </p>
</div>

<!-- Data Table -->
<div class="bg-white rounded-2xl shadow-sm mb-6 overflow-hidden">
    <div class="p-6 border-b border-[#E8DDD5]">
        <h2 class="text-xl font-bold text-[#5D4E45]">
            Data Pengaduan Selesai
            @if(isset($tanggalMulai) && isset($tanggalSelesai))
                <span class="text-sm font-normal text-[#8B7355]">
                    (Periode: {{ \Carbon\Carbon::parse($tanggalMulai)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d/m/Y') }})
                </span>
            @endif
        </h2>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-[#F9F7F5]">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-[#5D4E45]">No.</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-[#5D4E45]">Tanggal</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-[#5D4E45]">Nama Pelapor</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-[#5D4E45]">Kelas</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-[#5D4E45]">Kategori</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-[#5D4E45]">Keterangan</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-[#5D4E45]">Feedback</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#E8DDD5]">
                @forelse($laporans as $index => $laporan)
                <tr class="hover:bg-[#FAF7F5] transition-colors">
                    <td class="px-6 py-4 text-sm">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm">{{ $laporan->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 text-sm font-semibold">{{ $laporan->siswa->nama }}</td>
                    <td class="px-6 py-4 text-sm">{{ $laporan->siswa->kelas }}</td>
                    <td class="px-6 py-4 text-sm">{{ $laporan->kategori->ket_kategori }}</td>
                    <td class="px-6 py-4 text-sm">{{ Str::limit($laporan->ket, 50) }}</td>
                    <td class="px-6 py-4 text-sm">{{ Str::limit($laporan->aspirasi->feedback ?? '-', 30) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-[#8B7355]">
                        <i class="fas fa-inbox text-4xl mb-3 opacity-50"></i>
                        <p>Belum ada pengaduan yang selesai</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Export Options -->
<div class="bg-white rounded-2xl p-6 shadow-sm">
    <h2 class="text-xl font-bold text-[#5D4E45] mb-6">Export Laporan</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('admin.laporan.pdf') }}" class="p-6 border-2 border-[#E8DDD5] rounded-xl hover:border-[#A87B6E] transition-all text-center group block">
            <i class="fas fa-file-pdf text-4xl text-red-500 mb-3 group-hover:scale-110 transition-transform"></i>
            <div class="font-semibold text-[#5D4E45]">Export PDF</div>
        </a>
        <a href="{{ route('admin.laporan.excel') }}" class="p-6 border-2 border-[#E8DDD5] rounded-xl hover:border-[#A87B6E] transition-all text-center group block">
            <i class="fas fa-file-excel text-4xl text-green-500 mb-3 group-hover:scale-110 transition-transform"></i>
            <div class="font-semibold text-[#5D4E45]">Export Excel</div>
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
function autoSubmit() {
    const tanggalMulai = document.getElementById('tanggal_mulai').value;
    const tanggalSelesai = document.getElementById('tanggal_selesai').value;
    
    // Hanya submit jika kedua tanggal diisi
    if (tanggalMulai && tanggalSelesai) {
        document.getElementById('filterForm').submit();
    } else if (!tanggalMulai && !tanggalSelesai) {
        // Jika keduanya kosong, tetap submit (untuk reset)
        document.getElementById('filterForm').submit();
    }
    // Jika hanya satu yang diisi, tunggu yang kedua diisi
}
</script>
@endpush

