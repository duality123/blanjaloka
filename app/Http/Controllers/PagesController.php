<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PagesController extends Controller
{


    public function home(Request $request)
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
             return redirect('/investor/dashboard/profil_perusahaan');
        }
      }

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
