<?php

namespace App\Http\Controllers\Users;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
class NotifikasiController extends Controller
{
    public function show(Request $request)
    {   
        $get = User::where('id','=',$request->user()->id)->first();
        $get->update(['notifikasi' => 0]);
        $data = Notifikasi::where('user_id','=',$request->user()->id)
        ->filter(request(['cari','tanda']))
        ->orderBy('tanggal','desc')->paginate(10);
      
        if ($get->Role->number==1) {
             $view = 'Profil/admin/Notifikasi';
        }
        elseif ($get->Role->number==2) {
             $view = 'Profil/UMKM/Notifikasi';
        }
        else{
             $view = 'Profil/Investor/Notifikasi';
        }
        
        return Inertia::render($view,['items'=>$data]);
      
    }

      public function delete(Request $request){
        $target = Notifikasi::where('id','=',$request->post('id'))->delete();
        $request->session()->flash('success','Notifikasi berhasil dihapus');
        return back();
    }

      public function tandai_notif(Request $request){
        

        if ($request->post('id')== null) {
            $request->session()->flash('error','harap tandai dulu notifikasi anda');
            return back();
        }    
        $targets = Notifikasi::whereIn('id',$request->post('id'))->get();
        foreach ($targets as $target) {
           

            if ($target->tandai) {
                 $target->update(['tandai'=>false]);
            }
            else{
                $target->update(['tandai'=>true]);
            }
        }
            
        
       
        $request->session()->flash('success','Notifikasi berhasil ditandai');
        return back();
    }


}
