<?php

namespace App\Http\Controllers\UMKM;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Kegiatan;
use App\Models\Logbook;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Elearning;
use App\Models\Notifikasi;
class DashboardController extends Controller
{
    public function index()
    {
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
      public function tambah_logbook(Request $request){
         $rules = [
            'deskripsi' => 'required',
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

        $this->validate($request, $rules, $customMessages);
        $data = [];
        $data['deskripsi'] = $request->post('deskripsi');
      
        if ($request->file('gambar')) {
             $gambar= $request->file('gambar')->store('umkm/logbook','public') ;
             $data['bukti_kegiatan']= $gambar;
        };
        $data['status'] = 0;
        $data = Logbook::where('id','=',$request->post('id'))->update($data);
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
        $next =intval($page2)+1;
        $next =DB::table('bab')->select('bab')->where('bab','=',$next)->first();
        return Inertia::render('Umkm/Dashboard/Detail_bab',['elearning'=>$data,'next'=>$next]);
    }
    public function materi($page)
    {
        
        $data = DB::table('elearning')
                ->join('kegiatan', 'elearning.kegiatan_id' , '=', 'kegiatan.id')
                ->select('elearning.judul','elearning.deskripsi','kegiatan.tema as kegiatan_tema','kegiatan.id as kegiatan_id','elearning.id')
                ->where('elearning.id','=',$page)
                ->first(); 
        $babs =  DB::table('bab')->select('judul','id')->where('elearning_id','=',$page)->get();
        return Inertia::render('Umkm/Dashboard/Materi',['elearning'=>$data,'babs'=>$babs]);
    }


    public function elearning($link,$page){
         $kegiatan = DB::table('kegiatan')
                ->select('kegiatan.tema','kegiatan.id as kegiatan_id')
                ->where('kegiatan.id','=',$link)
                ->first(); 

        $data = Elearning::fetchAndPaginate($limit=9,$offset=$page,$url = $kegiatan->kegiatan_id);
        return Inertia::render('Umkm/Dashboard/Elearning',['kegiatan'=>$kegiatan,'items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last']]);
    }


    public function deskripsi(Request $request,$link){
    $data = DB::table('kegiatan')
                ->select('kegiatan.tema','kegiatan.deskripsi','kegiatan.nama_juri','kegiatan.masa_inkubasi','kegiatan.pic','kegiatan.kontak','kegiatan.id')
                ->where('kegiatan.id','=',$link)
                ->first(); 
    $investors= DB::table('kegiatan_investor')->select('investor_id')->where('kegiatan_id','=',$link)->get();
    $invest = [];
    foreach ($investors as $investor) {
        $target = DB::table('profil')->select('nama_lengkap')->where('user_id','=',$investor->investor_id)->first();
        $invest [] = $target->nama_lengkap;
    }

        return Inertia::render('Umkm/Dashboard/Deskripsi',['item'=>$data,'investor'=>$invest]);
    }
    public function kegiatanku(Request $request,$page)
    {
         if(!$request->user()->accepted){
            return Inertia::render('Profil/Lockedscreen',['title'=>'Akses ditolak','desc'=>'Penuhi profil anda lalu acc admin dulu !']);
        }
        $data = Kegiatan::fetchAndPaginate4UMKM($limit=10,$offset=$page,$request->user()->id);
        if(count($data['items'])==0){
            return Inertia::render('Profil/Noitemscreen',['title'=>'Anda belum mengikuti kegiatan apapun','desc'=>'Silahkan cari kegiatan yang anda minati di beranda !']);
        }


        return Inertia::render('Umkm/Dashboard/Kegiatanku',['items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last']],);
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
                ->where('kegiatan_id','=',$slug)->orderBy('waktu','asc')
                ->get();
        return Inertia::render('Umkm/Dashboard/UmkmJurnal',['kegiatan'=>$kegiatan,'logbook'=>$logbook]);
    }


    public function leave_kegiatan(Request $request,$slug){
        $kegiatan = Kegiatan::where('id','=',$slug)->first();
        $kegiatan->umkm()->detach([$request->user()->id]);
        $request->session()->flash('success','Anda berhasil leave kegiatan!');
        return redirect('umkm/dashboard/kegiatanku/1');
    }

     public function join_kegiatan(Request $request,$slug){
        $kegiatan = Kegiatan::select('id','dimulai','berakhir','jumlah_orang_diundang')->where('id','=',$slug)->first();
        $banyak_peserta = DB::table('kegiatan_umkm')->select('kegiatan_id')->where('kegiatan_id','=',$slug)->get();
        if (intval($kegiatan->jumlah_orang_diundang) <= intval(count($banyak_peserta))) {
            $request->session()->flash('success','Kegiatan ini sudah penuh!');
            return redirect('umkm/dashboard/beranda');
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