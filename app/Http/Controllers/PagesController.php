<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PagesController extends Controller
{
    public function home()
    {
        return Inertia::render('Home');
    }

    public function kebijakanPrivasi()
    {
        return Inertia::render('KebijakanPrivasi');
    }

    public function syaratDanKetentuan()
    {
        return Inertia::render('SyaratDanKetentuan');
    }
}
