<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        return Inertia::render('Umkm/Profile');
    }

    public function notifikasi()
    {
        return Inertia::render('Umkm/Notifikasi');
    }
}
