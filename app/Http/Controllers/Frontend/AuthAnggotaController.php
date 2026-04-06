<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Anggota;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthAnggotaController extends Controller
{
    // 🔹 FORM LOGIN
    public function login()
    {
        return view('auth.frontend.login');
    }

    // 🔹 PROSES LOGIN
    public function loginPost(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {

            $anggota = Anggota::where('id_user', Auth::user()->id_user)->first();

            session(['anggota' => $anggota]);

            return redirect()->route('frontend.home');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    // 🔹 FORM REGISTER
    public function register()
    {
        return view('auth.frontend.register');
    }

    // 🔹 PROSES REGISTER
    public function registerPost(Request $request)
    {
        $request->validate([
            'nama_anggota'   => 'required',
            'username'       => 'required|unique:users,username',
            'password'       => 'required|min:3',
            'jenis_kelamin'  => 'required',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // 🔥 upload foto
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/anggota'), $filename);
        } else {
            $filename = null;
        }

        // 🔥 buat user
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => 'anggota'
        ]);

        // 🔥 buat anggota
        Anggota::create([
            'nama_anggota'  => $request->nama_anggota,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat'        => $request->alamat,
            'image'         => $filename,
            'id_user'       => $user->id_user,
        ]);

        return redirect()->route('anggota.login')->with('success', 'Registrasi berhasil!');
    }

    // 🔹 LOGOUT
    public function logout()
    {
        Auth::logout();
        session()->forget('anggota');

        return redirect()->route('anggota.login');
    }
}
