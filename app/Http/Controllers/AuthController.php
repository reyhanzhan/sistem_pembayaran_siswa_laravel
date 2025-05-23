<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['name' => $credentials['name'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            // Arahkan berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('siswa.index');
            } elseif (Auth::user()->role === 'kepsek') {
                return redirect()->route('lihat-tagihan.index');
            }

            // Fallback jika role tidak dikenali
            return redirect()->route('siswa.index');
        }

        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
        ])->onlyInput('name');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}