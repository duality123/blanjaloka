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
        elseif  ($request->user()->Role->number==2) {
             return redirect('/umkm/dashboard');
        }
        elseif ($request->user()->Role->number==3)
         {
             return redirect('/investor/profil_perusahaan');
        }
      }

        return Inertia::render('Home');
    }
}
