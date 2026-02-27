<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Aspirasi;
use App\Models\InputAspirasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = Auth::guard('siswa')->user();
        $aspirasis = InputAspirasi::where('nis', $siswa->nis)
            ->with(['aspirasi.kategori'])
            ->latest()
            ->get();

        return view('siswa.dashboard', compact('aspirasis'));
    }
}