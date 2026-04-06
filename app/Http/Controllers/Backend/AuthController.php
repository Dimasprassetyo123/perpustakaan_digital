<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // ✅ FIX: Kalau sudah login, redirect langsung sesuai role
        if (Auth::check()) {
            $role = Auth::user()->role;
            if ($role === 'kepala') return redirect()->route('kepala');
            if ($role === 'petugas') return redirect()->route('petugas.dashboard');
        }

        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role'     => 'required|in:kepala,petugas', // ✅ FIX: validasi nilai role
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            // ✅ FIX: Regenerate session WAJIB setelah login
            // ini yang mencegah error 419 dan session conflict
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role !== $request->role) {
                Auth::logout();
                $request->session()->invalidate();       // ✅ FIX: hapus session lama
                $request->session()->regenerateToken();  // ✅ FIX: buat CSRF token baru
                return back()->with('error', 'Role tidak sesuai!');
            }

            if ($user->role === 'kepala') {
                return redirect()->route('kepala')
                    ->with('success', 'Selamat datang Kepala Perpustakaan!');
            }

            if ($user->role === 'petugas') {
                return redirect()->route('petugas.dashboard')
                    ->with('success', 'Selamat datang Petugas!');
            }

            Auth::logout();
            return back()->with('error', 'Role tidak dikenali');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();      // ✅ FIX: hapus semua data session
        $request->session()->regenerateToken(); // ✅ FIX: buat CSRF token baru
        return redirect('/login')->with('success', 'Berhasil logout!');
    }
}
