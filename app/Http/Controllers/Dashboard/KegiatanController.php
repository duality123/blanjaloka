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
use Illuminate\Support\Str;
class KegiatanController extends Controller
{
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
        return Inertia::render('Dashboard/Kegiatan/List_elearning',['items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last']],);
    }

    public function tambah_elearning($page){
        return Inertia::render('Dashboard/Kegiatan/Tambah_elearning',['items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last']],);
    }

    public function hapus_kegiatan($id){
        Kegiatan::where('id','=',$id)->delete();
    }

    public function list_logbook($page1,$page2){
        $data = User::fetchAndPaginate4Inkubasi($limit=10,$page=$page2,$kegiatan_id=$page1);
        return Inertia::render('Dashboard/Kegiatan/Daftar_logbook',['items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last']],);
    }

    public function list_user_logbook($page1,$id_user,$page2){
        $data = Logbook::fetchAndPaginate($limit=10,$page=$page2,$user_id=$id_user,$kegiatan_id=$page1);
        return Inertia::render('Dashboard/Kegiatan/List_user_logbook',['items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last']],);
    }

    public function ubah_status_logbook(Request $request){
        $data = Logbook::where('id','=',$request->post('id'))->update(['status'=>$request->post('status')]);
        if ($request->post('status') == 1) {
          Notifikasi::create(['nama'=>'Laporan anda ditrima','pesan'=>'Selamat!,laporan anda diterima !','user_id'=>$request->post('user_id'),'tanggal'=>now()]);
        }
        else{
        Notifikasi::create(['nama'=>'Laporan anda ditolak','pesan'=>'Mohon perbaiki lagi laporannya !','user_id'=>$request->post('user_id'),'tanggal'=>now()]);
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
    if ($request->file('gambar')) {
         $update['gambar'] = $request->file('gambar')->store('kegiatan/gambar','public');
    }
      $kegiatan = Kegiatan::where('id','=',$request->post('id'))->first();
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
            'gambar'=>'required'
        ]);
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

    public function update(Request $request,$id){
      $validatedData = $request->validate([
          'tema' => 'required',
          'deskripsi' => 'required',
          'jumlah_orang_diundang' => 'required',
          'juri'=>'required',
          'investor'=>'required',
          'masa_inkubasi'=>'required',
          'kurikulum'=>'required',
          'pic'=>'required',
          'kontak'=>'required'
      ]);
      $data = Kegiatan::where('id',$id)->firstOrFail();
      $data->update($request->all());
      $daftarJuri = explode(',',$request->juri);
      $daftarInvestor = explode(',',$request->investor);
      $kegiatan->investor()->sync($daftarInvestor);

      return response(['message'=>'item edited', 'meta'=>$kegiatan]);
    }


    


}
