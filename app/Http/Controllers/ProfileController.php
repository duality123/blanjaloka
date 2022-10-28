<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        return Inertia::render('Profile/Index');
    }

    public function changePassword()
    {
        return Inertia::render('Profile/ChangePassword');
    }

    public function changeEmail()
    {
        return Inertia::render('Profile/ChangeEmail');
    }
}
