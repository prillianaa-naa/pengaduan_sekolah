<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
        
        return $next($request);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 722639d6daabffc6f303b1c182c07a331f2f6475
