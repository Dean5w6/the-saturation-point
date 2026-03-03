<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    { 
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must log in first.');
        }
 
        if (auth()->user()->role !== 'admin') { 
            abort(403, 'Unauthorized action. Admins only.');
        }
 
        if (!auth()->user()->is_active) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Your account has been deactivated.');
        }

        return $next($request);
    }
}
