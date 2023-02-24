<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Janjitemu;
use Illuminate\Database\Eloquent\Builder;
class DashboardController extends Controller
{

    public function index(Request $request ){
        $data = Janjitemu::with(['investor.profil:id,nama_lengkap,foto_profil,user_id','umkm.profil:id,nama_lengkap,foto_profil,user_id'])->filter(request(['nama_investor','lokasi','nama_umkm','event_dimulai','event_berakhir','berakhir']))->orderBy('berakhir','asc')
            ->paginate(10);

            
        
        return inertia::render('Dashboard/Index',['items'=>$data]);
    }

}
