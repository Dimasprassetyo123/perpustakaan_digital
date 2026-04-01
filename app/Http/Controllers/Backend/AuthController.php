<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        // validasi
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // cek role
            if ($user->role !== $request->role) {
                Auth::logout();
                return back()->with('error', 'Role tidak sesuai!');
            }

            // redirect sesuai role
            if ($user->role === 'kepala') {
                return redirect()->route('kepala');
            }

            if ($user->role === 'petugas') {
                return redirect()->route('petugas');
            }

            // fallback
            Auth::logout();
            return back()->with('error', 'Role tidak dikenali');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
