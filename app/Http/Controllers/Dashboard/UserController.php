<?php

namespace App\Http\Controllers\Dashboard;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function all(Request $request,$role)
    {
        $datas = DB::table('roles')->select('user_id')->where('number','=',$role)->get();
        $data_user_id = [];
        foreach ($datas as $dat) {
            $data_user_id [] = $dat->user_id;
        }
        $data = User::whereIn('id',$data_user_id)->paginate(10);
        return Inertia::render('Dashboard/Pengguna/Index',['items'=>$data]);
    }

    public function delete(Request $request){
        $target = User::where('id','=',$request->post('id'))->delete();
        $request->session()->flash('success','User berhasil dihapus');
        return back();
    }


     public function beri_tanggapan(Request $request,$id)
    {
        $pesan = $request->post('pesan');      
        $notif = Notifikasi::create(['nama'=>'Revisi Profil','pesan'=>$pesan,'user_id'=>$id,'redirect'=> '/profil/1','tanggal'=>now()]);
        $target = DB::table('users')->select('notifikasi')->where('id','=',$id)->first();
        $target = $target->notifikasi + 1;
        User::where('id','=',$id)->update(['notifikasi' => $target]);
        $request->session()->flash('success','Tanggapan berhasil dikirim');
        return redirect('/admin/dashboard');

    }


    public function join_kegiatan(Request $request,$id){
        $kegiatan = DB::table('kegiatan')->where('id','=',$id)->first();
        $kegiatan->umkm()->attach([$request->user()->id]);
        $request->session()->flash('success','Selamat mengikuti kegiatan!');
        return redirect('umkm/dashboard/kegiatanku/1');
    }

    public function terima_user(Request $request,$id){
        $notif = Notifikasi::create(['nama'=>'Aktivasi sukes','pesan'=>'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka','user_id'=>$id,'redirect'=> '/profil/1']);
        User::where('id','=',$id)->update(['accepted' => true]);
        $target = DB::table('users')->select('notifikasi')->where('id','=',$id)->first();
        $target = $target->notifikasi + 1;
        User::where('id','=',$id)->update(['notifikasi' => $target]);
        $request->session()->flash('success','User ini diterima!');
        return redirect('admin/dashboard');
    }

}
