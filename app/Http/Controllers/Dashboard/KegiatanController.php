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
use App\Models\Role;
use App\Models\Logbook;
use App\Models\Notifikasi;
use App\Models\BabElearning;
use App\Models\Eventual;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class KegiatanController extends Controller
{

    public function list_eventual(Request $request,$page1){
  
    $data = Eventual::with(['profil'])->where('kegiatan_id','=',$page1)->orderBy('waktu','asc')->paginate(10);
  //  $data = Eventual::select('id','status','perihal','link_meeting','kontak','nama_mentor','jadwal')->where('kegiatan_id','=',$page1)->orderBy('waktu','asc')->paginate(10);
    
    $kegiatan = Kegiatan::select('tema','id')->where('id','=',$page1)->first();
        return Inertia::render('Dashboard/Kegiatan/List_eventual',['items'=>$data, 'kegiatan'=>$kegiatan]);
    }

    public function ubah_eventual_status(Request $request){
        $data = [];
        $data['jadwal'] = $request->post('jadwal');
        $data['link_meeting'] = $request->post('link_meeting');
        $data['status']  = intval($request->post('status'));
        $event= Eventual::where('id','=',$request->post('id'));
        $event->update($data);
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

    public function list_elearning(Request $request,$page1){

        $data = Elearning::select('elearning.id','elearning.judul','elearning.deskripsi','elearning.foto','elearning.id','elearning.hari_tanggal_waktu')->where('kegiatan_id','=',$page1)->orderBy('hari_tanggal_waktu','asc')->paginate(10);
        $kegiatan = Kegiatan::select('tema','id')->where('id','=',$page1)->first();
        return Inertia::render('Dashboard/Kegiatan/List_elearning',['items'=>$data,
                                                           'kegiatan'=>$kegiatan]);
    }

    public function tambah_elearning($id){
        $kegiatan = Kegiatan::select('tema')->where('id','=',$id)->first();
        return Inertia::render('Dashboard/Kegiatan/Tambah_elearning',['kegiatan'=>$kegiatan]);
    }

    public function list_bab(Request $request,$id){
        $data = BabElearning::select("bab.id",'bab.judul','bab.deskripsi','bab.bab',"bab.link_video")->where('elearning_id','=',$id)->orderBy('bab','asc')->paginate(10);
        $elearning = DB::table('elearning')->select('judul','kegiatan_id')->where('id','=',$id)->first();
        return Inertia::render('Dashboard/Kegiatan/Bab_elearning',['items'=>$data,
                                                           'elearning'=>$elearning]);
    }

    public function tambah_bab(Request $request,$id){
        $elearning = Elearning::select('judul')->where('id','=',$id)->first();
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
        $data['elearning_id'] = $request->post('elearning_id');
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
       
    $data =   Elearning::select('hari_tanggal_waktu','deskripsi','judul','foto')->where('id','=',$slug)->first();
    return Inertia::render('Dashboard/Kegiatan/Edit_elearning',['elearning'=>$data]);

    }


    public function detail_elearning(Request $request,$slug){
       
        $data =  Elearning::select('hari_tanggal_waktu','deskripsi','judul','foto')->where('id','=',$slug)->first();
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
        $old_gambar = DB::table('elearning')->select('foto')->where('id','=',$request->post('id'))->first();
        $data = [];
        if ($request->file('gambar')) {
              Storage::delete($old_gambar->foto);
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
    public function hapus_eventual(Request $request,$id){
        $event = Eventual::where('id','=',$id)->select('profil_id','jadwal','kegiatan_id')->first();
        Notifikasi::create(['nama'=>'Eventual Dibatalkan','pesan'=>'Eventual yang anda minta pada kegiatan '.$event->kegiatan->tema.' tanggal '.$event->jadwal. ' sudah dihapus. Kontak admin bila terjadi kesalahan','user_id'=>$event->profil->user_id,'tanggal'=>now()]);
        $event = Eventual::where('id','=',$id);
        $event->delete();
        $request->session()->flash('success','eventual berhasil ditolak !');
        return back();
    }

    public function list_logbook($page1){
        $user_id = [];
        $list_participants = DB::table('kegiatan_umkm')->select('umkm_id')->where('kegiatan_id','=',$page1)->get();
        foreach($list_participants as $participants){
           $user_id[] = ($participants->umkm_id);
        }
        $data = User::with('profil')->whereIn('id', $user_id)->paginate(10);
 
        $kegiatan =  DB::table('kegiatan')->select('tema','id')->where('id','=',$page1)->first();
        return Inertia::render('Dashboard/Kegiatan/Daftar_logbook',['items'=>$data,
                                                           'kegiatan'=>$kegiatan],);
    }

    public function list_user_logbook($page1,$id_user){
      //  $data = Logbook::fetchAndPaginate($limit=10,$page=$page2,$user_id=$id_user,$kegiatan_id=$page1);
        $data= Logbook::where('user_id','=',$id_user)->where('kegiatan_id','=',$page1)->paginate(10);
        $kegiatan =  DB::table('kegiatan')->select('tema','id')->where('id','=',$page1)->first();
        return Inertia::render('Dashboard/Kegiatan/List_user_logbook',['items'=>$data,
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
    public function index(){
        $data = Kegiatan::select('tema','dimulai','berakhir','link','draft','jumlah_orang_diundang','kegiatan.id'
            ,DB::raw('count(umkm_id) as total_peserta'))->leftJoin('kegiatan_umkm','kegiatan_umkm.kegiatan_id','=','kegiatan.id' )
            ->groupBy('kegiatan.id','kegiatan.dimulai','kegiatan.berakhir','kegiatan.link','kegiatan.draft','kegiatan.jumlah_orang_diundang','kegiatan.tema','kegiatan.id')
            ->orderBy('kegiatan.dimulai','asc')
            ->paginate(10);   

        //dd($data['items']);
        return Inertia::render('Dashboard/Kegiatan/Daftar_kegiatan',['items'=>$data]);
    }

    public function tambah(){
        $roles = Role::select('user_id')->where('number','=',3)->get();
        $investor = [];
        foreach ($roles as $role) {
             $investor[] = $role->user->profil->nama_lengkap . '/' . $role->user->profil->no_hp ;
        }
        $roles = Role::select('user_id')->where('number','=',2)->get();
        $umkm = [];
        foreach ($roles as $role) {        
            $umkm[] = $role->user->profil->nama_lengkap . '/' . $role->user->profil->no_hp ;
        }
        return Inertia::render('Dashboard/Kegiatan/tambah_kegiatan',['investor'=>$investor,'umkm'=>$umkm]);
    }

    public function edit_kegiatan($slug){
        $roles = Role::select('user_id')->where('number','=',3)->get();
        $investor = [];
        foreach ($roles as $role) {
            $investor[] = $role->user->profil->nama_lengkap . '/' . $role->user->no_handphone  ;
        }
        $kegiatan =  Kegiatan::select('kegiatan.tema','kegiatan.deskripsi','kegiatan.nama_juri','kegiatan.masa_inkubasi','kegiatan.pic','kegiatan.kontak','kegiatan.id','kegiatan.dimulai','kegiatan.berakhir','kegiatan.jumlah_orang_diundang','kegiatan.kurikulum','kegiatan.gambar','kegiatan.draft')->where('id','=',$slug)->first();
       
        $oldInvestor = [];
       // dd($kegiatan->investor);
        foreach ($kegiatan->investor as $oldInv ) {
    
            $oldInvestor[] = $oldInv->profil->nama_lengkap . '/' . $oldInv->profil->no_hp ;
        }

        $roles = Role::select('user_id')->where('number','=',2)->get();
        $umkm = [];
        foreach ($roles as $role) {
        
            $umkm[] = $role->user->profil->nama_lengkap . '/' . $role->user->profil->no_hp ;
        }
        $oldUmkm = [];
        foreach ($kegiatan->umkm as $old_umkm ) {
            $oldUmkm[] = $old_umkm->profil->nama_lengkap . '/' . $old_umkm->profil->no_hp ;
        }


        return Inertia::render('Dashboard/Kegiatan/Edit_kegiatan',['umkm'=>$umkm,'oldUmkm'=>$oldUmkm,'investor'=>$investor,'kegiatan'=>$kegiatan,'oldInvestor'=>$oldInvestor]);
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
      $daftarUmkm = $request->post('nama_umkm');
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
      $listUmkm = [];
      foreach ($daftarUmkm as $umkm) {
        $target = DB::table('profil')->select('user_id')->where('no_hp','=',explode('/',$umkm)[1])->first();
        $listUmkm[] = $target->user_id ;
      }
      $kegiatan->investor()->sync($listInvestor);
      $kegiatan->umkm()->sync($listUmkm);
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
                                    'link'=>Str::random(100),
                                    'gambar'=>$gambar]);
      $listInvestor = [];
      foreach ($daftarInvestor as $investor) {
        $target = DB::table('profil')->select('user_id')->where('no_hp','=',explode('/',$investor)[1])->first();
        $listInvestor[] = $target->user_id ;
      }
      $kegiatan->investor()->attach($listInvestor);

      $listUmkm = [];
      foreach ($daftarUmkm as $umkm) {
        $target = DB::table('profil')->select('user_id')->where('no_hp','=',explode('/',$umkm)[1])->first();
        $listUmkm[] = $target->user_id ;
      }
      $kegiatan->umkm()->attach($listUmkm);
      $request->session()->flash('success','Kegiatan berhasil dibuat');

      return back();

    }




    


}
