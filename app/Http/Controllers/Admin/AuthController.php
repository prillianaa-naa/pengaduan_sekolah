<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

   public function logout(Request $request)
    {
        // Logout guard admin
        auth()->guard('admin')->logout();
        
        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // ✅ REDIRECT KE LOGIN ADMIN
        return redirect()->route('admin.login')
                        ->with('success', 'Anda telah logout.');
    }
}