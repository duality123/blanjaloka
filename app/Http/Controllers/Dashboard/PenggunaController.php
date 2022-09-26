<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function pesertaUMKM()
    {
        return inertia('Dashboard/Pengguna/Peserta');
    }
}
