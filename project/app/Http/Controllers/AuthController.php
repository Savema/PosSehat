<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {

            if (auth()->user()->role == 'admin') {
                return redirect('/dashboard');
            }

            if (auth()->user()->role == 'petugas') {
                return redirect('/dashboard');
            }

        } else {
            return back()->with('error', 'Email atau password salah');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Menghapus autentikasi user

        $request->session()->invalidate(); // Menghapus semua data session
        $request->session()->regenerateToken(); // Mencegah serangan CSRF

        return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
    }

}
