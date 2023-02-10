<?php
namespace App\Http\Controllers\Investor;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bisnis;
use App\Models\Role;
use App\Models\User;
use App\Models\Notifikasi;
use App\Models\Kegiatan;
use App\Models\DokumenPerusahaan;
use App\Models\Janjitemu;
use App\Models\Profil;
use App\Models\Info_admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
class InvestorController extends Controller
{

   public function janji_temu(Request $request)
    {
         if(!$request->user()->accepted){
            return Inertia::render('Profil/Lockedscreen',['title'=>'Akses Ditolak','desc'=>'Anda harus memenuhi seluruh profil lalu acc dari admin']);
        }
        //dd($request->post('nama_investor'));
        $data = Janjitemu::with(['umkm.profil'])->select('umkm_id','lokasi','waktu','id','berakhir')->where('investor_id','=',$request->user()->id)->filter(request(['nama_investor','lokasi','nama_umkm','event_dimulai','event_berakhir','tanda']))->orderBy('janji_temu.berakhir','desc')->paginate(10);
        $umkm = User::with('profil','produk','finansial','usaha')->where('id',$request->get('id'))->first();
        return Inertia::render('Investor/janjitemu',['items'=>$data,'umkm'=>Inertia::lazy(fn()=>$umkm)]);
    }

    public function dashboard(Request $request)
    {
    
        //dd($request->post('nama_investor'));
     $data = Janjitemu::join('profil','profil.user_id','=','janji_temu.investor_id')->select('umkm_id','lokasi','waktu','janji_temu.id','berakhir','profil.nama_lengkap','profil.foto_profil')->where('investor_id','=',$request->user()->id)->orderBy('janji_temu.berakhir','desc')->limit(5)->get();
        $umkm = User::with('profil','produk','finansial','usaha')->where('id',$request->get('id'))->first();
        return Inertia::render('Investor/Dashboard',['items'=>$data,'umkm'=>Inertia::lazy(fn()=>$umkm)]);
    }

    public function beranda(){
          //dd($request->post('nama_investor'));
        $data = Info_admin::orderBy('tanggal','desc')->filter(request(['cari']))->paginate(10);
        return Inertia::render('Investor/beranda/beranda',['items'=>$data]);
    }

    
 public function kegiatan(Request $request)
    {
        if(!$request->user()->accepted){
            return Inertia::render('Profil/Lockedscreen',['title'=>'Akses ditolak','desc'=>'Penuhi profil anda lalu acc admin dulu !']);
        }
        $user = User::where('id','=',$request->user()->id)->first();
        $kegiatanku = $user->kegiataninvestor()->filter(request(['cari']))->paginate(9);
        
        if($kegiatanku==null){
            return Inertia::render('Profil/Noitemscreen',['title'=>'Anda belum diundang di kegiatan apapun','desc'=>'Silahkan tunggu admin sampai menginvit anda !']);
        }
       
         return Inertia::render('Investor/kegiatan/Kegiatanku',['items'=>$kegiatanku ]);


}

  public function daftar_umkm(Request $request,$link){
     $data=Kegiatan::select('id','tema')->where('id','=',$link)->first();
     $items =User::join('usaha','usaha.user_id','=','users.id')
                        ->join('produk','produk.user_id','=','users.id')
                        ->join('profil','profil.user_id','=','users.id')
                        ->join('kegiatan_umkm','umkm_id','=','users.id')
                        ->select('usaha.nama_perusahaan','users.id','produk.kategori_produk','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.provinsi')  
                         ->filter_umkm(request(['nama_umkm','lokasi_umkm','perusahaan_umkm','produk_umkm']))
                          ->where('kegiatan_umkm.kegiatan_id','=',$link)
                         ->orderBy('profil.nama_lengkap','asc')
                         ->paginate(10);
       

   // $invest = $data->investor();
    $umkm = User::with('profil','produk','finansial','usaha')->where('id',$request->get('id'))->first(); 
        return Inertia::render('Investor/kegiatan/Daftar_umkm',['kegiatan'=>$data,'items'=>$items,'umkm'=>Inertia::lazy(fn()=>$umkm)]);
    }

    public function ajukan_janji_temu(Request $request){

        $rules = [
            'lokasi' => 'required|max:255',
            'waktu' => 'required',
        ];


        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max karakter.'
        ];
        $nama_inv = $request->user()->profil->nama_lengkap;
        $admins= Role::with('user')->where('number','=',1)->get();
        $targetJanjiTemu = User::with('profil:id,nama_lengkap,no_hp,user_id','usaha:id,nama_perusahaan,user_id')->where('id','=',$request->post('umkmid'))->first();
        foreach ($admins as $admin) {
            $notif = Notifikasi::create(['nama'=>'Pengajuan Janji Temu','pesan'=>'investor '.$nama_inv.' dengan nama perusahaan '.$request->user()->profilPerusahaan->nama_perusahaan.' serta no telepon '.$request->user()->profil->no_hp.' meminta untuk janji temu bersama '.$targetJanjiTemu->profil->nama_lengkap.' dengan usaha '.$targetJanjiTemu->usaha->nama_perusahaan.' dan dengan nomor telepon '.$targetJanjiTemu->profil->no_hp.' dilokasi '.$request->post('lokasi').' pada waktu '.$request->post('waktu'),'user_id'=>$admin->user_id,'redirect'=> '/admin/janjitemu?page=1','tanggal'=>now()]);
                $admin->user->update(['notifikasi'=>$admin->user->notifikasi+=1]);
                $request->session()->flash('success','Janji temu anda berhasil di request!');

        }
        $request->session()->flash('success','Janji temu anda berhasil di request!');

            return back();
    }


    public function leave_kegiatan(Request $request,$slug){
        $kegiatan = Kegiatan::where('id','=',$slug)->first();
        $kegiatan->investor()->detach([$request->user()->id]);
        $request->session()->flash('success','Anda berhasil leave kegiatan!');
        $admins= Role::with('user')->where('number','=',1)->get();
        foreach ($admins as $admin) {
        Notifikasi::create(['nama'=>'Pengunduran diri','pesan'=>'investor '.$request->user()->profil->nama_lengkap.' dengan nama perusahaan '.$request->user()->profilPerusahaan->nama_perusahaan.' serta no telepon '.$request->user()->profil->no_hp.' mengundurkan diri dari kegiatan '.$kegiatan->tema,'tanggal'=>now()]);
                $admin->user->update(['notifikasi'=>$admin->user->notifikasi+=1]);
                
        }

        return redirect('Investor/dashboard/kegiatan/');
    }


    public function logbook_umkm(Request $request,$slug1,$slug2){
        $kegiatan = Kegiatan::where('id','=',$slug1)->first();
        $logbook = $kegiatan->logbook()->where('user_id','=',$slug2)->get();
        $nama=$kegiatan->umkm()->with('profil:id,nama_lengkap,user_id')->where('umkm_id','=',$slug2)->first();
        return Inertia::render('Investor/kegiatan/Daftar_logbook_umkm',['kegiatan'=>$kegiatan,'logbook'=>$logbook,'nama'=>$nama]);
    }

    public function deskripsi(Request $request,$link){
    $data = Kegiatan::with('investor')->select('kegiatan.tema','kegiatan.deskripsi','kegiatan.nama_juri','kegiatan.masa_inkubasi','kegiatan.pic','kegiatan.kontak','kegiatan.id','kegiatan.gambar')
                ->where('kegiatan.id','=',$link)
                ->first(); 
    $invest = [];
    foreach ($data->investor()->with('profil:id,nama_lengkap,user_id')->get() as $investor) {
        $invest [] = $investor->profil->nama_lengkap;
            }

   // $invest = $data->investor();
        return Inertia::render('Investor/kegiatan/Deskripsi',['item'=>$data,'investor'=>$invest]);
    }

    public function tugas_akhir_umkm(Request $request,$slug1,$slug2)
    {
       
        $kegiatan = Kegiatan::with('TugasAkhirSoal')->select('tema','id')
                ->where('kegiatan.id','=',$slug1)
                ->first(); 
                
        $tugas = $kegiatan->TugasAkhirSoal()->get();
        $jawaban = $kegiatan->TugasAkhirJawaban()->with('user.profil')->where('user_id',$slug2)->first();

        return Inertia::render('Investor/kegiatan/Jawaban_umkm',['kegiatan'=>$kegiatan,'tugas'=>$tugas,'jawaban'=> $jawaban]);
    }

      public function show_bisnis(Request $request)
    {
       if(!$request->user()->accepted){
            return Inertia::render('Profil/Investor/Lockedscreen',['title'=>'Fitur Bisnis Masih Terkunci','desc'=>'Akun anda belum dikonfirmasi admin']);
        }
        $user = User::where('id','=',$request->user()->id)->first();
        $data = $user->bisnisinvestor()->filter(request(['cari']))->paginate(10);
        return Inertia::render('Investor/bisnis/Bisnisku',['items'=>$data]);

}

   public function keluar_bisnis(Request $request,$link){
        $data = Bisnis::where('id','=',$link)->first();
        $data->investor()->detach($request->user()->id);
        $request->session()->flash('success','Anda berhasil keluar bisnis');
          Notifikasi::create(['nama'=>'Pengunduran diri','pesan'=>'investor '.$request->user()->profil->nama_lengkap.' dengan nama perusahaan '.$request->user()->profilPerusahaan->nama_perusahaan.' serta no telepon '.$request->user()->profil->no_hp.' mengundurkan diri dari bisnis '.$data->name,'tanggal'=>now()]);
                $admin->user->update(['notifikasi'=>$admin->user->notifikasi+=1]);
        return back();
     }

    public function list_umkm(Request $request,$slug){
        $data=Bisnis::select('id','name')->where('id','=',$slug)->first();
         $items = User::join('usaha','usaha.user_id','=','users.id')
                        ->join('produk','produk.user_id','=','users.id')
                        ->join('profil','profil.user_id','=','users.id')
                        ->join('kegiatan_umkm','umkm_id','users.id')
                        ->select('usaha.nama_perusahaan','profil.user_id as umkm_id','produk.kategori_produk','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.provinsi')  
                         ->filter_umkm(request(['nama_umkm','lokasi_umkm','perusahaan_umkm','produk_umkm']))
                         ->where('kegiatan_umkm.kegiatan_id','=',$slug)
                         ->orderBy('profil.nama_lengkap','asc')
                         ->paginate(10);
         $umkm = User::with('profil','produk','finansial','usaha')->where('id',$request->get('id'))->first();  
        return Inertia::render('Investor/bisnis/List_umkm',['items'=>$items,'bisnis'=>$data]);
    }

    public function list_investor(Request $request,$slug){
        $data=Bisnis::select('id','name')->where('id','=',$slug)->first();
         $items =User::join('profil','profil.user_id','=','users.id')
             ->join('profil_perusahaan','profil_perusahaan.user_id','=','users.id')
             ->join('bisnis_investor','investor_id','=','users.id')
             ->select('nama_perusahaan','users.id','kategori_perusahaan','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.provinsi','profil.user_id as investor_id')
            ->filter_investor(request(['nama_investor','lokasi_investor','perusahaan_investor','kategori_investor']))
            ->where('bisnis_investor.bisnis_id',$slug)
            ->orderBy('profil.nama_lengkap','asc')
            ->paginate(10);

        $investor =  User::with(['profil','profilPerusahaan','dokumenPerusahaan'])->where('id',$request->get('id'))->first();
        return Inertia::render('Investor/bisnis/List_investor',['items'=>$items,'bisnis'=>$data,'investor'=>Inertia::lazy(fn()=>$investor)]);
    }


    public function investasiku(Request $request,$slug){
        $bisnis=Bisnis::select('id','name','total_penghasilan')->where('id','=',$slug)->first();
        $items = $bisnis->investasi()->where('user_id',$request->user()->id)->filter(request(['cari']))->paginate(10);
         function getStatistik($umkm_id,$bisnis_object){
             $bisnis = $bisnis_object;
             $statData = [];
             $statData['investasiMasuk'] =[];
             $statData['tanggal'] = [];
             $statData['investasiMasuk']['nilai']=[];
             $statData['investasiKeluar']['nilai']=[]; 
             $statData['investasiMasukTotal'] = 0;
             $statData['investasiKeluarTotal'] = 0;
             $statData['kontribusi'] = 0;
             $items_stat =DB::table('investasi')->where('user_id',$umkm_id)->where('bisnis_id',$bisnis->id)->orderBy('tanggal','asc')->get();
             foreach ($items_stat as $item) {
                 $statData['investasiMasukTotal'] += $item->investasi_masuk;
                 $statData['investasiKeluarTotal'] += $item->investasi_keluar;
                 $statData['tanggal'][] = $item->tanggal;
                 $statData['investasiMasuk']['nilai'][] = $item->investasi_masuk;
                 $statData['investasiKeluar']['nilai'][] = $item->investasi_keluar;
                 $statData['kontribusi']= (($statData['investasiMasukTotal'] - $statData['investasiKeluarTotal'])/ $bisnis->total_penghasilan) * 100 ;


             }
             return $statData;
        }
        $statistik = getStatistik($request->user()->id,$bisnis);
        return Inertia::render('Investor/bisnis/Investasiku',['items'=>$items,'bisnis'=>$bisnis,'statistik'=>Inertia::lazy(fn()=>$statistik)]);
    }
 
 
  public function deskripsi_bisnis(Request $request,$link)
    {
       if(!$request->user()->accepted){
            return Inertia::render('Profil/Investor/Lockedscreen',['title'=>'Fitur Bisnis Masih Terkunci','desc'=>'Akun anda belum dikonfirmasi admin']);
        }
        $data = Bisnis::where('id','=',$link)->first(); 

   // $invest = $data->investor();
        return Inertia::render('Investor/bisnis/Deskripsi',['item'=>$data]);
    }

}