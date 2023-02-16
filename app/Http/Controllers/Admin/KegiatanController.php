<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Kegiatan;
use App\Models\Elearning;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\Profil;
use App\Models\Logbook;
use App\Models\Notifikasi;
use App\Models\BabElearning;
use App\Models\Eventual;
use App\Models\TugasAkhirSoal;
use App\Models\TugasAkhirJawaban;
use App\Models\kegiatan_umkm_pivot;
use App\Models\kegiatan_investor_pivot;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
class KegiatanController extends Controller
{

    public function list_eventual(Request $request,$slug){
  
       // $data = Eventual::with(['profil'])->where('kegiatan_id','=',$page1)->orderBy('waktu','asc')->paginate(10);
        $kegiatan = Kegiatan::select('tema','id')->where('id','=',$slug)->first();
        $data = $kegiatan->eventual()->with(['profil:id,user_id,nama_lengkap,user_id'])->orderBy('waktu','asc')
        ->filter(['cari'])->paginate(10);
        return Inertia::render('Dashboard/Kegiatan/List_eventual',['items'=>$data, 'kegiatan'=>$kegiatan]);
    }

    public function ubah_eventual_status(Request $request){
         $rules = [
            'jadwal' =>'required',
            'link_meeting' => 'required',
            'status' => 'required',
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
        $this->validate($request, $rules, $customMessages);
        $data = [];
        $data['jadwal'] = $request->post('jadwal');
        $data['link_meeting'] = $request->post('link_meeting');
        $data['status']  = intval($request->post('status'));
        $event= Eventual::with(['kegiatan:id,tema','profil:id,user_id,user_id'])->where('id','=',$request->post('id'))->first();
        $message='';
        if ($data['status'] ==1) {
            $message = 'Eventual anda disetujui';
        }
        else{
            $message = 'Eventual anda telah selesai';
        }
        Notifikasi::create(['nama'=>$message,'pesan'=>$message.' pada kegiatan '.$event->kegiatan->tema .' dengan perihal '.$event->perihal.'di waktu '. $data['jadwal'] ,'user_id'=>$event->profil->user_id,'tanggal'=>now()]);
        $umkmNotif = User::select('notifikasi')->where('id',$event->profil->user_id);
        $updateNotif = $umkmNotif->first()->notifikasi +1;
        $umkmNotif->update(['notifikasi'=>$updateNotif]);
        $request->session()->flash('success','Status eventual berhasil diubah');
        return back();
    }

    public function edit_deskripsi(Request $request){
         $rules = [
            'gambar' =>'required',
            'deskripsi' => 'required'
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
        $this->validate($request, $rules, $customMessages);
        $data = [];
        $data['deskripsi'] = $request->post('deskripsi');
        $kegiatan = Kegiatan::where('id','=',$request->post('id'))->first();
         if ($request->file('gambar')) {
             Storage::disk('public')->delete($kegiatan->gambar);
             $gambar= $request->file('gambar')->store('umkm/logbook','public') ;
             $data['gambar']= $gambar;
        };
         $kegiatan->update($data);
         $request->session()->flash('success','Deskripsi kegiatan berhasil diubah');
         return back();
    }

    public function list_elearning(Request $request,$slug){
        $kegiatan = Kegiatan::with('elearning')->select('tema','id')->where('id','=',$slug)->first();
        $data = $kegiatan->elearning()->filter( request(['cari']))->paginate(10);
        return Inertia::render('Dashboard/Kegiatan/List_elearning',['items'=>$data,
                                                           'kegiatan'=>$kegiatan]);
    }

    public function tambah_elearning($slug){
        $kegiatan = Kegiatan::select('tema','id')->where('id','=',$slug)->first();
        return Inertia::render('Dashboard/Kegiatan/Tambah_elearning',['kegiatan'=>$kegiatan]);
    }

    public function list_bab(Request $request,$slug){
       
        $elearning = Elearning::with('bab','kegiatan:id')->select('judul','kegiatan_id','id','kegiatan_id')->where('id','=',$slug)->first();
        $data = $elearning->bab()->filter(request(['cari']))->paginate(10);

        return Inertia::render('Dashboard/Kegiatan/Bab_elearning',['items'=>$data,
                                                           'elearning'=>$elearning]);
    }

    public function tambah_bab(Request $request,$slug){
        $elearning = Elearning::select('judul','kegiatan_id','id')->where('id','=',$slug)->first();
        return Inertia::render('Dashboard/Kegiatan/Tambah_bab',['elearning'=>$elearning]);
    }

    public function edit_bab(Request $request,$slug){
        $bab = BabElearning::with('elearning:id,judul,kegiatan_id')->select('judul','deskripsi','link_video','bab','id','elearning_id')->where('id','=',$slug)->first();
        return Inertia::render('Dashboard/Kegiatan/Edit_bab',['bab'=>$bab]);
    }


    public function edit_bab_post(Request $request){
         $rules = [
            'deskripsi' => 'required',
            'judul' => 'required|max:255',
            'link_video' =>'required',
            'bab' => 'required',
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
        $data = [];
        $data['deskripsi'] = $request->post('deskripsi');
        $data['judul'] = $request->post('judul');
        $data['link_video'] = $request->post('link_video');
        $data['bab'] = $request->post('bab');
        $bab=  BabElearning::where('id','=',$request->post('id'))->first();
        $bab->update($data);
        $request->session()->flash('success','Bab berhasil diubah');
        return redirect('/admin/kegiatan/elearning/'.$request->post('elearning_id').'/bab');
    }


    public function tambah_bab_post(Request $request){
        $rules = [
            'deskripsi' => 'required',
            'judul' => 'required|max:255',
            'link_video' =>'required',
            'bab' => 'required',
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
        $this->validate($request, $rules, $customMessages);
        $data = [];
        $data['deskripsi'] = $request->post('deskripsi');
        $data['elearning_id'] = $request->post('elearning_id');
        $data['judul'] = $request->post('judul');
        $data['link_video'] = $request->post('link_video');
        $data['bab'] = $request->post('bab');
        $request->session()->flash('success','Bab berhasil ditambah');
        $data = BabElearning::create($data);
        return back();
    }



    public function add_elearning(Request $request){
       
        $rules = [
            'waktu' => 'required',
            'judul' => 'required|max:255',
            'gambar' =>'required',
            'deskripsi' => 'required',
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
        $this->validate($request, $rules, $customMessages);
        $gambar= $request->file('gambar')->store('elearning/gambar','public') ;
        $data = [];
        $data['hari_tanggal_waktu'] = $request->post('waktu');
        $data['judul'] = $request->post('judul');
        $data['foto'] = $gambar;
        $data['deskripsi'] = $request->post('deskripsi');
        $data['kegiatan_id'] = $request->post('kegiatan_id');
        $elearning = Elearning::create($data);
        $request->session()->flash('success','Elearning berhasil ditambah');
        return redirect('/admin/kegiatan/elearning/'.$elearning->id.'/bab');
    }

    public function edit_elearning_view(Request $request,$slug){
       
    $data =   Elearning::select('hari_tanggal_waktu','deskripsi','judul','foto','id','kegiatan_id')->where('id','=',$slug)->first();

    return Inertia::render('Dashboard/Kegiatan/Edit_elearning',['elearning'=>$data]);

    }


    public function edit_elearning_post(Request $request){
       
        $rules = [
            'waktu' => 'required',
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

        $this->validate($request, $rules, $customMessages);
        $elearning = Elearning::where('id','=',$request->post('id'))->first();
        $data = [];
        if ($request->file('gambar')) {
              Storage::disk('public')->delete($elearning->foto);
              $gambar= $request->file('gambar')->store('elearning/gambar','public') ;
              $data['foto'] = $gambar;
        }
        $data['hari_tanggal_waktu'] = $request->post('waktu');
        $data['judul'] = $request->post('judul');
        $data['deskripsi'] = $request->post('deskripsi');
        $elearning->update($data);
        $request->session()->flash('success','Elearning berhasil diubah');
       return redirect('/admin/kegiatan/'.$elearning->kegiatan->id.'/elearning/');
    }
    public function hapus_kegiatan(Request $request){

        $delete = Kegiatan::where('id','=',$request->post('id'))->first();
        //Storage::delete($delete->gambar);
        $delete->delete();
        $request->session()->flash('success','Kegiatan berhasil dihapus !');
    
        return redirect('/admin/kegiatan?page=1');
    }

     public function hapus_elearning(Request $request){
        $delete =  Elearning::where('id','=',$request->post('id'))->delete();
        $request->session()->flash('success','Kegiatan berhasil dihapus !');
    
        return back();
    }
    public function hapus_bab(Request $request,$id){
        $delete =  BabElearning::where('id','=',$request->post('id'))->delete();
        $request->session()->flash('success','Kegiatan berhasil dihapus !');
        return back();
    }
    public function hapus_eventual(Request $request,$id){
        $event = Eventual::with(['profil:id,user_id','kegiatan:id,tema'])->where('id','=',$id)->first();
        Notifikasi::create(['nama'=>'Eventual Dibatalkan','pesan'=>'Eventual yang anda minta pada kegiatan '.$event->kegiatan->tema.' tanggal '.$event->jadwal. ' sudah dihapus. Kontak admin bila terjadi kesalahan','user_id'=>$event->profil->user_id,'tanggal'=>now()]);
        $umkmNotif = User::select('notifikasi')->where('id',$event->profil->user_id)->first();
        $updateNotif = $umkmNotif->notifikasi +1;
        $umkmNotif->update(['notifikasi'=>$updateNotif]);
        $event = Eventual::where('id','=',$id);
        $event->delete();
        $request->session()->flash('success','eventual berhasil ditolak !');
        return back();
    }

    public function list_logbook(Request $request,$slug){
        $kegiatan = Kegiatan::select('tema','id')->where('id','=',$slug)->first();
        $items = User::join('usaha','usaha.user_id','=','users.id')
                        ->join('produk','produk.user_id','=','users.id')
                        ->join('profil','profil.user_id','=','users.id')
                        ->join('kegiatan_umkm','kegiatan_umkm.umkm_id','=','users.id')
                        ->select('usaha.nama_perusahaan','users.id','produk.kategori_produk','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.provinsi')   
            ->filter_umkm(request(['nama_umkm','lokasi_umkm','perusahaan_umkm','produk_umkm']))
            ->where('kegiatan_umkm.kegiatan_id',$slug)
            ->orderBy('profil.nama_lengkap','asc')
            ->paginate(10);
        return Inertia::render('Dashboard/Kegiatan/Daftar_logbook',['items'=>$items,
                                                           'kegiatan'=>$kegiatan],);
    }

    public function list_user_logbook($slug,$slug_user){
        $kegiatan =  Kegiatan::with('logbook')->select('tema','id')->where('id','=',$slug)->first();
        $data= $kegiatan->logbook()->where('user_id','=',$slug_user)->orderBy('waktu','desc')->filter(request(['cari']))->paginate(10);

        return Inertia::render('Dashboard/Kegiatan/List_user_logbook',['items'=>$data,
                                                           'kegiatan'=>$kegiatan],);
    }

    public function ubah_status_logbook(Request $request){
        $data = Logbook::where('id','=',$request->post('id'))->first()->update(['status'=>$request->post('status')]);
        $kegiatan = DB::table('kegiatan')->select('tema')->where('id','=',$request->post('kegiatan_id'))->first();
        if ($request->post('status') == 1) {
          Notifikasi::create(['nama'=>'Laporan anda ditrima','pesan'=>'Selamat!,laporan anda pada kegiatan '.$kegiatan->tema.' di waktu '.$request->post('waktu').' diterima!','user_id'=>$request->post('user_id'),'tanggal'=>now()]);

        }
        else{
        Notifikasi::create(['nama'=>'Laporan anda ditolak','pesan'=>'Mohon perbaiki lagi laporannya pada kegiatan'.$kegiatan->tema.' di waktu '.$request->post('waktu'),'user_id'=>$request->post('user_id'),'tanggal'=>now()]);
        }
        $umkmNotif = User::select('notifikasi')->where('id',$request->post('user_id'));
        $updateNotif = $umkmNotif->first()->notifikasi +1;
        $umkmNotif->update(['notifikasi'=>$updateNotif]);
        $request->session()->flash('success','Status berhasil diubah');
        return back();
    }


    public function detail_kegiatan($page){
        $kegiatan = DB::table('kegiatan')->select('tema','deskripsi','id','gambar')->where('id','=',$page)->first();
        return Inertia::render('Dashboard/Kegiatan/Edit_deskripsi',['kegiatan'=>$kegiatan]);
    }
    public function index(Request $request){
      
     $data = Kegiatan::select('tema','dimulai','berakhir','draft','jumlah_orang_diundang','kegiatan.gambar','kegiatan.id')
            ->orderBy('kegiatan.dimulai','asc')
            ->filter(request(['berakhir']))
            ->filter(request(['cari']))

            ->paginate(10);
        
     
        //dd($data['items']);
        return Inertia::render('Dashboard/Kegiatan/Daftar_kegiatan',['items'=>$data]);
    }

    public function tambah(){
        /*
        $roles = Role::select('user_id')->where('number','=',3)->get();
        $investor = [];
        foreach ($roles as $role) {
            if ($role->user->accepted) {
             $investor[] = $role->user->profil  ;
            }
        }
        $roles = Role::select('user_id')->where('number','=',2)->get();
        $umkm = [];
        foreach ($roles as $role) 
        {        
            if ($role->user->accepted) {
                $umkm[] = $role->user->profil ;
            }
        }
        */
        return Inertia::render('Dashboard/Kegiatan/tambah_kegiatan');
    }

    public function edit_kegiatan($slug){
        /*
        $roles = Role::select('user_id')->where('number','=',3)->get();
        $investor = [];
        foreach ($roles as $role) {
          if ($role->user->accepted) {
            $investor[] = $role->user->profil  ;
            }
        }

        $oldInvestor = [];
       // dd($kegiatan->investor);
        foreach ($kegiatan->investor as $oldInv ) {
            
            $oldInvestor[] = $oldInv->profil ;
        }

        $roles = Role::select('user_id')->where('number','=',2)->get();
        $umkm = [];
        foreach ($roles as $role) {
                if ($role->user->accepted) {
                        $umkm[] = $role->user->profil ;
                    }
        }
        $oldUmkm = [];
        foreach ($kegiatan->umkm as $old_umkm ) {
            $oldUmkm[] = $old_umkm->profil ;
        }*/
        $kegiatan =  Kegiatan::select('kegiatan.tema','kegiatan.deskripsi','kegiatan.nama_juri','kegiatan.masa_inkubasi','kegiatan.pic','kegiatan.kontak','kegiatan.id','kegiatan.dimulai','kegiatan.berakhir','kegiatan.jumlah_orang_diundang','kegiatan.kurikulum','kegiatan.gambar','kegiatan.draft')->where('id','=',$slug)->first();
      


        return Inertia::render('Dashboard/Kegiatan/Edit_kegiatan',['kegiatan'=>$kegiatan]);
    }


    public function edit_kegiatan_post(Request $request){
           $rules = [
            'tema' => 'required|max:255',
            'deskripsi' => 'required',
            'jumlah_orang_diundang'=>'required',
            'masa_inkubasi'=>'required',
            'kurikulum'=>'required|max:100',
            'nama_juri'=>'required|max:500',
            'pic'=>'required|max:255',
            'kontak'=>'required|max:200',
            'draft'=>'required',
            'dimulai'=>'required',
            'berakhir' =>'required',
            'gambar'=>'required'
        ];


        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
      $this->validate($request, $rules, $customMessages);
    //  $daftarInvestor =$request->post('nama_investor');
    //  $daftarUmkm = $request->post('nama_umkm');
      $update =['tema' => $request->post('tema'),
                'deskripsi' => $request->post('deskripsi'),
                'jumlah_orang_diundang'=>$request->post('jumlah_orang_diundang'),
                'masa_inkubasi'=>$request->post('masa_inkubasi'),
                'kurikulum'=>$request->post('kurikulum'),
                'nama_juri'=>$request->post('nama_juri'),
                'pic'=>$request->post('pic'),
                'kontak'=>$request->post('kontak'),
                'draft'=>$request->post('draft'),
                'dimulai'=>$request->post('dimulai'),
                'berakhir' =>$request->post('berakhir')];

    $kegiatan = Kegiatan::where('id','=',$request->post('id'))->first();
    if ($request->file('gambar')) {
         Storage::disk('public')->delete($kegiatan->gambar);
         $update['gambar'] = $request->file('gambar')->store('kegiatan/gambar','public');
    }

    /*
    
      $kegiatan->update($update);
      if ($daftarInvestor) {
          $listInvestor = [];
          foreach ($daftarInvestor as $investor) {
            $listInvestor[] = $investor['user_id'] ;
          }
          $kegiatan->investor()->sync($listInvestor);

      }

      if ($daftarUmkm) {
          $listUmkm = [];
          foreach ($daftarUmkm as $umkm) {
            $listUmkm[] = $umkm['user_id'] ;
          }
          
          $kegiatan->umkm()->sync($listUmkm);
      }
          
       */  
    $request->session()->flash('success','Kegiatan berhasil dibuat');

      return redirect('/admin/kegiatan?page=1');
    }

    public function tambah_kegiatan_post(Request $request)
    {
        //dd($request->all());

             $rules = [
            'tema' => 'required|max:255',
            'deskripsi' => 'required',
            'jumlah_orang_diundang'=>'required',
            'masa_inkubasi'=>'required',
            'kurikulum'=>'required|max:100',
            'nama_juri'=>'required|max:500',
            'pic'=>'required|max:255',
            'kontak'=>'required|max:200',
            'draft'=>'required',
            'dimulai'=>'required',
            'berakhir' =>'required',
            'gambar'=>'required'
        ];


        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
      $this->validate($request, $rules, $customMessages);
      $daftarInvestor =$request->post('nama_investor');
      $daftarUmkm =$request->post('nama_umkm');
      $gambar = $request->file('gambar')->store('kegiatan/gambar','public');
      //dd($gambar)
      $kegiatan = Kegiatan::create(['tema' => $request->post('tema'),
                                    'deskripsi' => $request->post('deskripsi'),
                                    'jumlah_orang_diundang'=>$request->post('jumlah_orang_diundang'),
                                    'masa_inkubasi'=>$request->post('masa_inkubasi'),
                                    'kurikulum'=>$request->post('kurikulum'),
                                    'nama_juri'=>$request->post('nama_juri'),
                                    'pic'=>$request->post('pic'),
                                    'kontak'=>$request->post('kontak'),
                                    'draft'=>$request->post('draft') ? 1:0,
                                    'dimulai'=>$request->post('dimulai'),
                                    'berakhir' =>$request->post('berakhir'),
                                    'gambar'=>$gambar]);
     /*
      $listInvestor = [];
      foreach ($daftarInvestor as $investor) {
        $listInvestor[] = $investor['user_id'] ;
      }
      $kegiatan->investor()->attach($listInvestor);

      $listUmkm = [];
      foreach ($daftarUmkm as $umkm) {
        $listUmkm[] = $umkm['user_id'] ;
      }
      $kegiatan->umkm()->attach($listUmkm);
      
        */
      $request->session()->flash('success','Kegiatan berhasil dibuat silahkan pilih investor !');
      return redirect('/admin/kegiatan/'.$kegiatan->id.'/investor/');

    }
    public function daftar_investor(Request $request,$slug){
         $kegiatan = Kegiatan::select('tema','id')->where('id',$slug)->first();
         $items = User::join('profil','profil.user_id','=','users.id')
             ->join('profil_perusahaan','profil_perusahaan.user_id','=','users.id')
             ->join('kegiatan_investor','investor_id','=','users.id')
             ->select('nama_perusahaan','users.id','kategori_perusahaan','profil.nama_lengkap','profil.no_hp','profil.foto_profil')
            ->filter_investor(request(['nama_investor','lokasi_investor','perusahaan_investor','kategori_investor']))
            ->where('kegiatan_investor.kegiatan_id','=',$slug)
            ->orderBy('profil.nama_lengkap','asc')
            ->paginate(10);
        
        $investor_all = User::join('profil','profil.user_id','=','users.id')
             ->join('profil_perusahaan','profil_perusahaan.user_id','=','users.id')
             ->join('roles','roles.user_id','=','users.id')
             ->select('nama_perusahaan','users.id','kategori_perusahaan','profil.nama_lengkap','profil.no_hp','profil.foto_profil')
            ->filter_investor(request(['nama_investor','lokasi_investor','perusahaan_investor','kategori_investor'])) 
            ->where('accepted',true)
            ->where('roles.number','=',3)
            ->orderBy('profil.nama_lengkap','asc')
            ->paginate(10);
        $investorJoined = [];
        foreach($kegiatan->investor()->select('investor_id')->get() as $investor){

            $investorJoined[] = $investor->investor_id;

        }


        return Inertia::render('Dashboard/Kegiatan/Kegiatan_investor',
                                ['items'=>$items,'kegiatan'=>$kegiatan,
                                 'investor'=>Inertia::lazy(fn () => $investorJoined),
                                 'investor_all'=>Inertia::lazy(fn () => $investor_all)]);
     }


      public function daftar_umkm(Request $request,$slug){
        /*
        $roles = Role::select('user_id')->where('number','=',2)->get();
        $umkm = [];
        for ($i=0; $i < count($roles) ; $i++)  {
             if ($roles[$i]->user->accepted) {
                    $umkm[$i] = $roles[$i]->user->profil;
                    $umkm[$i]['nama_perusahaan'] = $roles[$i]->user->usaha->nama_perusahaan;
                    $umkm[$i]['kategori_produk'] = $roles[$i]->user->produk->kategori_produk;
             }
        }
        */
        $kegiatan=Kegiatan::select('id','tema')->where('id','=',$slug)->first();
        /*
        $items = $data->investor()->with(['profil:id,nama_lengkap,no_hp,foto_profil,user_id'])->whereHas('profil', function (Builder $query) {
            $query->orderBy('nama_lengkap','asc');})->whereHas('profil', function (Builder $query) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');})->paginate(10);
            */
             $items = User::join('usaha','usaha.user_id','=','users.id')
                        ->join('produk','produk.user_id','=','users.id')
                        ->join('profil','profil.user_id','=','users.id')
                        ->join('kegiatan_umkm','kegiatan_umkm.umkm_id','=','users.id')
                        ->select('usaha.nama_perusahaan','users.id','produk.kategori_produk','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.provinsi','kegiatan_umkm.lulus_funding')      
                         ->filter_umkm(request(['nama_umkm','lokasi_umkm','perusahaan_umkm','produk_umkm']))
                         ->where('kegiatan_umkm.kegiatan_id','=',$slug)
                         ->orderBy('profil.nama_lengkap','asc')
                         ->paginate(10);

            $umkm_all = User::join('usaha','usaha.user_id','=','users.id')
                        ->join('produk','produk.user_id','=','users.id')
                        ->join('profil','profil.user_id','=','users.id')
                        ->join('roles','roles.user_id','users.id')
                        ->select('usaha.nama_perusahaan','users.id','produk.kategori_produk','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.provinsi')  
                         ->filter_umkm(request(['nama_umkm','lokasi_umkm','perusahaan_umkm','produk_umkm']))
                         ->where('users.accepted',true)
                         ->where('roles.number','=',2)
                         ->orderBy('profil.nama_lengkap','asc')
                         ->paginate(10);
        $umkmJoined = [];
        foreach($kegiatan->umkm()->select('umkm_id')->get() as $umkm){

            $umkmJoined[] = $umkm->umkm_id;
        }

        return Inertia::render('Dashboard/Kegiatan/Kegiatan_umkm',['items'=>$items,'kegiatan'=>$kegiatan,'umkm'=>Inertia::lazy(fn()=>$umkmJoined),'umkm_all'=>Inertia::lazy(fn()=>$umkm_all)]);
     }


    public function tambah_investor_post(Request $request){
        $data = Kegiatan::with('investor')->select('id','tema')->where('id','=',$request->post('kegiatan_id'))->first();
        $investor = $request->post('investor_id');
        /*
        if ($data->investor->contains($investor)){
            $request->session()->flash('error','Investor tersebut sudah bergabung di kegiatan ini !');
                return back();
        */
         if ($data->investor->contains($investor)){
                $request->session()->flash('error','Investor ini sudah bergabung di kegiatan ini !');
                return back();

            }
        $data->investor()->attach($investor,['investor_foreign'=>$investor,'kegiatan_foreign'=>$data->id]);
        $notif =  Notifikasi::create(['nama'=>'Anda diundang ke kegiatan','pesan'=>'Anda diundang ke kegiatan '.$data->tema,'user_id'=>$investor,'redirect'=>'/investor/dashboard/kegiatan/'.$data->id,'waktu'=>now()]);
        $invNotif = User::select('notifikasi')->where('id',$investor);
        $upNotif = $invNotif->first()->notifikasi+1;
        $invNotif->update(['notifikasi'=>$upNotif]);
        $request->session()->flash('success','Investor berhasil ditambah');
        return back();



     }

      public function tambah_umkm_post(Request $request){
        $data = Kegiatan::with('umkm')->select('id')->where('id','=',$request->post('kegiatan_id'))->first();
        $umkm = $request->post('umkm_id');
        /*
        $listUmkm= $request->post('nama_umkm');
        foreach ($listUmkm as $umkm) {
            if ($data->umkm->contains($umkm['user_id'])){
                $request->session()->flash('error','umkm '. $umkm['nama_lengkap']. ' sudah bergabung di kegiatan ini !');
                return back();

            }
            ]
      */
         if ($data->umkm->contains($umkm)){
                $request->session()->flash('error','umkm ini sudah bergabung di kegiatan ini !');
                return back();

            }
        $data->umkm()->attach($umkm,['umkm_foreign'=>$umkm,'kegiatan_foreign'=>$data->id]);
             Notifikasi::create(['nama'=>'Anda diundang ke kegiatan','pesan'=>'Anda diundang ke kegiatan '.$data->tema,'user_id'=>$umkm,'redirect'=>'/umkm/dashboard/kegiatanku/'.$data->id,'waktu'=>now()]);
             
        $umkmNotif = User::select('notifikasi')->where('id',$umkm);
        $updateNotif = $umkmNotif->first()->notifikasi +1;
        $umkmNotif->update(['notifikasi'=>$updateNotif]);

        
         $request->session()->flash('success',' UMKM berhasil ditambah');
         return back();



     }


   public function hapus_investor(Request $request){
        $data = Kegiatan::where('id','=',$request->post('kegiatan_id'))->first();
        $data->investor()->detach($request->post('id'));
        $request->session()->flash('success','Investor berhasil dihapus');
        Notifikasi::create(['nama'=>'dikeluarkan dari  kegiatan','pesan'=>'Anda dikeluarkan dari kegiatan '.$data->tema,'user_id'=>$request->post('id'),'waktu'=>now()]);
        $invNotif = User::select('notifikasi')->where('id',$request->post('id'));
        $upNotif =$invNotif->first()->notifikasi+1;
        $invNotif->update(['notifikasi'=>$upNotif]);
        return back();
     }

    public function tugas_akhir(Request $request,$slug){
      $kegiatan= Kegiatan::with(['umkm','TugasAkhirJawaban'])->where('id','=',$slug)->first();
      $soal = $kegiatan->TugasAkhirSoal;
      $users = User::join('usaha','usaha.user_id','=','users.id')
                        ->join('produk','produk.user_id','=','users.id')
                        ->join('profil','profil.user_id','=','users.id')
                        ->join('kegiatan_umkm','kegiatan_umkm.umkm_id','=','users.id')
                        ->select('usaha.nama_perusahaan','users.id','produk.kategori_produk','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.provinsi','kegiatan_umkm.lulus_funding')      
                         ->filter_umkm(request(['nama_umkm','lokasi_umkm','perusahaan_umkm','produk_umkm']))
                         ->where('kegiatan_umkm.kegiatan_id','=',$slug)
                         ->orderBy('profil.nama_lengkap','asc')
                         ->paginate(10);
     $jawaban = $kegiatan->TugasAkhirJawaban()->where('user_id','=',$request->get('user_id'))->first()? $kegiatan->TugasAkhirJawaban()->where('user_id','=',$request->get('user_id'))->first():['kosong'=>'UMKM belum mengirimkan jawaban'];
      return Inertia::render('Dashboard/Kegiatan/Tugas_Akhir',['kegiatan'=>$kegiatan,'tugas'=>$soal,'targetJawaban'=>Inertia::lazy(fn () =>$jawaban),'users'=>$users]);
     }

     public function tambah_tugas(Request $request){
       $rules = [
            'soal' => 'required',
        ];


        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
        ];
      $this->validate($request, $rules, $customMessages);
      $data = [];
      $data['soal'] = $request->post('soal');
      $data['kegiatan_id'] =$request->post('kegiatan_id');
      TugasAkhirSoal::create($data);
      return back();

     }

    public function hapus_soal(Request $request){
        $data = TugasAkhirSoal::where('id','=',$request->post('id'))->delete();
        $request->session()->flash('success','Soal berhasil dihapus');
        return back();
     }


      public function hapus_jawaban(Request $request){
        $data = TugasAkhirJawaban::with('kegiatan:id,tema')->where('id','=',$request->post('id'))->delete();
        $request->session()->flash('success','Jawaban berhasil dihapus');
            Notifikasi::create(['nama'=>'jawaban ditolak','pesan'=>'Jawaban anda ditolak dari kegiatan '.$data->kegiatan->tema,'user_id'=>$data->user_id,'redirect'=>'/umkm/dashboard/kegiatan/tugas_akhir/'.$data->id,'waktu'=>now()]);
        return back();
     }

   
   public function hapus_umkm(Request $request){
        $data = Kegiatan::where('id','=',$request->post('kegiatan_id'))->first();
        $data->umkm()->detach($request->post('id'));
        $request->session()->flash('success','UMKM berhasil dihapus');
         Notifikasi::create(['nama'=>'dikeluarkan dari kegiatan','pesan'=>'Anda dikeluarkan dari kegiatan '.$data->tema,'user_id'=>$request->post('id'),'waktu'=>now()]);
        $umkmNotif = User::select('notifikasi')->where('id',$request->post('id'));
        $updateNotif = $umkmNotif->first()->notifikasi +1;
        $umkmNotif->update(['notifikasi'=>$updateNotif]);
        return back();
     }

      public function publikasi($slug){
        $data=DB::table('kegiatan')->select('id','tema','nama_juri')->where('id','=',$slug)->first();
        /*
        $items = $data->investor()->with(['profil:id,nama_lengkap,no_hp,foto_profil,user_id'])->whereHas('profil', function (Builder $query) {
            $query->orderBy('nama_lengkap','asc');})->whereHas('profil', function (Builder $query) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');})->paginate(10);
            */
         $items =User::join('usaha','usaha.user_id','=','users.id')
                        ->join('produk','produk.user_id','=','users.id')
                        ->join('profil','profil.user_id','=','users.id')
                        ->join('kegiatan_umkm','kegiatan_umkm.umkm_id','=','users.id')
                        ->select('usaha.nama_perusahaan','users.id','produk.kategori_produk','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.provinsi')      
            ->filter_umkm(request(['nama_umkm','lokasi_umkm','perusahaan_umkm','produk_umkm']))
            ->where('kegiatan_umkm.kegiatan_id','=',$slug)
            ->orderBy('profil.nama_lengkap','asc')
            ->paginate(10);
         return Inertia::render('Dashboard/Kegiatan/Publikasi',['items'=>$items,'kegiatan'=>$data]);
        
  }

  public function ubah_status_kelulusan(Request $request){
        /*
        $items = $data->investor()->with(['profil:id,nama_lengkap,no_hp,foto_profil,user_id'])->whereHas('profil', function (Builder $query) {
            $query->orderBy('nama_lengkap','asc');})->whereHas('profil', function (Builder $query) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');})->paginate(10);
            */
         $status = DB::table('kegiatan_umkm')->select('lulus_funding')->where('kegiatan_id',$request->post('kegiatan_id'))->where('umkm_id',$request->post('user_id'));
         if ($status->first()->lulus_funding) {
           $status->update(['lulus_funding'=>false]);

         }
         else{
             $tema_kegiatan = DB::table('kegiatan')->select('tema')->where('id',$request->post('kegiatan_id'))->first();
            $status->update(['lulus_funding'=>true]);
            $notif =  Notifikasi::create(['nama'=>'Anda lulus inkubasi','pesan'=>'Selamat anda lulus inkubasi kegiatan '. $tema_kegiatan->tema,'user_id'=>$request->post('user_id'),'redirect'=>'/umkm/dashboard/kegiatanku/'.$request->post('kegiatan_id'),'waktu'=>now()]);
            $umkmNotif = User::select('notifikasi','id')->where('id',$request->post('user_id'));
            $upNotif = $umkmNotif->first()->notifikasi+1;
            $umkmNotif->update(['notifikasi'=>$upNotif]);
         }
         return back();
  
  }




    


}
