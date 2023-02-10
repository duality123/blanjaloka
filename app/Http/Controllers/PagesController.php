<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Laporan;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
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
    public function panduan()
    {
        return Inertia::render('Panduan');
    }
    public function about()
    {
        return Inertia::render('Tentang_program');
    }
    public function laporkan(Request $request)
    {

        return Inertia::render('Tentang_program');
    }

    public function laporan_post(Request $request){
         $rules = [
            'email' => 'required|255',
            'isi'=>'required'
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
        $gambar ='';
        if($request->file('gambar')){
            $gambar = $foto_bisnis = $foto->store('admin/foto_laporan','public');
        }
        Laporan::create(['email'=>$request->post('email')
                        ,'pesan'=>$request->post('isi'),
                          'tanggal'=>now(),
                          'gambar'=>$gambar]);
        $get = User::where('id','=',$request->user()->id)->first();
        $admins = DB::table('roles')->select('user_id')->where('number','=',1)->get();
        if (!$request->user()->accepted) {
             foreach ($admins as $admin) {
                 $updateNotif =  DB::table('users')->select('notif_pesan')->where('id','=',$admin->user_id)->first();
                 $updateNotif = $updateNotif->notif_pesan+= 1;
                User::where('id','=',$admin->user_id)->update(['notif_pesan'=>$updateNotif]);

            }
        }
        $request->session()->flash('success','Laporan Berhasil Masuk !');
        return back();

    }
    public function laporan_all(Request $request){
        $get = User::where('id','=',$request->user()->id)->first();
        $get->update(['notif_pesan' => 0]);
        $data = Laporan::orderBy('tanggal','desc')->filter(['cari','tanda'])->paginate(10);
        return Inertia::render('Dashboard/Pesan',['items'=>$data]);
    }
     public function tandai(Request $request){
        $get = laporan::select('tandai','id')->where('id','=',$request->post('id'))->first();
        $get->update(['tandai'=> !$get->tandai]);
        return back();
    }

    public function hapus(Request $request){
        $data = Laporan::where('id',$request->post('id'))->delete();
        $request->session()->flash('success','Laporan berhasil dihapus !');
        return back();
    }

    public function syaratDanKetentuan()
    {
        return Inertia::render('SyaratDanKetentuan');
    }
}
