<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NonVerificatorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('autentifikasi.signin')->with('error', 'Silahkan login dulu !');
        }

        if (Auth::user()->blokir == 'Y') {
            Auth::logout();
            return redirect()->route('autentifikasi.signin')->with('error', 'Akun anda terblokir !');
        }

        if (Auth::user()->role == 'Verifikator') {
            return redirect()->route('dashboard.home')->with('error', 'Anda tidak dapat mengakses halaman ini !');
        }
        return $next($request);
    }
}
