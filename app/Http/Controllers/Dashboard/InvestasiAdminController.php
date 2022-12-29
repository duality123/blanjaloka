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
use App\Models\Janjitemu;
use App\Models\Notifikasi;
use App\Models\BabElearning;
use App\Models\Eventual;
use App\Models\Profil;
use App\Models\Bisnis;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class InvestasiAdminController extends Controller{

  public function index(){
        $data =Bisnis::select('bisnis.name','jumlah_investasi','target_investasi','jumlah_investor','bisnis.id','kategori','minimum_investasi'
            ,DB::raw('count(umkm_id) as total_umkm'))->leftJoin('bisnis_peserta','bisnis_peserta.bisnis_id','=','bisnis.id' )
            ->groupBy('jumlah_investasi','target_investasi','jumlah_investor','bisnis.id','kategori','minimum_investasi','bisnis.name')
            ->orderBy('bisnis.waktu_balik_modal_end','desc')
            ->paginate(10);   

        //dd($data['items']);
        return Inertia::render('Dashboard/Investasi/Daftar_investasi',['items'=>$data]);
    }
	 public function create(){
	 	$roles = Role::select('user_id')->where('number','=',3)->get();
        $investor = [];
        foreach ($roles as $role) {
             $investor[] = $role->user->profil->nama_lengkap . '/' . $role->user->profil->no_hp ;
        }
	 	return Inertia::render('Dashboard/Investasi/Tambah_investasi',['investor'=>$investor]);

	 }

	  public function tambah_investasi(Request $request){

	  	//dd($request->all());
	 	  $rules = [
            'name' => 'required|max:255',
  			'foto_bisnis'=>'required', 
  			'jumlah_investasi'=>'required' ,
  			'target_investasi'=>'required',
 	 		'jumlah_investor'=>'required|numeric|max:8000000',
  			'waktu_balik_modal_start'=>'required',
  			'waktu_balik_modal_end'=>'required',
  			'minimum_investasi'=>'required',
  			'persentase_hasil_investasi'=>'required|numeric|max:32767',
  			'kategori'=>'required' , 
  			'lokasi' =>'required',
  			'nama_investor'=>'required'
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
   // dd($request->post('berakhir'));
      $this->validate($request, $rules, $customMessages);
      $data = [];
        
        $data['name'] =$request->post('name');
        $data['jumlah_investor'] = $request->post('jumlah_investor');
        $data['minimum_investasi'] = $request->post('minimum_investasi');
        $data['kategori'] =  $request->post('kategori');
        $data['jumlah_investasi']=$request->post('jumlah_investasi');
        $data['target_investasi'] =$request->post('target_investasi');
        $data['lokasi']=  $request->post('lokasi');
        $data['waktu_balik_modal_start']=$request->post('waktu_balik_modal_start');
        $data['waktu_balik_modal_end']=$request->post('waktu_balik_modal_end');
        $data['foto_bisnis'] = '';
        $data['persentase_hasil_investasi'] = $request->post('persentase_hasil_investasi');
        $data['status'] = $request->post('status') ;
       // dd($data['status']);
       // dd($data['persentase_hasil_investasi']);
        $tempFoto = '';
        foreach ($request->file('foto_bisnis') as $foto) {
             $foto_bisnis = $foto->store('investor/foto_bisnis','public');
             $tempFoto = $tempFoto.','.$foto_bisnis;
                     
        }
        $data['foto_bisnis'] = $tempFoto ;

       $bisnis= Bisnis::create($data);
         $daftarInvestor =$request->post('nama_investor');
         $listInvestor = [];
	      foreach ($daftarInvestor as $investor) {
	        $target = DB::table('profil')->select('user_id')->where('no_hp','=',explode('/',$investor)[1])->first();
	        $listInvestor[] = $target->user_id ;
	      }
      $bisnis->investor()->attach($listInvestor);

      $request->session()->flash('success','Bisnis berhasil ditambah');
      return back();

	 }

	   public function edit_investasi_post(Request $request){

	  	//dd($request->all());
	 	  $rules = [
            'name' => 'required|max:255',
  			'foto_bisnis'=>'required', 
  			'jumlah_investasi'=>'required' ,
  			'target_investasi'=>'required',
 	 		'jumlah_investor'=>'required|numeric|max:8000000',
  			'waktu_balik_modal_start'=>'required',
  			'waktu_balik_modal_end'=>'required',
  			'minimum_investasi'=>'required',
  			'persentase_hasil_investasi'=>'required|numeric|max:32767',
  			'kategori'=>'required' , 
  			'lokasi' =>'required',
  			'nama_investor'=>'required'
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
   // dd($request->post('berakhir'));
      $this->validate($request, $rules, $customMessages);
      $data = [];
        
        $data['name'] =$request->post('name');
        $data['jumlah_investor'] = $request->post('jumlah_investor');
        $data['minimum_investasi'] = $request->post('minimum_investasi');
        $data['kategori'] =  $request->post('kategori');
        $data['jumlah_investasi']=$request->post('jumlah_investasi');
        $data['target_investasi'] =$request->post('target_investasi');
        $data['lokasi']=  $request->post('lokasi');
        $data['waktu_balik_modal_start']=$request->post('waktu_balik_modal_start');
        $data['waktu_balik_modal_end']=$request->post('waktu_balik_modal_end');
        $data['foto_bisnis'] = '';
        $data['persentase_hasil_investasi'] = $request->post('persentase_hasil_investasi');
        $data['status'] = $request->post('status') ;
       // dd($data['status']);
       // dd($data['persentase_hasil_investasi']);
        $tempFoto = '';
        if ($request->file('foto_bisnis')) {
       		foreach ($request->file('foto_bisnis') as $foto) {
             $foto_bisnis = $foto->store('investor/foto_bisnis','public');
             $tempFoto = $tempFoto.','.$foto_bisnis;
                     
        }
        $data['foto_bisnis'] = $tempFoto ;
        }


       	 $bisnis = Bisnis::where('id','=',$request->post('id'))->first();
       	 $bisnis->update($data);
         $daftarInvestor =$request->post('nama_investor');
         $listInvestor = [];
	     foreach ($daftarInvestor as $investor) {
	        $target = DB::table('profil')->select('user_id')->where('no_hp','=',explode('/',$investor)[1])->first();
	        $listInvestor[] = $target->user_id ;
	      }

	     $daftarUmkm =$request->post('nama_umkm');
         $listUmkm = [];
	     foreach ($daftarUmkm as $umkm) {
	        $target = DB::table('profil')->select('user_id')->where('no_hp','=',explode('/',$umkm)[1])->first();
	        $listUmkm[] = $target->user_id ;
	      }
      $bisnis->investor()->sync($listInvestor);
      $bisnis->umkm()->sync($listUmkm);

      $request->session()->flash('success','Bisnis berhasil ditambah');
      return back();

	 }

	 public function edit_investasi(Request $request,$slug){
        $roles = Role::select('user_id')->where('number','=',3)->get();
        $investor = [];
        foreach ($roles as $role) {
            $investor[] = $role->user->profil->nama_lengkap . '/' . $role->user->no_handphone  ;
        }
        $roles = Role::select('user_id')->where('number','=',2)->get();
        $umkm = [];
        foreach ($roles as $role) {
            $umkm[] = $role->user->profil->nama_lengkap . '/' . $role->user->profil->no_hp  ;
        }
        $bisnis =  Bisnis::where('id','=',$slug)->first();
        $oldInvestor = [];
       // dd($kegiatan->investor);
        foreach ($bisnis->investor as $oldInv ) {
    
            $oldInvestor[] = $oldInv->profil->nama_lengkap . '/' . $oldInv->profil->no_hp ;
        }
        $oldUmkm = [];
       // dd($kegiatan->investor);
        foreach ($bisnis->umkm as $old_umkm ) {
    
            $oldUmkm[] = $old_umkm->profil->nama_lengkap . '/' . $old_umkm->profil->no_hp ;
        }


        return Inertia::render('Dashboard/Investasi/Edit_investasi',['umkm'=>$umkm,'investor'=>$investor,'bisnis'=>$bisnis,'oldInvestor'=>$oldInvestor,'oldUmkm'=>$oldUmkm]);
    }


	 public function delete(Request $request){
	 	Bisnis::where('id','=',$request->post('id'))->delete();
	 	$request->session()->flash('success','Bisnis berhasil dihapus');
      	return back();
	 }
	 public function detail_investasi(Request $request,$slug){

	 	$data= Bisnis::select('foto_bisnis','name','lokasi','kategori')->where('id','=',$slug)->first();
	 	return Inertia::render('Dashboard/Investasi/Detail_investasi',['bisnis'=>$data]);



	 }

}