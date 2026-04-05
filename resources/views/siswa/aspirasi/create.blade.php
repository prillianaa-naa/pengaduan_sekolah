@extends('siswa.layouts.app')

@section('title', 'Ajukan Aspirasi')

<style>
.form-container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    padding: 2.5rem;
    border-radius: 1.5rem;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
}
.form-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1E293B;
    margin-bottom: 2rem;
}
.form-group {
    margin-bottom: 1.75rem;
}
.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 0.625rem;
}
.form-input,
.form-select,
.form-textarea,
.form-file {
    width: 100%;
    padding: 0.875rem 1.125rem;
    border: 1.5px solid #E2E8F0;
    border-radius: 0.875rem;
    font-size: 0.875rem;
    transition: all 0.3s;
    background: #F8FAFC;
}
.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    outline: none;
    border-color: #A87B6E;
    background: white;
    box-shadow: 0 0 0 4px rgba(168, 123, 110, 0.1);
}
.form-textarea {
    resize: vertical;
    min-height: 140px;
}
.form-file {
    padding: 0.75rem;
    cursor: pointer;
}
.form-hint {
    font-size: 0.8rem;
    color: #94A3B8;
    margin-top: 0.375rem;
}
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #E2E8F0;
}
.btn {
    padding: 0.875rem 2rem;
    border-radius: 0.875rem;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.btn-cancel {
    background: #E2E8F0;
    color: #475569;
}
.btn-cancel:hover {
    background: #CBD5E1;
    transform: translateY(-1px);
}
.btn-submit {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}
.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}
.alert {
    padding: 1rem 1.25rem;
    border-radius: 0.875rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}
.alert-error {
    background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
    border: 1px solid #FCA5A5;
    color: #991B1B;
}
.alert-success {
    background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
    border: 1px solid #6EE7B7;
    color: #065F46;
}
.alert ul {
    margin: 0;
    padding-left: 1.25rem;
}
.alert i {
    margin-top: 0.125rem;
}
.file-preview {
    margin-top: 0.75rem;
    padding: 0.75rem;
    background: #F1F5F9;
    border-radius: 0.5rem;
    display: none;
}
.file-preview.show {
    display: block;
}
.file-preview img {
    max-width: 200px;
    border-radius: 0.5rem;
    margin-top: 0.5rem;
}
</style>

@section('content')
<div class="form-container">
    <h1 class="form-title">Form Pengajuan Aspirasi</h1>

    @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('siswa.aspirasi.store') }}" method="POST" enctype="multipart/form-data" class="aspirasi-form">
        @csrf
        
        <!-- Judul Aspirasi -->
        <div class="form-group">
            <label class="form-label">Judul Aspirasi</label>
            <input 
                type="text" 
                name="judul" 
                class="form-input" 
                placeholder="Contoh: Kipas angin rusak" 
                value="{{ old('judul') }}"
                required
            >
        </div>

        <!-- Kategori Pengaduan -->
        <div class="form-group">
            <label class="form-label">Kategori Pengaduan</label>
            <select name="id_kategori" class="form-select" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                        {{ $kategori->ket_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Lokasi -->
        <div class="form-group">
            <label class="form-label">Lokasi</label>
            <input 
                type="text" 
                name="lokasi" 
                class="form-input" 
                placeholder="Contoh: Ruang Kelas X IPA 1" 
                value="{{ old('lokasi') }}"
                required
            >
        </div>

        <!-- Prioritas -->
        <div class="form-group">
            <label class="form-label">Prioritas</label>
            <select name="prioritas" class="form-select" required>
                <option value="Rendah" {{ old('prioritas') == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                <option value="Sedang" {{ old('prioritas') == 'Sedang' ? 'selected' : '' }} selected>Sedang</option>
                <option value="Tinggi" {{ old('prioritas') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
            </select>
        </div>

        <!-- Keterangan -->
        <div class="form-group">
            <label class="form-label">Keterangan</label>
            <textarea 
                name="ket" 
                class="form-textarea" 
                placeholder="Jelaskan detail pengaduan Anda..." 
                rows="5"
                required
            >{{ old('ket') }}</textarea>
        </div>

        <!-- Upload Foto (Opsional) -->
        <div class="form-group">
            <label class="form-label">Upload Foto (Opsional)</label>
            <input 
                type="file" 
                name="foto" 
                class="form-file" 
                accept="image/*"
                id="fotoInput"
                onchange="previewImage(this)"
            >
            <p class="form-hint"><i class="fas fa-info-circle"></i> Format: JPG, PNG, JPEG (Maks. 2MB)</p>
            <div id="filePreview" class="file-preview"></div>
        </div>

        <!-- Buttons -->
        <div class="form-actions">
            <a href="{{ route('siswa.dashboard') }}" class="btn btn-cancel">
                <i class="fas fa-times"></i> Batal
            </a>
            <button type="submit" class="btn btn-submit">
                <i class="fas fa-paper-plane"></i> Kirim Aspirasi
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('filePreview');
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const reader = new FileReader();
        
        // Validasi file
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        const maxSize = 2 * 1024 * 1024; // 2MB
        
        if (!allowedTypes.includes(file.type)) {
            alert('Format file tidak diizinkan. Gunakan JPG, JPEG, atau PNG.');
            input.value = '';
            preview.classList.remove('show');
            return;
        }
        
        if (file.size > maxSize) {
            alert('Ukuran file terlalu besar. Maksimal 2MB.');
            input.value = '';
            preview.classList.remove('show');
            return;
        }
        
        reader.onload = function(e) {
            preview.innerHTML = `
                <div class="font-semibold text-sm text-gray-700 mb-2">
                    <i class="fas fa-image"></i> ${file.name}
                </div>
                <img src="${e.target.result}" alt="Preview" class="rounded-lg">
            `;
            preview.classList.add('show');
        }
        
        reader.readAsDataURL(file);
    } else {
        preview.classList.remove('show');
    }
}
</script>
@endpush