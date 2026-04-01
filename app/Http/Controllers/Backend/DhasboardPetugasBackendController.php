<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DhasboardPetugasBackendController extends Controller
{
    public function index()
    {
        return view('page.backend.halamanPetugas.index');
    }
}
