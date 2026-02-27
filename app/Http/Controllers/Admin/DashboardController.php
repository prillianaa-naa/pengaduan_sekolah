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

        $aspirasis = InputAspirasi::with(['siswa', 'aspirasi.kategori'])
            ->latest()
            ->paginate(10);

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