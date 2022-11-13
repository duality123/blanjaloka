<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index(Request $request)
    {
      if(Auth::check()){
        if ($request->user()->Role->number==1) {
           return redirect('/admin/dashboard');
        }
        else{
             return redirect('/umkm/dashboard');
        }
        
      }

        return Inertia::render('Home');
    }
}
