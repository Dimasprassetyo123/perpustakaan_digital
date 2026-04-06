<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PetugasBackendController extends Controller
{
    // 🔹 TAMPILKAN DATA
    public function index()
    {
        $data = Petugas::with('user')->get();
        return view('page.backend.petugas.index', compact('data'));
    }

    // 🔹 FORM TAMBAH
    public function create()
    {
        return view('page.backend.petugas.create');
    }

    // 🔹 SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'email' => 'required|email',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
        ]);

        // 🔥 BUAT USER LOGIN
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'petugas'
        ]);

        // 🔥 SIMPAN PETUGAS
        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'id_user' => $user->id_user // ✅ FIX
        ]);

        return redirect()->route('petugas.index')
            ->with('success', 'Data petugas berhasil ditambahkan!');
    }

    // 🔹 DETAIL
    public function show($id)
    {
        $data = Petugas::with('user')->findOrFail($id);
        return view('page.backend.petugas.show', compact('data'));
    }

    // 🔹 FORM EDIT
    public function edit($id)
    {
        $data = Petugas::with('user')->findOrFail($id);
        return view('page.backend.petugas.edit', compact('data'));
    }

    // 🔹 UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_petugas' => 'required',
            'email' => 'required|email',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
        ]);

        $petugas = Petugas::findOrFail($id);

        // 🔥 update data petugas
        $petugas->update([
            'nama_petugas' => $request->nama_petugas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'email' => $request->email,
        ]);

        // 🔥 update user (optional)
        if ($petugas->user) {
            $petugas->user->update([
                'username' => $request->username ?? $petugas->user->username,
            ]);

            // kalau password diisi, update
            if ($request->filled('password')) {
                $petugas->user->update([
                    'password' => Hash::make($request->password)
                ]);
            }
        }

        return redirect()->route('petugas.index')
            ->with('success', 'Data petugas berhasil diupdate!');
    }

    // 🔹 HAPUS
    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);

        // 🔥 hapus user login juga
        if ($petugas->user) {
            $petugas->user->delete();
        }

        $petugas->delete();

        return redirect()->route('petugas.index')
            ->with('success', 'Data petugas berhasil dihapus!');
    }
}
