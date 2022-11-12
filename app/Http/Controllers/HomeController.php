<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
      if(Auth::check()){
        return redirect('/admin/dashboard');
      }
        return Inertia::render('Home');
    }
}
