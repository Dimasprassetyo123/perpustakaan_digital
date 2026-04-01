<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index()
    {
        $data = Buku::latest()->get();
        return view('page.backend.halamanBuku.index', compact('data'));
    }

    public function create()
    {
        return view('page.backend.halamanBuku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_buku' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|date',
            'stok' => 'required|integer',
            'kategori' => 'required',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $cover = null;

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover')->store('buku', 'public');
        }

        Buku::create([
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'cover' => $cover,
            'deskripsi_buku' => $request->deskripsi_buku,
        ]);

        return redirect()->route('buku.index')->with('success', 'Data berhasil ditambah');
    }

    // ✅ TAMBAHAN DETAIL
    public function show($id)
    {
        $data = Buku::findOrFail($id);
        return view('page.backend.halamanBuku.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Buku::findOrFail($id);
        return view('page.backend.halamanBuku.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Buku::findOrFail($id);

        $request->validate([
            'judul_buku' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|date',
            'stok' => 'required|integer',
            'kategori' => 'required',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('cover')) {

            if ($data->cover) {
                Storage::disk('public')->delete($data->cover);
            }

            $cover = $request->file('cover')->store('buku', 'public');
        } else {
            $cover = $data->cover;
        }

        $data->update([
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'cover' => $cover,
            'deskripsi_buku' => $request->deskripsi_buku,
        ]);

        return redirect()->route('buku.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = Buku::findOrFail($id);

        if ($data->cover) {
            Storage::disk('public')->delete($data->cover);
        }

        $data->delete();

        return redirect()->route('buku.index')->with('success', 'Data berhasil dihapus');
    }
}
