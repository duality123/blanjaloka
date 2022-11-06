<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KegiatanController extends Controller
{
    public function index()
    {
        return Inertia::render('Umkm/Dashboard/Kegiatan/Index');
    }

    public function show()
    {
        return Inertia::render('Umkm/Dashboard/Kegiatan/Show');
    }
}
