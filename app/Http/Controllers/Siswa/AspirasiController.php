<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AspirasiController extends Controller
{
    public function create()
    {
        // ✅ Ambil semua kategori dari database
        $kategoris = Kategori::all();
        
        // ✅ Kirim variabel $kategoris ke view
        return view('siswa.aspirasi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategoris,id_kategori',
            'lokasi' => 'required|string|max:50',
            'ket' => 'required|string|max:50',
        ]);

        $siswa = Auth::guard('siswa')->user();

        DB::beginTransaction();
        try {
            // Create aspirasi
            $aspirasi = Aspirasi::create([
                'id_kategori' => $validated['id_kategori'],
                'status' => 'Menunggu',
            ]);

            // Create input aspirasi
            InputAspirasi::create([
                'nis' => $siswa->nis,
                'id_kategori' => $validated['id_kategori'],
                'lokasi' => $validated['lokasi'],
                'ket' => $validated['ket'],
                'id_aspirasi' => $aspirasi->id_aspirasi,
            ]);

            DB::commit();

            return redirect()->route('siswa.dashboard')->with('success', 'Aspirasi berhasil diajukan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}