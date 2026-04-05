<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
<<<<<<< HEAD
use App\Models\InputAspirasi;
use App\Models\Kategori;
=======
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
<<<<<<< HEAD
    public function index(Request $request)
    {
        $query = InputAspirasi::with(['siswa', 'aspirasi.kategori']);

        if ($request->filled('kategori')) {
            $query->where('id_kategori', $request->kategori);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filled('status') && $request->status !== 'all') {
            if (in_array($request->status, ['Menunggu', 'Proses'])) {
                $query->whereHas('aspirasi', function($q) use ($request) {
                    $q->where('status', $request->status);
                });
            }
        } else {
            $query->whereHas('aspirasi', function($q) {
                $q->whereIn('status', ['Menunggu', 'Proses']);
            });
        }

        $aspirasis = $query->latest()->paginate(10);
        $kategoris = Kategori::all();

        // ✅ PAKAI ARRAY SYNTAX (lebih fleksibel)
        return view('admin.aspirasi.index', [
            'aspirasis' => $aspirasis,
            'kategoris' => $kategoris,
            'totalAspirasi' => InputAspirasi::count(),
            'menunggu' => Aspirasi::where('status', 'Menunggu')->count(),
            'diproses' => Aspirasi::where('status', 'Proses')->count(),
            'selesai' => Aspirasi::where('status', 'Selesai')->count()
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string|max:1000',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update($validated);

        return redirect()->back()->with('success', 'Status berhasil diupdate menjadi ' . $validated['status']);
    }

    public function show($id)
    {
        $aspirasi = InputAspirasi::with(['siswa', 'aspirasi.kategori'])
            ->where('id_pelaporan', $id)
            ->firstOrFail();
        
        if ($aspirasi->aspirasi && $aspirasi->aspirasi->is_read == 0) {
            $aspirasi->aspirasi->update(['is_read' => 1]);
        }
        
        // Generate ticket code
        $ticketCode = 'SK-' . strtoupper(substr($aspirasi->siswa->kelas, 0, 3)) . '-' . str_pad($aspirasi->id_pelaporan, 4, '0', STR_PAD_LEFT);
        
        return view('admin.aspirasi.show', compact('aspirasi', 'ticketCode'));
    }

    public function destroy($id)
    {
        $inputAspirasi = InputAspirasi::findOrFail($id);
        $aspirasi = Aspirasi::findOrFail($inputAspirasi->id_aspirasi);
        
        $aspirasi->delete();
        $inputAspirasi->delete();

        return back()->with('success', 'Data berhasil dihapus');
=======
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string|max:255',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update([
            'status' => $validated['status'],
            'feedback' => $validated['feedback'] ?? null,
        ]);

        return back()->with('success', 'Status berhasil diupdate');
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
    }
}