<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AspirasiController extends Controller
{
    public function create()
    {
        $kategoris = Kategori::all();
        return view('siswa.aspirasi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:100',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'lokasi' => 'required|string|max:100',
            'prioritas' => 'required|in:Rendah,Sedang,Tinggi',
            'ket' => 'required|string|max:1000',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $siswa = Auth::guard('siswa')->user();
        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('aspirasi-foto', 'public');
        }

        DB::beginTransaction();
        
        try {
            $aspirasi = Aspirasi::create([
                'id_kategori' => $validated['id_kategori'],
                'status' => 'Menunggu',
                'feedback' => null,
                'prioritas' => $validated['prioritas'],
            ]);

            InputAspirasi::create([
                'nis' => $siswa->nis,
                'id_kategori' => $validated['id_kategori'],
                'lokasi' => $validated['lokasi'],
                'ket' => $validated['ket'],
                'id_aspirasi' => $aspirasi->id_aspirasi,
                'judul' => $validated['judul'],
                'foto' => $fotoPath,
                'prioritas' => $validated['prioritas'],
            ]);

            DB::commit();
            return redirect()->route('siswa.dashboard')->with('success', 'Aspirasi berhasil dikirim!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            if ($fotoPath && Storage::exists('public/' . $fotoPath)) {
                Storage::delete('public/' . $fotoPath);
            }
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show detail aspirasi
     */
    public function show($id)
    {
        $siswa = Auth::guard('siswa')->user();
        
        $aspirasi = InputAspirasi::with(['siswa', 'aspirasi.kategori'])
            ->where('id_pelaporan', $id)
            ->where('nis', $siswa->nis) // Hanya bisa lihat punya sendiri
            ->firstOrFail();

        // Generate ticket code untuk ditampilkan
        $ticketCode = 'SK-' . strtoupper(substr($aspirasi->siswa->kelas, 0, 3)) . '-' . str_pad($aspirasi->id_pelaporan, 4, '0', STR_PAD_LEFT);

        return view('siswa.aspirasi.show', compact('aspirasi', 'ticketCode'));
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $siswa = Auth::guard('siswa')->user();
        $kategoris = Kategori::all();
        
        $aspirasi = InputAspirasi::with('aspirasi')
            ->where('id_pelaporan', $id)
            ->where('nis', $siswa->nis)
            ->whereHas('aspirasi', function($q) {
                $q->where('status', 'Menunggu'); // Hanya bisa edit jika masih menunggu
            })
            ->firstOrFail();

        return view('siswa.aspirasi.edit', compact('aspirasi', 'kategoris'));
    }

    /**
     * Update aspirasi
     */
    public function update(Request $request, $id)
    {
        $siswa = Auth::guard('siswa')->user();
        
        $aspirasi = InputAspirasi::with('aspirasi')
            ->where('id_pelaporan', $id)
            ->where('nis', $siswa->nis)
            ->firstOrFail();

        // Cek apakah masih bisa diedit
        if ($aspirasi->aspirasi->status != 'Menunggu') {
            return back()->with('error', 'Pengaduan tidak dapat diedit karena sudah diproses');
        }

        // ✅ Validasi dulu sebelum pakai $validated
        $validated = $request->validate([
            'judul' => 'required|string|max:100',
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'lokasi' => 'required|string|max:100',
            'prioritas' => 'required|in:Rendah,Sedang,Tinggi',
            'ket' => 'required|string|max:1000',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = $aspirasi->foto;

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            if ($fotoPath && Storage::exists('public/' . $fotoPath)) {
                Storage::delete('public/' . $fotoPath);
            }
            $fotoPath = $request->file('foto')->store('aspirasi-foto', 'public');
        }

        // ✅ Update input_aspirasis
        $aspirasi->update([
            'judul' => $validated['judul'],
            'id_kategori' => $validated['id_kategori'],
            'lokasi' => $validated['lokasi'],
            'ket' => $validated['ket'],
            'foto' => $fotoPath,
        ]);

        // ✅ Update tabel aspirasis terkait
        $aspirasi->aspirasi->update([
            'id_kategori' => $validated['id_kategori'],
            'prioritas' => $validated['prioritas'],
        ]);

        return redirect()->route('siswa.aspirasi.show', $id)
            ->with('success', 'Pengaduan berhasil diperbarui!');
    }

    /**
     * Delete aspirasi
     */
    public function destroy($id)
    {
        $siswa = Auth::guard('siswa')->user();
        
        $aspirasi = InputAspirasi::with('aspirasi')
            ->where('id_pelaporan', $id)
            ->where('nis', $siswa->nis)
            ->firstOrFail();

        // Hanya bisa hapus jika masih menunggu
        if ($aspirasi->aspirasi->status != 'Menunggu') {
            return back()->with('error', 'Pengaduan tidak dapat dihapus karena sudah diproses');
        }

        // Hapus foto jika ada
        if ($aspirasi->foto && Storage::exists('public/' . $aspirasi->foto)) {
            Storage::delete('public/' . $aspirasi->foto);
        }

        // Hapus data aspirasi terkait
        $aspirasi->aspirasi->delete();
        $aspirasi->delete();

        return redirect()->route('siswa.dashboard')->with('success', 'Pengaduan berhasil dihapus!');
    }
}