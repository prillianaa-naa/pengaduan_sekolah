<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('siswa')->check()) {
            return redirect()->route('siswa.login');
        }
        
        return $next($request);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
