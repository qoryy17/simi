<?php

namespace App\Http\Controllers\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Authentication\AuthRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function authLogin(AuthRequest $request): RedirectResponse
    {
        $request->validated();
        $credentials = [
            'email' => htmlspecialchars($request->input('email')),
            'password' => htmlspecialchars($request->input('password')),
            'blokir' => 'T'
        ];

        // checking existing email, password and block before attempt login !
        $existingUser = User::where('email', $credentials['email'])->first();
        if (!$existingUser) {
            return redirect()->back()->with('error', 'Email tidak terdaftar !')->withInput();
        }

        if (!Hash::check($credentials['password'], $existingUser->password)) {
            return redirect()->back()->with('error', 'Password salah !')->withInput();
        }

        if ($existingUser->blokir == 'Y') {
            return redirect()->back()->with('error', 'Akun anda diblokir, Hubungi Superadministrator !')->withInput();
        }

        if (!Auth::attempt($credentials)) {
            return redirect()->back()->with('error', 'Login gagal periksa ulang email dan password anda !')->withInput();
        }

        Auth::login($existingUser, true);
        $request->session()->regenerate();
        return redirect()->route('dashboard.home');
    }

    public function authLogout(Request $request): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('autentifikasi.signin');
    }
}
