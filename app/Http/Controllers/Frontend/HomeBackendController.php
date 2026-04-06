<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;

class HomeBackendController extends Controller
{
    public function index()
    {
        $buku = Buku::latest()->get();

        return view('page.frondend.home.index', compact('buku'));
    }

    public function detail($id)
    {
        $buku = Buku::findOrFail($id);

        return view('page.frondend.detaile.detaile', compact('buku'));
    }
}
