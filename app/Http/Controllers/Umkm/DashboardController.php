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
use App\Models\Janjitemu;
use App\Models\TugasAkhirSoal;
use App\Models\TugasAkhirJawaban;
use App\Models\Profil;
use App\Models\Eventual;
use App\Models\Role;
use App\Models\Info_admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class DashboardController extends Controller
{
    public function index(Request $request)
    {
         
        $data = Janjitemu::join('profil','profil.user_id','=','janji_temu.investor_id')->select('investor_id','lokasi','waktu','janji_temu.id','berakhir','profil.nama_lengkap','profil.foto_profil')->where('umkm_id','=',$request->user()->id)->orderBy('janji_temu.berakhir','desc')->limit(5)->get();
        $investor = User::with(['profil','profilPerusahaan','dokumenPerusahaan'])->where('id',$request->get('id'))->first();
        return Inertia::render('Umkm/Dashboard/Index',['items'=>$data,'investor'=>Inertia::lazy(fn()=>$investor)]);
    }

    

    public function tambah_eventual(Request $request){
         $rules = [
            'perihal' => 'required',
            'kontak' => 'required|max:255',
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
        $data['slug'] = Str::slug($data['perihal'],'-').Str::random(4);
        $admins = Role::select('user_id')->where('number','=',1)->get();
        $data =Eventual::create($data);
      //  $kegiatan = Kegiatan::select('tema')->where('id',$data['kegiatan_id'] )->first();
             foreach ($admins as $admin) {
                 $notif = Notifikasi::create(['nama'=>'Pengajuan Eventual','pesan'=>'UMKM'. $request->user()->profil->nama_lengkap. ' mengajukan untuk meeting di kegiatan '.$data->kegiatan->tema,'user_id'=>$admin->user_id,'redirect'=> '/admin/kegiatan/'. $data['kegiatan_id'].'/eventual','tanggal'=>now()]);
                 $updateNotif =  DB::table('users')->select('notifikasi')->where('id','=',$admin->user_id)->first();
                 $updateNotif = $updateNotif->notifikasi+= 1;
                User::where('id','=',$admin->user_id)->update(['notifikasi'=>$updateNotif]);

        }
        
        $request->session()->flash('success','Anda berhasil merequest untuk konsultasi!');
        return redirect('/umkm/dashboard/kegiatanku/eventual/'.$request->post('kegiatan_id'));

                
    }
     public function kegiatanku(Request $request)
    {
        if(!$request->user()->accepted){
            return Inertia::render('Profil/UMKM/Lockedscreen',['title'=>'Akses ditolak','desc'=>'Penuhi profil anda lalu acc admin dulu !','section'=>'kegiatanku']);
        }
        $user = User::where('id','=',$request->user()->id)->first();
        $kegiatanku = $user->kegiatanumkm()->filter(request(['cari','berakhir']))->paginate(9);
        
        if($kegiatanku==null){
            return Inertia::render('Profil/UMKM/Noitemscreen',['title'=>'Anda belum join kegiatan apapun','desc'=>'Silahkan tunggu admin sampai menginvit anda !','section'=>'kegiatanku']);
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
        $logbook = Logbook::where('id','=',$request->post('id'))->first();
        $data = [];
        $data['deskripsi'] = $request->post('deskripsi');
      
        if ($request->file('gambar') && $logbook->bukti_kegiatan) {
             Storage::delete($logbook->bukti_kegiatan);
             $gambar= $request->file('gambar')->store('umkm/logbook','public') ;
             $data['bukti_kegiatan']= $gambar;
        }
        $data['status'] = 0;
        $logbook->update($data);
        $request->session()->flash('success','Log Anda berhasil diubah!');
        return redirect('/umkm/dashboard/kegiatanku/logbook/'.$request->post('kegiatan_id'));

                
    }
      public function buat_logbook(Request $request){
         $rules = [
            'deskripsi' => 'required',
            'gambar' =>'required'
          
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

  public function beranda(){
          //dd($request->post('nama_investor'));
        $data = Info_admin::orderBy('tanggal','desc')->filter(request(['cari']))->paginate(10);
        return Inertia::render('Umkm/beranda/beranda',['items'=>$data]);
    }


    public function detail_materi($page)
    {

        $data =BabElearning::with(['elearning:id,judul,kegiatan_id','elearning.kegiatan:id,tema'])->where('id','=',$page)
                ->first(); 
        
        $next =DB::table('bab')->where('bab','=',intval($data->bab)+1)->first();

        return Inertia::render('Umkm/Dashboard/Detail_bab',['bab'=>$data,'next'=>$next]);
    }
    public function materi($page)
    {
        $elearning= Elearning::select('judul','kegiatan_id','id','deskripsi')->where('id','=',$page)->first();
        $data = BabElearning::where('elearning_id','=',$page)->orderBy('bab','asc')->filter(request(['cari']))->paginate(10); 
        return Inertia::render('Umkm/Dashboard/Materi',['elearning'=>$elearning,'bab'=>$data]);
    }


    public function elearning($page){
         $kegiatan = Kegiatan::select('kegiatan.tema','id','kegiatan.id as kegiatan_id')
                ->where('kegiatan.id','=',$page)
                ->first(); 

        $data = $kegiatan->elearning()->filter(request(['cari']))->paginate(9);
        return Inertia::render('Umkm/Dashboard/Elearning',['kegiatan'=>$kegiatan,'items'=>$data]);
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
        return Inertia::render('Umkm/Dashboard/Deskripsi',['item'=>$data,'investor'=>$invest]);
    }
    

    public function janjitemu(Request $request)
    {
        if(!$request->user()->accepted){
            return Inertia::render('Profil/UMKM/Lockedscreen',['title'=>'Akses ditolak','desc'=>'Penuhi profil anda lalu acc admin dulu !','section'=>'janjitemu']);
        }

        $data = Janjitemu::join('profil','profil.user_id','=','janji_temu.investor_id')->select('investor_id','lokasi','waktu','janji_temu.id','berakhir','profil.nama_lengkap','profil.foto_profil')->where('umkm_id','=',$request->user()->id)->orderBy('janji_temu.berakhir','desc')->filter(request(['cari','tanda']))->paginate(10);
        $investor = User::with(['profil','profilPerusahaan','dokumenPerusahaan'])->where('id',$request->get('id'))->first();
        return Inertia::render('Umkm/Dashboard/JanjiTemu',['items'=>$data,'investor'=>Inertia::lazy(fn()=> $investor)]);
    }

    public function umkmjurnal(Request $request,$slug)
    {
       
        $kegiatan = Kegiatan::with('logbook')->select('tema','id')
                ->where('kegiatan.id','=',$slug)->first();
        $logbook = $kegiatan->logbook()->where('user_id',$request->user()->id)->get();
        return Inertia::render('Umkm/Dashboard/UmkmJurnal',['kegiatan'=>$kegiatan,'logbook'=>$logbook]);
    }


    public function leave_kegiatan(Request $request,$slug){
        $kegiatan = Kegiatan::where('id','=',$slug)->first();
        $kegiatan->umkm()->detach([$request->user()->id]);
        $request->session()->flash('success','Anda berhasil leave kegiatan!');
         $admins= Role::with('user')->where('number','=',1)->get();
         foreach ($admins as $admin) {
                 Notifikasi::create(['nama'=>'Pengunduran diri','pesan'=>'umkm '.$request->user()->profil->nama_lengkap.' dengan nama perusahaan '.$request->user()->usaha->nama_perusahaan.' serta no telepon '.$request->user()->profil->no_hp.' mengundurkan diri dari kegiatan '.$kegiatan->tema,'tanggal'=>now()]);
                $admin->user->update(['notifikasi'=>$admin->user->notifikasi+=1]);
         }
      
        return redirect('umkm/dashboard/kegiatanku/');
    }

    public function leave_funding(Request $request,$slug){
        $kegiatan = Bisnis::where('id','=',$slug)->first();
        $kegiatan->umkm()->detach([$request->user()->id]);
        $request->session()->flash('success','Anda berhasil leave funding!');
         $admins= Role::with('user')->where('number','=',1)->get();
         foreach ($admins as $admin) {
                 Notifikasi::create(['nama'=>'Pengunduran diri dari funding','pesan'=>'umkm '.$request->user()->profil->nama_lengkap.' dengan nama perusahaan '.$request->user()->usaha->nama_perusahaan.' serta no telepon '.$request->user()->profil->no_hp.' mengundurkan diri dari bisnis '.$bisnis->judul,'tanggal'=>now()]);
                $admin->user->update(['notifikasi'=>$admin->user->notifikasi+=1]);
         }
      
        return redirect('umkm/dashboard/kegiatanku/');
    }


    public function tugas_akhir_post(Request $request){
        $data = [];
        $data['jawaban'] =  $request->post('jawaban');
        $jawaban = TugasAkhirJawaban::where('user_id',$request->user()->id)->where('kegiatan_id',$request->post('kegiatan_id'))->first();

        if ($jawaban) {
            if ($jawaban->gambar  && $request->file('gambar')) {
                Storage::delete($jawaban->gambar);
                $gambar= $request->file('gambar')->store('umkm/tugas_akhir/gambar','public') ;
                $data['gambar']= $gambar;

            }
            elseif($request->file('gambar')){
                $gambar= $request->file('gambar')->store('umkm/tugas_akhir/gambar','public') ;
                $data['gambar']= $gambar;
            }

            if ($jawaban->file  && $request->file('file')) {
                Storage::disk('public')->delete($jawaban->file);
                $file= $request->file('file')->store('umkm/tugas_akhir/dokumen','public') ;
                $data['file']= $file;

            }
            elseif($request->file('file')){
                $file= $request->file('file')->store('umkm/tugas_akhir/dokumen','public') ;
                $data['file']= $file;
            }
            $jawaban->update($data);
            $request->session()->flash('success','Anda berhasil update jawaban anda!');
            
        }
        else{
             if ($request->file('file')) {
                $file= $request->file('file')->store('umkm/tugas_akhir/dokumen','public') ;
                $data['file']= $file;
            }
            if($request->file('gambar')){
                $gambar= $request->file('gambar')->store('umkm/tugas_akhir/gambar','public') ;
                $data['gambar']= $gambar;
            }
            $data['kegiatan_id'] = $request->post('kegiatan_id');
            $data['user_id'] = $request->user()->id;
            TugasAkhirJawaban::create($data);
            $request->session()->flash('success','Anda berhasil mengirim jawaban anda!');
        }

        return back();
    }

    public function eventual(Request $request,$slug)
    {
        $kegiatan = Kegiatan::with('eventual')->select('tema','id')
                ->where('kegiatan.id','=',$slug)
                ->first(); 
        $eventual = $kegiatan->eventual()->select('perihal','nama_mentor','status','id')->filter(request(['cari']))->paginate(10);
         $eventualDet = $kegiatan->eventual()->with('profil:id,nama_lengkap,no_hp,user_id')->where('id',$request->get('id'))->first();
        //dd($eventual);
        return Inertia::render('Umkm/Dashboard/Eventual',['kegiatan'=>$kegiatan,'eventual'=>$eventual,
            'eventualDetail'=>Inertia::lazy(fn()=>$eventualDet)]);
    }
      public function tugas_akhir(Request $request,$slug)
    {
    
        $kegiatan = Kegiatan::with('TugasAkhirSoal')->select('tema','id')
                ->where('kegiatan.id','=',$slug)
                ->first(); 
                
        $tugas = $kegiatan->TugasAkhirSoal()->get();
        $jawaban = $kegiatan->TugasAkhirJawaban()->where('user_id',$request->user()->id)->first();

        if ($jawaban == null) {
            $jawaban['jawaban'] = null;
            $jawaban['file'] = null;
            $jawaban['gambar'] =null;
        }
        return Inertia::render('Umkm/Dashboard/LaporanAkhir',['kegiatan'=>$kegiatan,'tugas'=>$tugas,'jawaban'=> $jawaban]);
    }

    
}