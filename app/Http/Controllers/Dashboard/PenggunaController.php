<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function admin()
    {
        return inertia('Dashboard/Pengguna/Admin');
    }
}
