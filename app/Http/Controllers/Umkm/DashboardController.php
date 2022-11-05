<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Umkm/Dashboard/Index');
    }

    public function kegiatanku()
    {
        return Inertia::render('Umkm/Dashboard/Kegiatanku');
    }
}
