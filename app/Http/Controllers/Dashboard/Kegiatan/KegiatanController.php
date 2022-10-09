<?php

namespace App\Http\Controllers\Dashboard\Kegiatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KegiatanController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Kegiatan/Index');
    }

    public function create()
    {
        return Inertia::render('Dashboard/Kegiatan/Create');
    }
}
