@extends('admin.layouts.app')

@section('title', 'Data Siswa')

@push('styles')
<style>
/* ===== WARNA SOLID - NO GRADIENT ===== */
:root {
    --primary: #A87B6E;
    --primary-hover: #8B6F5E;
    --blue: #3B82F6;
    --blue-hover: #2563EB;
    --green: #10B981;
    --red: #DC2626;
    --bg-light: #F9F7F5;
    --border: #E8DDD5;
    --text: #5D4E45;
    --text-muted: #8B7355;
}

/* ===== Layout ===== */
.page-header { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
.page-icon {
    width: 3rem; height: 3rem; background: var(--blue);
    border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;
    color: white; font-size: 1.5rem;
}
.page-title { font-size: 1.875rem; font-weight: 700; color: var(--text); }

/* ===== Card ===== */
.card { background: white; border-radius: 1rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05); overflow: hidden; }
.card-header {
    padding: 1.5rem; border-bottom: 1px solid var(--border);
    display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;
}
.card-title { font-size: 1.25rem; font-weight: 700; color: var(--text); }

/* ===== Button ===== */
.btn {
    display: inline-flex; align-items: center; gap: 0.5rem;
    padding: 0.625rem 1.25rem; border-radius: 0.75rem;
    font-weight: 600; font-size: 0.875rem; border: none; cursor: pointer;
}
.btn-primary { background: var(--primary); color: white; }
.btn-primary:hover { background: var(--primary-hover); }

/* ===== Table ===== */
.table-wrap { overflow-x: auto; }
.data-table { width: 100%; border-collapse: collapse; }
.data-table thead { background: var(--bg-light); }
.data-table th {
    padding: 1rem 1.5rem; text-align: left;
    font-size: 0.875rem; font-weight: 600; color: var(--text);
    border-bottom: 2px solid var(--border);
}
.data-table th.center { text-align: center; }
.data-table td {
    padding: 1rem 1.5rem; font-size: 0.875rem; color: var(--text);
    border-bottom: 1px solid var(--border);
}
.data-table td.center { text-align: center; }
.data-table tr:hover { background: #FAF7F5; }

/* ===== Action Buttons ===== */
.actions { display: flex; align-items: center; justify-content: center; gap: 0.5rem; }
.btn-action {
    width: 2rem; height: 2rem; border-radius: 0.5rem;
    display: inline-flex; align-items: center; justify-content: center;
    font-size: 0.875rem; border: none; cursor: pointer;
}
.btn-edit { background: #DBEAFE; color: var(--blue); }
.btn-edit:hover { background: var(--blue); color: white; }
.btn-delete { background: #FEE2E2; color: var(--red); }
.btn-delete:hover { background: var(--red); color: white; }

/* ===== Empty State ===== */
.empty { padding: 3rem 1.5rem; text-align: center; color: var(--text-muted); }
.empty-icon {
    width: 5rem; height: 5rem; background: var(--bg-light);
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    color: var(--primary); font-size: 1.875rem; margin: 0 auto 1rem;
}

/* ===== Modal ===== */
.modal {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,0.5); z-index: 9999;
    align-items: center; justify-content: center; padding: 1rem;
}
.modal.show { display: flex; }
.modal-box {
    background: white; border-radius: 1rem; padding: 2rem;
    width: 100%; max-width: 450px;
}
.modal-title { font-size: 1.5rem; font-weight: 700; color: var(--text); margin-bottom: 1.5rem; }
.form-group { margin-bottom: 1.25rem; }
.form-label { display: block; font-size: 0.875rem; font-weight: 600; color: var(--text); margin-bottom: 0.5rem; }
.form-input {
    width: 100%; padding: 0.75rem 1rem; border: 2px solid var(--border);
    border-radius: 0.75rem; font-size: 0.875rem; background: var(--bg-light);
}
.form-input:focus { outline: none; border-color: var(--primary); background: white; }
.modal-footer { display: flex; gap: 0.75rem; margin-top: 2rem; }
.btn-cancel {
    flex: 1; padding: 0.75rem; background: var(--border);
    color: var(--text); border: none; border-radius: 0.75rem; font-weight: 600; cursor: pointer;
}
.btn-save {
    flex: 1; padding: 0.75rem; background: var(--primary);
    color: white; border: none; border-radius: 0.75rem; font-weight: 600; cursor: pointer;
}
.btn-save:hover { background: var(--primary-hover); }

/* Loading */
.loading {
    position: fixed; inset: 0; background: rgba(255,255,255,0.9);
    display: none; align-items: center; justify-content: center;
    z-index: 10000; font-weight: 600; color: var(--primary);
}
.loading.show { display: flex; }

@media (max-width: 768px) {
    .page-header, .card-header { flex-direction: column; align-items: flex-start; }
    .data-table { font-size: 0.75rem; }
    .data-table th, .data-table td { padding: 0.75rem 1rem; }
    .actions { flex-direction: column; }
}
</style>
@endpush

@section('content')
<!-- Header -->
<div class="page-header">
    <div class="page-icon"><i class="fas fa-users"></i></div>
    <h1 class="page-title">Data Siswa</h1>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
    </div>
@endif

<!-- Card -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Daftar Siswa</h2>
        <button class="btn btn-primary" onclick="openModal()">
            <i class="fas fa-plus"></i> Tambah
        </button>
    </div>

    <!-- Table -->
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="w-16">No.</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th class="w-32 center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $i => $s)
                <tr>
                    <td>{{ $siswas->firstItem() + $i }}</td>
                    <td>{{ $s->nis }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->kelas }}</td>
                    <td class="center">
                        <div class="actions">
                            <!-- ✏️ EDIT: Buka Modal -->
                            <button class="btn-action btn-edit" 
                                    onclick="openModal({{ $s->id }}, '{{ addslashes($s->nis) }}', '{{ addslashes($s->nama) }}', '{{ addslashes($s->kelas) }}')"
                                    title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <!-- 🗑️ DELETE: AJAX -->
                            <button class="btn-action btn-delete" 
                                    onclick="deleteSiswa({{ $s->id }}, '{{ addslashes($s->nama) }}')"
                                    title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty">
                        <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                        <h3>Belum Ada Data</h3>
                        <p>Klik "Tambah" untuk menambahkan siswa</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($siswas->hasPages())
    <div class="card-header border-t" style="border-color: var(--border);">
        {{ $siswas->links() }}
    </div>
    @endif
</div>

<!-- Modal (1 untuk Tambah & Edit) -->
<div id="modal" class="modal">
    <div class="modal-box">
        <h3 class="modal-title" id="mTitle">Tambah Siswa</h3>
        <form id="mForm">
            @csrf
            <input type="hidden" id="mId">
            
            <div class="form-group">
                <label class="form-label">NIS</label>
                <input type="text" id="mNis" name="nis" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" id="mNama" name="nama" class="form-input" required>
            </div>
            <div class="form-group">
    <label class="form-label">Kelas</label>
    <input type="text" name="kelas" id="mKelas" class="form-input" placeholder="Contoh: X IPA 1" maxlength="50" required>
</div>
            <div class="form-group" id="passGroup">
                <label class="form-label">Password</label>
                <input type="password" id="mPass" name="password" class="form-input" placeholder="Min. 6 karakter">
                <small style="color: var(--text-muted); font-size: 0.75rem;" id="passHint">* Wajib untuk tambah siswa</small>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Loading Overlay -->
<div id="loading" class="loading">
    <i class="fas fa-spinner fa-spin mr-2"></i> Memproses...
</div>
@endsection

@push('scripts')
<script>
// ===== ELEMENTS =====
const modal = document.getElementById('modal');
const loading = document.getElementById('loading');
const mForm = document.getElementById('mForm');
const mTitle = document.getElementById('mTitle');
const mId = document.getElementById('mId');
const mNis = document.getElementById('mNis');
const mNama = document.getElementById('mNama');
const mKelas = document.getElementById('mKelas');
const mPass = document.getElementById('mPass');
const passGroup = document.getElementById('passGroup');
const passHint = document.getElementById('passHint');

// ===== CSRF Token Helper =====
function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content 
        || document.querySelector('[name="_token"]')?.value 
        || '';
}

// ===== MODAL: Buka (Tambah / Edit) =====
function openModal(id = null, nis = '', nama = '', kelas = '') {
    // Reset form
    mForm.reset();
    
    if (id) {
        // MODE EDIT
        mTitle.textContent = 'Edit Siswa';
        mId.value = id;
        mNis.value = nis;
        mNama.value = nama;
        mKelas.value = kelas;
        mPass.required = false;
        passHint.textContent = '* Kosongkan jika tidak diubah';
        passGroup.style.display = 'block';
    } else {
        // MODE TAMBAH
        mTitle.textContent = 'Tambah Siswa';
        mId.value = '';
        mPass.required = true;
        passHint.textContent = '* Wajib untuk tambah siswa';
        passGroup.style.display = 'block';
    }
    modal.classList.add('show');
}

// ===== MODAL: Tutup =====
function closeModal() {
    modal.classList.remove('show');
}

// Close on outside click / Escape
modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

// ===== LOADING =====
function showLoading(show) {
    loading.classList.toggle('show', show);
}

// ===== AJAX: SUBMIT FORM (Tambah / Edit) =====
mForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    showLoading(true);
    
    const id = mId.value;
    const url = id ? `/admin/siswa/${id}` : '/admin/siswa';
    const method = id ? 'PUT' : 'POST';
    
    const data = {
        _token: getCsrfToken(),
        nis: mNis.value.trim(),
        nama: mNama.value.trim(),
        kelas: mKelas.value.trim(),
    };
    
    // Password: wajib untuk tambah, opsional untuk edit
    if (mPass.value || !id) {
        data.password = mPass.value;
    }
    
    try {
        const res = await fetch(url, {
            method: method,
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(data)
        });
        
        if (res.ok) {
            closeModal();
            location.reload(); // Reload untuk update tabel
        } else {
            const err = await res.json().catch(() => ({}));
            alert('Error: ' + (err.message || err.error || 'Gagal menyimpan data'));
        }
    } catch (err) {
        console.error(err);
        alert('Terjadi kesalahan koneksi!');
    } finally {
        showLoading(false);
    }
});

// ===== AJAX: DELETE =====
async function deleteSiswa(id, nama) {
    if (!confirm(`Yakin hapus "${nama}"?`)) return;
    
    showLoading(true);
    
    try {
        const res = await fetch(`/admin/siswa/${id}`, {
            method: 'DELETE',
            headers: { 
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken()
            }
        });
        
        if (res.ok) {
            location.reload();
        } else {
            alert('Gagal menghapus data!');
        }
    } catch (err) {
        console.error(err);
        alert('Error koneksi!');
    } finally {
        showLoading(false);
    }
}
</script>
@endpush