<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('siswa.auth.login');
    }

    public function showRegisterForm()
    {
        return view('siswa.auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:siswas,nis',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:10',
            'password' => 'required|min:6|confirmed',
        ]);

        Siswa::create([
            'nis' => $validated['nis'],
            'nama' => $validated['nama'],
            'kelas' => $validated['kelas'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('siswa.login')->with('success', 'Registrasi berhasil, silakan login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nis' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('siswa')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/siswa/dashboard');
        }

        return back()->withErrors([
            'nis' => 'NIS atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('siswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('siswa.login');
    }
}