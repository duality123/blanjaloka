<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function index()
    {
        return Inertia::render('Umkm/Account/Index');
    }

    public function notifikasi()
    {
        return Inertia::render('Umkm/Account/Notifikasi');
    }
}
