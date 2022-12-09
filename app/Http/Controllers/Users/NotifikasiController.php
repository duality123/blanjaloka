<?php

namespace App\Http\Controllers\Users;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class NotifikasiController extends Controller
{
    public function show(Request $request,$role,$slug)
    {   
        $get = User::where('id','=',$request->user()->id)->update(['notifikasi' => 0]);
        $data = Notifikasi::fetchAndPaginate($request->user()->id,100,$slug);
        $view = 'Profil/'.$role.'/Notifikasi';
        return Inertia::render($view,['items'=>$data['items']]);
      
    }

    public function delete($id){
        Notifikasi::deleteNotif($id);
        return back();
    }


}
