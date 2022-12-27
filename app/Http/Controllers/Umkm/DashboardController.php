<?php

namespace App\Http\Controllers\UMKM;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Kegiatan;
use App\Models\Logbook;
use App\Models\BabElearning;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Elearning;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Storage;
class DashboardController extends Controller
{
    public function index(Request $request)
    {
         if(!$request->user()->accepted){
            return Inertia::render('Profil/Lockedscreen',['title'=>'Akses Ditolak','desc'=>'Anda harus memenuhi seluruh profil lalu acc dari admin']);
        }
        return Inertia::render('Umkm/Dashboard/Index');
    }

    public function tambah_eventual(Request $request){
         $rules = [
            'perihal' => 'required',
            'kontak' => 'required|max:20',
            'mentor' => 'required|max:100',
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

        $this->validate($request, $rules, $customMessages);
        $data = [];
        $data['perihal'] = $request->post('perihal');
        $data['kontak'] =  $request->post('kontak');
        $data['nama_mentor'] =  $request->post('mentor');
        $data['profil_id'] = $request->user()->profil->id;
        $data['kegiatan_id'] = $request->post('kegiatan_id');
        $data['waktu'] = now();
        $admins = DB::table('roles')->select('user_id')->where('number','=',1)->get();
             foreach ($admins as $admin) {
                 $notif = Notifikasi::create(['nama'=>'Pengajuan Eventual','pesan'=>'Seorang user mengajukan untuk meeting','user_id'=>$admin->user_id,'redirect'=> $request->user()->id,'tanggal'=>now()]);
                 $updateNotif =  DB::table('users')->select('notifikasi')->where('id','=',$admin->user_id)->first();
                 $updateNotif = $updateNotif->notifikasi+= 1;
                User::where('id','=',$admin->user_id)->update(['notifikasi'=>$updateNotif]);

        }
        $data = DB::table('eventual')->insert($data);
        $request->session()->flash('success','Anda berhasil merequest untuk konsultasi!');
        return redirect('/umkm/dashboard/kegiatanku/eventual/'.$request->post('kegiatan_id'));

                
    }
     public function kegiatanku(Request $request)
    {
        if(!$request->user()->accepted){
            return Inertia::render('Profil/Lockedscreen',['title'=>'Akses ditolak','desc'=>'Penuhi profil anda lalu acc admin dulu !']);
        }
         $user = User::where('id','=',$request->user()->id)->first();
        $kegiatanku = $user->kegiatanumkm()->orderBy('dimulai','desc')->paginate(9);
        if($kegiatanku==null){
            return Inertia::render('Profil/Noitemscreen',['title'=>'Anda belum mengikuti kegiatan apapun','desc'=>'Silahkan cari kegiatan yang anda minati di beranda !']);
        }
       
         return Inertia::render('Umkm/Dashboard/Kegiatanku',['items'=>$kegiatanku ]);
  
    }
      public function edit_logbook(Request $request){
         $rules = [
            'deskripsi' => 'required',
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

        $this->validate($request, $rules, $customMessages);
        $logbook = Logbook::where('id','=',$request->post('id'));
        $old_image = DB::table('logbook')->select('bukti_kegiatan')->where('id','=',$request->post('id'))->first();
        $data = [];
        $data['deskripsi'] = $request->post('deskripsi');
      
        if ($request->file('gambar')) {
            Storage::delete($old_image->bukti_kegiatan);
             $gambar= $request->file('gambar')->store('umkm/logbook','public') ;
             $data['bukti_kegiatan']= $gambar;
        };
        $data['status'] = 0;
        $logbook->update($data);
        $request->session()->flash('success','Log Anda berhasil tersimpan!');
        return redirect('/umkm/dashboard/kegiatanku/logbook/'.$request->post('kegiatan_id'));

                
    }
      public function buat_logbook(Request $request){
         $rules = [
            'deskripsi' => 'required',
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

        $this->validate($request, $rules, $customMessages);
        $data['deskripsi'] = $request->post('deskripsi');
        $data['bukti_kegiatan'] = $request->file('gambar')->store('umkm/logbook','public') ;
        $data['kegiatan_id'] = $request->post('kegiatan_id');
        $data['user_id'] = $request->user()->id;
         $data['status'] = 0;
        $logbook = Logbook::create($data);
        $request->session()->flash('success','Log Anda berhasil tersimpan!');
        return redirect('/umkm/dashboard/kegiatanku/logbook/'.$request->post('kegiatan_id'));

                
    }

    public function beranda(Request $request,$slug){
        $data = Kegiatan::beranda($limit=9,$page=$slug,$request->user()->id);
         return Inertia::render('Umkm/Dashboard/Beranda',['items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last']]);
    }


    public function detail_materi($page,$page2)
    {

        $data = DB::table('elearning')
                ->join('bab', 'elearning.id' , '=', 'bab.elearning_id')
                ->select('elearning.judul','elearning.kegiatan_id','elearning.deskripsi','bab.judul as bab_judul','bab.deskripsi as bab_deskripsi','bab.link_video','elearning.id')
                ->where('elearning.id','=',$page)
                ->where('bab.bab','=',$page2)
                ->first(); 
        
        $next =DB::table('bab')->select('bab','bab.link_video')->where('bab','=',intval($page2)+1)->first();
       
        return Inertia::render('Umkm/Dashboard/Detail_bab',['elearning'=>$data,'next'=>$next]);
    }
    public function materi($page)
    {
       
        $data = Elearning::select('elearning.judul','elearning.deskripsi','elearning.id',)->where('elearning.id','=',$page)->first(); 
        $babs =  BabElearning::select('judul','id')->where('elearning_id','=',$page)->get();
        return Inertia::render('Umkm/Dashboard/Materi',['elearning'=>$data,'babs'=>$babs]);
    }


    public function elearning($page){
         $kegiatan = DB::table('kegiatan')
                ->select('kegiatan.tema','kegiatan.id as kegiatan_id')
                ->where('kegiatan.id','=',$page)
                ->first(); 

        $data = Elearning::select('id','judul','deskripsi','foto','hari_tanggal_waktu' ,'kegiatan_id')->where('kegiatan_id','=',$page)->orderBy('hari_tanggal_waktu')->paginate(10);
       

      
        return Inertia::render('Umkm/Dashboard/Elearning',['kegiatan'=>$kegiatan,'items'=>$data]);
    }


    public function deskripsi(Request $request,$link){
    $data = Kegiatan::select('kegiatan.tema','kegiatan.deskripsi','kegiatan.nama_juri','kegiatan.masa_inkubasi','kegiatan.pic','kegiatan.kontak','kegiatan.id')
                ->where('kegiatan.id','=',$link)
                ->first(); 
    $invest = [];
    foreach ($data->investor as $investor) {
        $invest [] = $investor->profil->nama_lengkap;
            }

   // $invest = $data->investor();
        return Inertia::render('Umkm/Dashboard/Deskripsi',['item'=>$data,'investor'=>$invest]);
    }
    

    public function janjitemu(Request $request)
    {
        if(!$request->user()->accepted){
            return Inertia::render('Profil/Lockedscreen',['title'=>'Akses ditolak','desc'=>'Penuhi profil anda lalu acc admin dulu !']);
        }
        return Inertia::render('Umkm/Dashboard/JanjiTemu');
    }

    public function umkmjurnal(Request $request,$slug)
    {
        if(!$request->user()->accepted){
            return Inertia::render('Profil/Lockedscreen',['title'=>'Akses ditolak','desc'=>'Penuhi profil 
                anda lalu acc admin dulu !']);
        }
        $kegiatan = DB::table('kegiatan')
                ->select('tema','id')
                ->where('kegiatan.id','=',$slug)
                ->first(); 
        $logbook= DB::table('logbook')
                ->select('deskripsi','bukti_kegiatan','status','waktu','id')
                ->where('kegiatan_id','=',$slug)->where('user_id','=',$request->user()->id)->orderBy('waktu','asc')
                ->get();
        return Inertia::render('Umkm/Dashboard/UmkmJurnal',['kegiatan'=>$kegiatan,'logbook'=>$logbook]);
    }


    public function leave_kegiatan(Request $request,$slug){
        $kegiatan = Kegiatan::where('id','=',$slug)->first();
        $kegiatan->umkm()->detach([$request->user()->id]);
        $request->session()->flash('success','Anda berhasil leave kegiatan!');
        return redirect('umkm/dashboard/kegiatanku/');
    }

     public function join_kegiatan(Request $request,$slug){
        $kegiatan = Kegiatan::select('id','dimulai','berakhir','jumlah_orang_diundang')->where('id','=',$slug)->first();
        $banyak_peserta = DB::table('kegiatan_umkm')->select('kegiatan_id')->where('kegiatan_id','=',$slug)->get();
        if (intval($kegiatan->jumlah_orang_diundang) <= intval(count($banyak_peserta))) {
            $request->session()->flash('success','Kegiatan ini sudah penuh!');
            return back();
        }
        $begin = explode(' ',$kegiatan->dimulai)[0];
        $end = explode(' ',$kegiatan->berakhir)[0];
        $current_date = $begin;
        while(strtotime($current_date) < strtotime($end))
        {
          Logbook::create(['waktu'=>date("Y-m-d H:i:s",strtotime($current_date)),'user_id'=>$request->user()->id,'kegiatan_id'=>$slug]);
          $current_date= date("Y-m-d",strtotime("+1 day",strtotime($current_date)));
        }
        $kegiatan->umkm()->attach([$request->user()->id]);
        $request->session()->flash('success','Anda berhasil join kegiatan!');
        return redirect('umkm/dashboard/kegiatanku/1');
    }

    public function eventual(Request $request,$slug)
    {
        if(!$request->user()->accepted){
            return Inertia::render('Profil/Lockedscreen',['title'=>'Akses ditolak','desc'=>'Penuhi profil anda lalu acc admin dulu !']);
        }
        $kegiatan = DB::table('kegiatan')
                ->select('tema','id')
                ->where('kegiatan.id','=',$slug)
                ->first(); 
        $eventual = DB::table('eventual')
                ->join('profil','profil.id','=','eventual.profil_id')
                ->select('eventual.status','eventual.nama_mentor','eventual.perihal','profil.nama_lengkap','profil.no_hp','eventual.link_meeting','eventual.kontak','eventual.jadwal')
                ->where('kegiatan_id','=',$slug)
                ->where('profil_id','=',$request->user()->profil->id)
                ->orderBy('waktu','asc')
                ->get();

        return Inertia::render('Umkm/Dashboard/Eventual',['kegiatan'=>$kegiatan,'eventual'=>$eventual]);
    }
}