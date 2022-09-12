<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticatedController extends Controller
{
    public function auth_page()
    {
        return view('authenticated_page');
    }
}
