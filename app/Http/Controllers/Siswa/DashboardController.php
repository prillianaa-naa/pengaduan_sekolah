<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = Auth::guard('siswa')->user();
        
        // ✅ Gunakan paginate() agar method pagination tersedia
        $aspirasis = InputAspirasi::where('nis', $siswa->nis)
            ->with(['aspirasi.kategori'])
            ->latest()
            ->paginate(10);  // ← 10 item per halaman

        return view('siswa.dashboard', compact('aspirasis'));
    }
}