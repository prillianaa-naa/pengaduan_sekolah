@extends('siswa.layouts.app')

@section('title', 'Dashboard - Pengaduan Sarana Sekolah')

@section('content')
<!-- Welcome Section -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-slate-800 mb-2">Selamat Datang, {{ auth()->guard('siswa')->user()->nama }}! 👋</h1>
    <p class="text-slate-600">Kelola dan pantau pengaduan sarana sekolah Anda di sini</p>
</div>

<!-- Stats Cards -->
<div class="grid md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-lg transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center text-white text-xl shadow-lg group-hover:scale-110 transition-transform">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <span class="text-3xl font-bold text-slate-800">{{ $aspirasis->count() }}</span>
        </div>
        <p class="text-slate-600 font-medium">Total Pengaduan</p>
    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-lg transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-gradient-to-br from-yellow-400 to-orange-400 rounded-xl flex items-center justify-center text-white text-xl shadow-lg group-hover:scale-110 transition-transform">
                <i class="fas fa-clock"></i>
            </div>
            <span class="text-3xl font-bold text-slate-800">{{ $aspirasis->where('aspirasi.status', 'Menunggu')->count() }}</span>
        </div>
        <p class="text-slate-600 font-medium">Menunggu</p>
    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-lg transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center text-white text-xl shadow-lg group-hover:scale-110 transition-transform">
                <i class="fas fa-cog"></i>
            </div>
            <span class="text-3xl font-bold text-slate-800">{{ $aspirasis->where('aspirasi.status', 'Proses')->count() }}</span>
        </div>
        <p class="text-slate-600 font-medium">Diproses</p>
    </div>
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-lg transition-all group">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center text-white text-xl shadow-lg group-hover:scale-110 transition-transform">
                <i class="fas fa-check-circle"></i>
            </div>
            <span class="text-3xl font-bold text-slate-800">{{ $aspirasis->where('aspirasi.status', 'Selesai')->count() }}</span>
        </div>
        <p class="text-slate-600 font-medium">Selesai</p>
    </div>
</div>

<!-- Action Button -->
<div class="mb-8">
    <a href="{{ route('siswa.aspirasi.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-xl font-semibold hover:shadow-xl hover:-translate-y-1 transition-all">
        <i class="fas fa-plus-circle"></i>
        Buat Pengaduan Baru
    </a>
</div>

<!-- Recent Aspirations -->
<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-200 bg-gradient-to-r from-indigo-50 to-purple-50">
        <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
            <i class="fas fa-history text-indigo-600"></i>
            Riwayat Pengaduan
        </h2>
    </div>
    
    <div class="divide-y divide-slate-200">
        @forelse($aspirasis as $item)
        <div class="p-6 hover:bg-slate-50 transition-colors">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-sm font-semibold text-slate-500">
                            {{ $item->created_at->format('d M Y') }}
                        </span>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($item->aspirasi->status == 'Menunggu')
                                bg-yellow-100 text-yellow-700 border border-yellow-300
                            @elseif($item->aspirasi->status == 'Proses')
                                bg-blue-100 text-blue-700 border border-blue-300
                            @else
                                bg-emerald-100 text-emerald-700 border border-emerald-300
                            @endif">
                            {{ $item->aspirasi->status }}
                        </span>
                    </div>
                    
                    <h3 class="text-lg font-semibold text-slate-800 mb-2">
                        {{ Str::limit($item->ket, 60) }}
                    </h3>
                    
                    <div class="flex items-center gap-6 text-sm text-slate-600">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-tag text-slate-400"></i>
                            {{ $item->aspirasi->kategori->ket_kategori }}
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-slate-400"></i>
                            {{ $item->lokasi }}
                        </span>
                    </div>
                    
                    @if($item->aspirasi->feedback)
                    <div class="mt-4 p-4 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl border border-indigo-200">
                        <p class="text-sm font-semibold text-slate-700 mb-1">
                            <i class="fas fa-comment-alt text-indigo-600 mr-2"></i>
                            Feedback:
                        </p>
                        <p class="text-sm text-slate-600">{{ $item->aspirasi->feedback }}</p>
                    </div>
                    @endif
                </div>
                
                <div class="flex flex-col items-end gap-2">
                    <button onclick="viewDetail({{ $item->id_pelaporan }})" class="text-indigo-600 hover:bg-indigo-50 px-4 py-2 rounded-lg font-medium transition-colors border border-indigo-200">
                        <i class="fas fa-eye mr-2"></i>Detail
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="p-12 text-center">
            <div class="w-20 h-20 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center text-indigo-400 text-3xl mx-auto mb-4">
                <i class="fas fa-inbox"></i>
            </div>
            <h3 class="text-lg font-semibold text-slate-800 mb-2">Belum Ada Pengaduan</h3>
            <p class="text-slate-600 mb-6">Mulai buat pengaduan pertama Anda untuk sarana sekolah yang lebih baik</p>
            <a href="{{ route('siswa.aspirasi.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg hover:-translate-y-0.5 transition-all">
                <i class="fas fa-plus-circle"></i>
                Buat Pengaduan
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
function viewDetail(id) {
    alert('Detail pengaduan ID: ' + id);
}
</script>
@endpush