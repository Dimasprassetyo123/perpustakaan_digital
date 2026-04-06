<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Petugas;

class DhasboardPetugasBackendController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalPetugas = Petugas::count();

        return view('page.backend.halamanPetugas.index', compact('totalBuku', 'totalPetugas'));
    }
}
