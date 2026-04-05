<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
=======
use App\Models\Aspirasi;
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
use App\Models\InputAspirasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = Auth::guard('siswa')->user();
<<<<<<< HEAD
        
        // ✅ Gunakan paginate() agar method pagination tersedia
        $aspirasis = InputAspirasi::where('nis', $siswa->nis)
            ->with(['aspirasi.kategori'])
            ->latest()
            ->paginate(10);  // ← 10 item per halaman
=======
        $aspirasis = InputAspirasi::where('nis', $siswa->nis)
            ->with(['aspirasi.kategori'])
            ->latest()
            ->get();
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475

        return view('siswa.dashboard', compact('aspirasis'));
    }
}