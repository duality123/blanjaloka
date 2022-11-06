<?php

namespace App\Http\Controllers\Umkm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Umkm/Dashboard/ProfileProduct/Index');
    }
}
