<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPustakawan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guard('web')->check()) {
            return redirect()->back();
        }
    
        // Periksa apakah user memiliki f_level 'Admin'
        if (auth()->guard('admin')->user()->f_level == 'Admin' || auth()->guard('admin')->user()->f_level == 'Pustakawan') {
            return $next($request);
        }
        // dd(auth()->guard('admin')->user());
        return redirect()->back();
    }
}
