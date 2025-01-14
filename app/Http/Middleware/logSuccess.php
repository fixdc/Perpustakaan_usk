<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class logSuccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    if (auth()->guard('web')->user() || auth()->guard('admin')->user()) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Silahkan login terlebih dahulu');
    }
}
