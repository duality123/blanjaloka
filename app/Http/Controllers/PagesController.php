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

    public function verify()
    {
        return Inertia::render('EmailVerifikasi');
    }

    public function success()
    {
        return Inertia::render('VerifikasiSukses');
    }

    public function otp()
    {
        return Inertia::render('VerifikasiOTP');
    }
}