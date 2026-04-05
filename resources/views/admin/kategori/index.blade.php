@extends('admin.layouts.app')

@section('title', 'Kategori Pengaduan')

@section('content')
<div class="mb-6">
    <div class="flex items-center gap-3 mb-2">
        <div class="w-12 h-12 bg-gradient-to-br from-[#10B981] to-[#059669] rounded-xl flex items-center justify-center text-white text-2xl">
            <i class="fas fa-tags"></i>
        </div>
        <h1 class="text-3xl font-bold text-[#5D4E45]">Kategori Pengaduan</h1>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Form Tambah Kategori -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <h2 class="text-xl font-bold text-[#5D4E45] mb-6">Tambah Kategori</h2>
        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-[#5D4E45] mb-2">Nama Kategori</label>
                <input type="text" name="ket_kategori" class="w-full px-4 py-2 border border-[#D4C4B7] rounded-xl focus:outline-none focus:border-[#A87B6E]" placeholder="Contoh: Fasilitas Kelas" required>
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-[#A87B6E] to-[#8B6F5E] text-white px-4 py-2 rounded-xl font-semibold hover:shadow-lg transition-all">
                <i class="fas fa-plus mr-2"></i> Tambah Kategori
            </button>
        </form>
    </div>

    <!-- Daftar Kategori -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
        <h2 class="text-xl font-bold text-[#5D4E45] mb-6">Daftar Kategori</h2>
        <div class="space-y-3">
            @forelse($kategoris as $kategori)
            <div class="flex items-center justify-between p-4 bg-[#F9F7F5] rounded-xl">
                <span class="font-semibold text-[#5D4E45]">{{ $kategori->ket_kategori }}</span>
                <div class="flex gap-2">
                    <button onclick="editKategori({{ $kategori->id_kategori }}, '{{ $kategori->ket_kategori }}')" class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-all">
                        <i class="fas fa-edit"></i>
                    </button>
                    <form action="{{ route('admin.kategori.destroy', $kategori->id_kategori) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition-all">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <p class="text-center text-[#8B7355] py-4">Belum ada kategori</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function editKategori(id, nama) {
    const newNama = prompt('Edit nama kategori:', nama);
    if (newNama && newNama !== nama) {
        fetch("{{ route('admin.kategori.update', '__ID__') }}".replace('__ID__', id), {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ ket_kategori: newNama })
        }).then(() => location.reload());
    }
}
</script>
@endpush