<?php

namespace App\Http\Controllers\Admin;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\DB;
use App\Mail\CongratsMessage;
use Illuminate\Support\Facades\Mail;
class UserController extends Controller
{
    public function all(Request $request,$role)
    {
        $data = User::join('roles','roles.user_id','=','users.id')->join('profil','profil.user_id','=','users.id')->select('profil.nama_lengkap','users.name','profil.no_hp','users.accepted','email','roles.number','users.created_at','users.id','profil.foto_profil')->where('roles.number','=',$role)->filter_user_panel(request(['cari']))->paginate(10);

        return Inertia::render('Dashboard/Pengguna/Index',['items'=>$data]);
    }

    public function delete(Request $request){
        $target = User::where('id','=',$request->post('id'))->delete();
        $request->session()->flash('success','User berhasil dihapus');
        return back();
    }

    public function ubah_password(Request $request){
        $rules = [
            'password_baru' => 'required|max:255',
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
        $this->validate($request, $rules, $customMessages);
        $update = User::where('id',$request->post('user_id'))->update(['password'=>bcrypt($request->post('password_baru'))]);
        $request->session()->flash('success','Password berhasil diubah');
        return back();
    }
    public function tambah_user(Request $request){
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255|min:8',
            'no_hp' => 'required|max:15|min:9',
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .',
            'min'=>'Karakter yang anda input kurang dari minimum :min .'

        ];
        $this->validate($request, $rules, $customMessages);

        if ($request->post('role') == 1) {
           $user = User::create(['name'=>$request->post('name'),'email'=> $request->post('email'),'no_telepon'=>'+62'.$request->post('no_hp'),'password'=>$request->post('password'),'accepted'=>true,'email_verified_at'=>now()]);
           $user->Role()->update(['number'=>1]);
        }
        elseif($request->post('role') == 2){
            $user = User::create(['name'=>$request->post('name'),'email'=> $request->post('email'),'no_telepon'=>'+62'.$request->post('no_hp'),'password'=>$request->post('password'),'accepted'=>true,'email_verified_at'=>now()]);
           $user->Role()->update(['number'=>2]);
           $user->profil()->create(['nama_lengkap'=>$request->post('name')]);
           $user->usaha()->create([]);
           $user->produk()->create([]);
           $user->finansial()->create([]);
        }
        else{
              $user = User::create(['name'=>$request->post('name'),'email'=> $request->post('email'),'no_telepon'=>'+62'.$request->post('no_hp'),'password'=>$request->post('password'),'accepted'=>true,'email_verified_at'=>now()]);
              $user->Role()->update(['number'=>3]);
              $user->profil()->create(['nama_lengkap'=>$request->post('name')]);
              $user->profilPerusahaan()->create([]);
              $user->dokumenPerusahaan()->create([]);
        }
        
       
        $request->session()->flash('success','User berhasil ditambah');
        return back();
    }


     public function beri_tanggapan(Request $request,$role,$id)
    {
         $redirect = '';
        if ($role == 'investor') {
            $redirect = '/investor/profil/1';
        }
        elseif ($role == 'umkm') {
            $redirect = '/umkm/profil/1';
        }
        $pesan = $request->post('pesan');      
        $notif = Notifikasi::create(['nama'=>'Revisi Profil','pesan'=>$pesan,'user_id'=>$id,'redirect'=> $redirect,'tanggal'=>now()]);
        $target = DB::table('users')->select('notifikasi')->where('id','=',$id)->first();
        $target = $target->notifikasi + 1;
        User::where('id','=',$id)->update(['notifikasi' => $target]);
        $request->session()->flash('success','Tanggapan berhasil dikirim');
        return back();

    }


    public function join_kegiatan(Request $request,$id){
        $kegiatan = DB::table('kegiatan')->where('id','=',$id)->first();
        $kegiatan->umkm()->attach([$request->user()->id]);
        $request->session()->flash('success','Selamat mengikuti kegiatan!');
        return redirect('umkm/dashboard/kegiatanku/1');
    }

    public function terima_user(Request $request,$role,$id){
        $redirect = '';
        if ($role == 'investor') {
            $redirect = '/investor/dashboard/bisnisku?page=1';
        }
        elseif ($role == 'umkm') {
            $redirect = '/umkm/dashboard/kegiatanku?page=1';
        }
        $notif = Notifikasi::create(['nama'=>'Aktivasi sukes','pesan'=>'Selamat !, Akun anda berhasil diaktivasi. Selamat menggunakan Blanjaloka','user_id'=>$id,'redirect'=> $redirect]);
        User::where('id','=',$id)->update(['accepted' => true]);
        $target = DB::table('users')->select('notifikasi')->where('id','=',$id)->first();
        $targetEmail = DB::table('users')->select('email')->where('id','=',$id)->first();
        $target = $target->notifikasi + 1;
        Mail::to( $targetEmail->email)->send(new CongratsMessage());
        User::where('id','=',$id)->update(['notifikasi' => $target]);
        $request->session()->flash('success','User ini diterima!');
        return back();
    }

}
