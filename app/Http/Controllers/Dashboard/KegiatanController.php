<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Kegiatan;
use App\Models\Elearning;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Logbook;
use App\Models\Notifikasi;
use App\Models\BabElearning;
use App\Models\Eventual;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class KegiatanController extends Controller
{

    public function list_eventual(Request $request,$page1,$page2){
        $data = Eventual::fetchAndPaginate($limit=10,$offset=$page2,$kegiatan_id=$page1);
        $kegiatan = DB::table('kegiatan')->select('tema','id')->where('id','=',$page1)->first();
        return Inertia::render('Dashboard/Kegiatan/List_eventual',['items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last'],
                                                           'kegiatan'=>$kegiatan]);
    }

    public function ubah_eventual_status(Request $request){
        $data = [];
        $data['jadwal'] = $request->post('jadwal');
        $data['link_meeting'] = $request->post('link_meeting');
        $data['status']  = intval($request->post('status'));
        Eventual::where('id','=',$request->post('id'))->update($data);
        $request->session()->flash('success','Status eventual berhasil diubah');
        return back();
    }

    public function edit_deskripsi(Request $request){
        $data = [];
        $data['deskripsi'] = $request->post('deskripsi');
         if ($request->file('gambar')) {
             $gambar= $request->file('gambar')->store('umkm/logbook','public') ;
             $data['gambar']= $gambar;
        };
         Kegiatan::where('id','=',$request->post('id'))->update($data);
         $request->session()->flash('success','Deskripsi kegiatan berhasil diubah');
         return back();
    }

    public function list_elearning(Request $request,$page1,$page2){
        $data = Elearning::fetchAndPaginate($limit=10,$offset=$page2,$kegiatan_id=$page1);
        $kegiatan = DB::table('kegiatan')->select('tema','id')->where('id','=',$page1)->first();
        return Inertia::render('Dashboard/Kegiatan/List_elearning',['items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last'],
                                                           'kegiatan'=>$kegiatan]);
    }

    public function tambah_elearning($id){
        $kegiatan = DB::table('kegiatan')->select('tema')->where('id','=',$id)->first();
        return Inertia::render('Dashboard/Kegiatan/Tambah_elearning',['kegiatan'=>$kegiatan]);
    }

    public function list_bab(Request $request,$id,$page){
        $data = BabElearning::fetchAndPaginate($limit=10,$page=$page,$elearning_id = $id);
        $elearning = DB::table('elearning')->select('judul','kegiatan_id')->where('id','=',$id)->first();
        return Inertia::render('Dashboard/Kegiatan/Bab_elearning',['items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last'],
                                                           'elearning'=>$elearning]);
    }

    public function tambah_bab(Request $request,$id){
        $elearning = DB::table('elearning')->select('judul')->where('id','=',$id)->first();
        return Inertia::render('Dashboard/Kegiatan/Tambah_bab',['elearning'=>$elearning]);
    }

    public function edit_bab(Request $request,$id){
        $bab = DB::table('bab')->select('judul','deskripsi','link_video','bab','id')->where('id','=',$id)->first();
        return Inertia::render('Dashboard/Kegiatan/Edit_bab',['bab'=>$bab]);
    }


    public function edit_bab_post(Request $request){
         $rules = [
            'deskripsi' => 'required',
            'judul' => 'required',
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
        BabElearning::where('id','=',$request->post('id'))->update($data);
        $request->session()->flash('success','Bab berhasil diubah');
        return back();
    }


    public function tambah_bab_post(Request $request){
        $rules = [
            'deskripsi' => 'required',
            'judul' => 'required',
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
        $data['elearning_id'] = $request->post('id');
        $data['judul'] = $request->post('judul');
        $data['link_video'] = $request->post('link_video');
        $data['bab'] = $request->post('bab');
        $request->session()->flash('success','Bab berhasil ditambah');
        BabElearning::create($data);
        return back();
    }



    public function add_elearning(Request $request){
       
          $rules = [
            'waktu' => 'required',
            'judul' => 'required',
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
        Elearning::create($data);
        $request->session()->flash('success','Elearning berhasil ditambah');
        return back();
    }

    public function edit_elearning_view(Request $request,$slug){
       
    $data =  DB::table('elearning')->select('hari_tanggal_waktu','deskripsi','judul','foto')->where('id','=',$slug)->first();
    return Inertia::render('Dashboard/Kegiatan/Edit_elearning',['elearning'=>$data]);

    }


    public function detail_elearning(Request $request,$slug){
       
        $data =  DB::table('elearning')->select('hari_tanggal_waktu','deskripsi','judul','foto')->where('id','=',$slug)->first();
        return Inertia::render('Dashboard/Kegiatan/Edit_elearning',['elearning'=>$data]);

    }

    public function edit_elearning_post(Request $request){
       
        $rules = [
            'waktu' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

        $this->validate($request, $rules, $customMessages);
        $elearning = Elearning::where('id','=',$request->post('id'));
        $old_gambar = DB::table('elearning')->select('gambar')->where('id','=',$request->post('id'))->first();
        $data = [];
        if ($request->file('gambar')) {
              Storage::delete($old_gambar->gambar);
              $gambar= $request->file('gambar')->store('elearning/gambar','public') ;
              $data['foto'] = $gambar;
        }
        $data['hari_tanggal_waktu'] = $request->post('waktu');
        $data['judul'] = $request->post('judul');
        $data['deskripsi'] = $request->post('deskripsi');
        $elearning->update($data);
        $request->session()->flash('success','Elearning berhasil diubah');
        return back();
    }
    public function hapus_kegiatan(Request $request){
        $session = '';
        $message = '';
        $delete = Kegiatan::where('id','=',$request->post('id'))->delete();
        if ($delete) {
            $session = 'success';
            $message = 'Kegiatan berhasil dihapus !';
        }
        else{
            $session = 'error';
            $message = 'Ada kesalahan !';
        }
        $request->session()->flash($session,$message);
    
        return back();
    }

     public function hapus_elearning(Request $request){
        $session = '';
        $message = '';
        $delete =  Elearning::where('id','=',$request->post('id'))->delete();
        if ($delete) {
            $session = 'success';
            $message = 'Kegiatan berhasil dihapus !';
        }
        else{
            $session = 'error';
            $message = 'Ada kesalahan !';
        }
        $request->session()->flash($session,$message);
    
        return back();
    }
    public function hapus_bab(Request $request,$id){
        $session = '';
        $message = '';
        $delete =  BabElearning::where('id','=',$request->post('id'))->delete();
        if ($delete) {
            $session = 'success';
            $message = 'Kegiatan berhasil dihapus !';
        }
        else{
            $session = 'error';
            $message = 'Ada kesalahan !';
        }
        $request->session()->flash($session,$message);
        return back();
    }
    public function eventual(Request $request,$id){
        $event = Eventual::where('id','=',$id)->select('profil_id','jadwal','kegiatan_id')->first();
        $kegiatan = Kegiatan::where('id','=',$event->kegiatan_id)->select('tema')->first();
        $user = Profil::where('user_id','=',$event->profil_id)->select('id')->first();
        Notifikasi::create(['nama'=>'Eventual Dibatalkan','pesan'=>'Eventual yang anda minta pada kegiatan '.$kegiatan->tema.' tanggal '.$event->jadwal. ' sudah dihapus. Kontak admin bila terjadi kesalahan','user_id'=>$user->id,'tanggal'=>now()]);
        $event->delete();
        $request->session()->flash('success','eventual berhasil ditolak !');
        return back();
    }

    public function list_logbook($page1,$page2){
        $data = User::fetchAndPaginate4Inkubasi($limit=10,$page=$page2,$kegiatan_id=$page1);
        $kegiatan =  DB::table('kegiatan')->select('tema','id')->where('id','=',$page1)->first();
        return Inertia::render('Dashboard/Kegiatan/Daftar_logbook',['items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last'],
                                                           'kegiatan'=>$kegiatan],);
    }

    public function list_user_logbook($page1,$id_user,$page2){
        $data = Logbook::fetchAndPaginate($limit=10,$page=$page2,$user_id=$id_user,$kegiatan_id=$page1);
        $kegiatan =  DB::table('kegiatan')->select('tema','id')->where('id','=',$page1)->first();
        return Inertia::render('Dashboard/Kegiatan/List_user_logbook',['items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last'],
                                                           'kegiatan'=>$kegiatan],);
    }

    public function ubah_status_logbook(Request $request){
        $data = Logbook::where('id','=',$request->post('id'))->update(['status'=>$request->post('status')]);
        $kegiatan = DB::table('kegiatan')->select('tema')->where('id','=',$request->post('kegiatan_id'))->first();
        if ($request->post('status') == 1) {
          Notifikasi::create(['nama'=>'Laporan anda ditrima','pesan'=>'Selamat!,laporan anda pada kegiatan '.$kegiatan->tema.' di waktu '.$request->post('waktu').' diterima!','user_id'=>$request->post('user_id'),'tanggal'=>now()]);
        }
        else{
        Notifikasi::create(['nama'=>'Laporan anda ditolak','pesan'=>'Mohon perbaiki lagi laporannya pada kegiatan'.$kegiatan->tema.' di waktu '.$request->post('waktu'),'user_id'=>$request->post('user_id'),'tanggal'=>now()]);
        }
        return back();
    }


    public function detail_kegiatan($page){
        $kegiatan = DB::table('kegiatan')->select('tema','deskripsi','id','gambar')->where('id','=',$page)->first();
        return Inertia::render('Dashboard/Kegiatan/Edit_deskripsi',['kegiatan'=>$kegiatan]);
    }
    public function index($page){
        $data = Kegiatan::fetchAndPaginate($limit=10,$offset=$page);
        //dd($data['items']);
        return Inertia::render('Dashboard/Kegiatan/Daftar_kegiatan',['items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last']],);
    }

    public function tambah(){
        $roles = DB::table('roles')->select('user_id')->where('number','=',3)->get();
        $investor = [];
        foreach ($roles as $role) {
            $target = DB::table('profil')->select('nama_lengkap','no_hp')->where('user_id','=',$role->user_id)->first();
        
            $investor[] = $target->nama_lengkap . '/' . $target->no_hp ;
        }
        return Inertia::render('Dashboard/Kegiatan/tambah_kegiatan',['investor'=>$investor]);
    }

    public function edit_kegiatan($slug){
        $roles = DB::table('roles')->select('user_id')->where('number','=',3)->get();
        $investor = [];
        foreach ($roles as $role) {
            $target = DB::table('profil')->select('nama_lengkap','no_hp')->where('user_id','=',$role->user_id)->first();
        
            $investor[] = $target->nama_lengkap . '/' . $target->no_hp ;
        }
        $kegiatan =  DB::table('kegiatan')->select('tema','deskripsi','jumlah_orang_diundang','masa_inkubasi','kurikulum','nama_juri','pic','kontak','draft','dimulai','berakhir','gambar')->where('id','=',$slug)->first();
        $tempOldInvestor = DB::table('kegiatan_investor')->select('investor_id')->where('kegiatan_id','=',$slug)->get();
        $oldInvestor = [];
        foreach ($tempOldInvestor as $oldInv ) {
            $target = DB::table('profil')->select('nama_lengkap','no_hp')->where('user_id','=',$oldInv->investor_id)->first();
        
            $oldInvestor[] = $target->nama_lengkap . '/' . $target->no_hp ;
        }
        return Inertia::render('Dashboard/Kegiatan/Edit_kegiatan',['investor'=>$investor,'kegiatan'=>$kegiatan,'oldInvestor'=>$oldInvestor]);
    }


    public function edit_kegiatan_post(Request $request){
        $validatedData = $request->validate([
            'tema' => 'required',
            'deskripsi' => 'required',
            'jumlah_orang_diundang'=>'required',
            'nama_investor'=>'required',
            'masa_inkubasi'=>'required',
            'kurikulum'=>'required',
            'nama_juri'=>'required',
            'pic'=>'required',
            'kontak'=>'required',
            'draft'=>'required',
            'dimulai'=>'required',
            'berakhir' =>'required',
        ]);
      $daftarInvestor =$request->post('nama_investor');
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
                'berakhir' =>$request->post('berakhir'),
                'link'=>Str::random(100),];
    $kegiatan = Kegiatan::where('id','=',$request->post('id'))->first();
    if ($request->file('gambar')) {
         Storage::delete($kegiatan->gambar);
         $update['gambar'] = $request->file('gambar')->store('kegiatan/gambar','public');
    }
    
      $kegiatan->update($update);
      $listInvestor = [];
      foreach ($daftarInvestor as $investor) {
        $target = DB::table('profil')->select('user_id')->where('no_hp','=',explode('/',$investor)[1])->first();
        $listInvestor[] = $target->user_id ;
      }
      $kegiatan->investor()->sync($listInvestor);
      $request->session()->flash('success','Kegiatan berhasil dibuat');

      return back();
    }

    public function add(Request $request)
    {
        //dd($request->all());

         $rules = [
            'tema' => 'required',
            'deskripsi' => 'required',
            'jumlah_orang_diundang'=>'required',
            'nama_investor'=>'required',
            'masa_inkubasi'=>'required',
            'kurikulum'=>'required',
            'nama_juri'=>'required',
            'pic'=>'required',
            'kontak'=>'required',
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
                                    'draft'=>$request->post('draft') == true ? 1:0,
                                    'dimulai'=>$request->post('dimulai'),
                                    'berakhir' =>$request->post('berakhir'),
                                    'link'=>Str::random(100),
                                    'gambar'=>$gambar]);
      $listInvestor = [];
      foreach ($daftarInvestor as $investor) {
        $target = DB::table('profil')->select('user_id')->where('no_hp','=',explode('/',$investor)[1])->first();
        $listInvestor[] = $target->user_id ;
      }
      $kegiatan->investor()->attach($listInvestor);
      $request->session()->flash('success','Kegiatan berhasil dibuat');

      return back();

    }




    


}
