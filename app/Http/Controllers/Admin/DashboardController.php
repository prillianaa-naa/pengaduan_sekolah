<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalAspirasi = InputAspirasi::count();
        $menunggu = Aspirasi::where('status', 'Menunggu')->count();
        $proses = Aspirasi::where('status', 'Proses')->count();
        $selesai = Aspirasi::where('status', 'Selesai')->count();

<<<<<<< HEAD
        $aspirasis = InputAspirasi::with(['siswa', 'aspirasi'])
            ->whereHas('aspirasi', function($q) {
                $q->where('is_read', 0); // ✅ Filter hanya yang belum dibaca
            })
            ->latest()
            ->take(5)
            ->get();
=======
        $aspirasis = InputAspirasi::with(['siswa', 'aspirasi.kategori'])
            ->latest()
            ->paginate(10);
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalAspirasi',
            'menunggu',
            'proses',
            'selesai',
            'aspirasis'
        ));
    }
}