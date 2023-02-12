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
use App\Models\Janjitemu;
use App\Models\Notifikasi;
use App\Models\BabElearning;
use App\Models\Eventual;
use App\Models\Profil;
use App\Models\User;
use App\Models\Investasi;
use App\Models\Bisnis;
use App\Models\Funding;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class InvestasiAdminController extends Controller{

  public function index(){
    /*
        $data =Bisnis::select('bisnis.name','jumlah_investasi','foto_bisnis','target_investasi','bisnis.id','kategori','minimum_investasi'
            ,DB::raw('count(umkm_id) as total_umkm'),DB::raw('count(investor_id) as total_investor'))->leftJoin('bisnis_peserta','bisnis_peserta.bisnis_id','=','bisnis.id' )
            ->leftJoin('bisnis_investor','bisnis_investor.bisnis_id','=','bisnis.id' )
            ->groupBy('jumlah_investasi','target_investasi','jumlah_investor','bisnis.id','kategori','minimum_investasi','bisnis.name','bisnis.foto_bisnis')
            ->orderBy('bisnis.waktu_balik_modal_end','desc')
            ->filter(request(['cari']))
            ->paginate(10);   
    */
            $data = Bisnis::select('name','total_penghasilan','target_investasi','waktu_balik_modal_end','foto_bisnis','persentase_hasil_investasi','id')->orderBy('bisnis.waktu_balik_modal_end','desc')
            ->filter(request(['cari']))
            ->paginate(10);
        //dd($data['items']);
        return Inertia::render('Dashboard/Investasi/Daftar_investasi',['items'=>$data]);
    }
	 public function tambah_investasi(){
	 	return Inertia::render('Dashboard/Investasi/Tambah_investasi');

	 }

	  public function tambah_investasi_post(Request $request){
	  	//dd($request->all());
	 	  $rules = [
            'name' => 'required|max:255',
  			'foto_bisnis'=>'required', 
  			'jumlah_investasi'=>'required' ,
  			'target_investasi'=>'required',
 	 		'jumlah_investor'=>'required|numeric|max:8000000',
  			'waktu_balik_modal_start'=>'required',
  			'waktu_balik_modal_end'=>'required',
  			'kategori'=>'required|max:50' , 
            'minimum_investasi'=>'required|numeric',
  			'lokasi' =>'required',

           
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .',
            'numeric'=>'Karakter wajib numerik'

        ];
   // dd($request->post('berakhir'));
        $this->validate($request, $rules, $customMessages);
        $data = [];
        
        $data['name'] =$request->post('name');
        $data['jumlah_investor'] = $request->post('jumlah_investor');
        $data['minimum_investasi'] = $request->post('minimum_investasi');
        $data['kategori'] =  $request->post('kategori');
        $data['jumlah_investasi']=$request->post('jumlah_investasi');
        $data['total_penghasilan']=$request->post('jumlah_investasi');
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
             $foto_bisnis = $foto->store('investasi/foto_bisnis','public');
             $tempFoto = $tempFoto.','.$foto_bisnis;
                     
        }
        $data['foto_bisnis'] = $tempFoto ;

       $bisnis= Bisnis::create($data);
       


      $request->session()->flash('success','Bisnis berhasil ditambah');
      return redirect('/admin/investasi/'.$bisnis->id.'/investor');

	 }

	   public function edit_investasi_post(Request $request){
        //dd($request->post('foto_bisnis'));
	  	//dd($request->all());
	 	 $rules = [
            'name' => 'required|max:255',
            'foto_bisnis'=>'required', 
            'jumlah_investasi'=>'required' ,
            'target_investasi'=>'required',
            'jumlah_investor'=>'required|numeric|max:8000000',
            'waktu_balik_modal_start'=>'required',
            'waktu_balik_modal_end'=>'required',
            'kategori'=>'required|max:50' , 
            'persentase_hasil_investasi'=>'required',
            'minimum_investasi'=>'required|numeric',
            'total_penghasilan'=>'required|numeric',
            'lokasi' =>'required',

           
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .',
            'numeric'=>'input wajib numeric'

        ];
   // dd($request->post('berakhir'));
          $this->validate($request, $rules, $customMessages);
          $data = [];
        
        $data['name'] =$request->post('name');
        $data['jumlah_investor'] = $request->post('jumlah_investor');
        $data['minimum_investasi'] = $request->post('minimum_investasi');
        $data['kategori'] =  $request->post('kategori');
        $data['jumlah_investasi']=$request->post('jumlah_investasi');
        $data['total_penghasilan']=$request->post('total_penghasilan');
        $data['target_investasi'] =$request->post('target_investasi');
        $data['lokasi']=  $request->post('lokasi');
        $data['waktu_balik_modal_start']=$request->post('waktu_balik_modal_start');
        $data['waktu_balik_modal_end']=$request->post('waktu_balik_modal_end');
        $data['persentase_hasil_investasi'] = $request->post('persentase_hasil_investasi');
        $data['status'] = $request->post('status') ;
       // dd($data['status']);
       // dd($data['persentase_hasil_investasi']);
        $bisnis = Bisnis::where('id','=',$request->post('id'))->first();
        $tempFoto = '';
        if ($request->file('foto_bisnis')) {
       		foreach ($request->file('foto_bisnis') as $foto) {
                 $foto_bisnis = $foto->store('investasi/foto_bisnis','public');
                 $tempFoto = $tempFoto.','.$foto_bisnis;
                     
            }
             foreach ($request->post('foto_bisnis') as $foto) {
                 $tempFoto = $tempFoto.','.$foto;                    
             }
          
        }
        else{
                 foreach ($request->post('foto_bisnis') as $foto) {
                 $tempFoto = $tempFoto.','.$foto;                    
             }
        }
       
        $old_foto = explode(',',$bisnis->foto_bisnis);
          for ($i=0; $i < sizeof($old_foto) ; $i++) { 
            if(!in_array($old_foto[$i],explode(',',$tempFoto))){
                Storage::disk('public')->delete($old_foto[$i]);
            }
         } 
          $data['foto_bisnis'] = $tempFoto;
        
       	 $bisnis->update($data);

      $request->session()->flash('success','Bisnis berhasil diubah');
      return back();

	 }
    public function edit_investasi(Request $request,$slug){

        $bisnis= Bisnis::select('id','name','foto_bisnis','jumlah_investasi','target_investasi','jumlah_investor','persentase_hasil_investasi','total_penghasilan','waktu_balik_modal_start', 'waktu_balik_modal_end','minimum_investasi','kategori','lokasi','status')->withCount(['investor','umkm'])->where('id','=',$slug)->first();
        return Inertia::render('Dashboard/Investasi/Edit_investasi',['bisnis'=>$bisnis]);
    }
	 public function hapus_investasi(Request $request){
	 	$bisnis = Bisnis::where('id','=',$request->post('id'))->first();
        $foto = explode(',',$bisnis->foto_bisnis);
          for ($i=0; $i < sizeof($foto) ; $i++) { 
                Storage::disk('public')->delete($foto[$i]);
          }

        $bisnis->delete();
        $request->session()->flash('success','Bisnis berhasil dihapus');
      	return back();
	 }
	 public function detail_investasi(Request $request,$slug){

	 	$data= Bisnis::select('id','name','foto_bisnis','jumlah_investasi','target_investasi','jumlah_investor','persentase_hasil_investasi','total_penghasilan','waktu_balik_modal_start', 'waktu_balik_modal_end','minimum_investasi','kategori','lokasi','status')->withCount(['investor','umkm'])->where('id','=',$slug)->first();
        return Inertia::render('Dashboard/Investasi/Detail_investasi',['bisnis'=>$data]);



	 }


 

    public function list_investor_investasi(Request $request,$slug){
        $data=DB::table('bisnis')->select('id','name')->where('id','=',$slug)->first();
        /*
        $items = $data->investor()->with(['profil:id,nama_lengkap,no_hp,foto_profil,user_id'])->whereHas('profil', function (Builder $query) {
            $query->orderBy('nama_lengkap','asc');})->whereHas('profil', function (Builder $query) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');})->paginate(10);
            */
        $items =User::with(['profilPerusahaan:id,nama_perusahaan,kategori_perusahaan,user_id','profil:id,nama_lengkap,no_hp,foto_profil,user_id','role:id,number,user_id'])->select('id')
            ->whereRelation('bisnisinvestor_pivot','bisnis_id', request('slug'))
            ->filter_investor(request(['nama_investor','lokasi_investor','perusahaan_investor','kategori_investor']))
            ->orderBy(
              Profil::select('nama_lengkap')
              ->whereColumn('user_id', 'users.id')
              ->orderBy('nama_lengkap','asc')
              )->paginate(10);
        return Inertia::render('Dashboard/Investasi/list_investor_investasi',['items'=>$items,'bisnis'=>$data]);
     }

    public function list_umkm_funding(Request $request,$slug){
        $data=DB::table('bisnis')->select('id','name')->where('id','=',$slug)->first();
        /*
        $items = $data->umkm()->with(['profil:id,nama_lengkap,no_hp,foto_profil,user_id'])->whereHas('profil', function (Builder $query) {
            $query->orderBy('profil.no_hp','desc');})->whereHas('profil', function (Builder $query) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');})->paginate(10);
        */
          $items = User::select('id')
             ->with(['usaha:id,nama_perusahaan,user_id','produk:id,kategori_produk,user_id','profil:id,nama_lengkap,no_hp,foto_profil,provinsi,user_id','role:id,number,user_id'])
             ->whereRelation('bisnisumkm_pivot','bisnis_id',$slug)        
             ->filter_umkm(request(['nama_umkm','lokasi_umkm','perusahaan_umkm','produk_umkm']))
             ->orderBy(
                 Profil::select('nama_lengkap')
               ->whereColumn('user_id', 'users.id')
             ->orderBy('nama_lengkap','asc')
            )
            ->paginate(10);

        return Inertia::render('Dashboard/Investasi/list_umkm_funding',['items'=>$items,'bisnis'=>$data]);
     }

     public function investor_investasi_detail(Request $request,$slug,$slug2){
        $bisnis = Bisnis::select('id','name','jumlah_investasi','total_penghasilan')->where('id','=',13)->first();
        $items = $bisnis->investasi()->where('user_id',$slug2)->filter(request(['cari']))->paginate(10);
         function getStatistik($investor_id,$bisnis_id,$bisnis_object){
             $bisnis = $bisnis_object;
             $statData = [];
             $statData['investasiMasuk'] =[];
             $statData['tanggal'] = [];
             $statData['investasiMasuk']['nilai']=[];
             $statData['investasiKeluar']['nilai']=[]; 
             $statData['investasiMasukTotal'] = 0;
             $statData['investasiKeluarTotal'] = 0;
             $statData['kontribusi'] = 0;
             $items_stat =DB::table('investasi')->where('user_id',$investor_id)->where('bisnis_id',$bisnis_id)->orderBy('tanggal','asc')->get();
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
        $statistik = getStatistik($slug2,$slug,$bisnis);
        return Inertia::render('Dashboard/Investasi/List_investasi',['items'=>$items,'bisnis'=>$bisnis,'statistik'=>Inertia::lazy(fn()=>$statistik),'investor'=>$slug2]);
     }




     public function umkm_funding_detail(Request $request,$slug,$slug2){
        $bisnis = Bisnis::with('funding')->select('id','name','jumlah_investasi','total_penghasilan')->where('id','=',$slug)->first();
        $items = $bisnis->funding()->where('user_id',$slug2)->orderBy('tanggal','asc')->filter(request(['cari']))
                                ->paginate(10);
        function getStatistik($umkm_id,$bisnis_id,$bisnis_object){
             $bisnis = $bisnis_object;
             $statData = [];
             $statData['fundingMasuk'] =[];
             $statData['tanggal'] = [];
             $statData['fundingMasuk']['nilai']=[];
             $statData['fundingKeluar']['nilai']=[]; 
             $statData['fundingMasukTotal'] = 0;
             $statData['fundingKeluarTotal'] = 0;
             $statData['kontribusi'] = 0;
             $items_stat =DB::table('funding')->where('user_id',$umkm_id)->where('bisnis_id',$bisnis_id)->orderBy('tanggal','asc')->get();
             foreach ($items_stat as $item) {
                 $statData['fundingMasukTotal'] += $item->uang_masuk;
                 $statData['fundingKeluarTotal'] += $item->uang_keluar;
                 $statData['tanggal'][] = $item->tanggal;
                 $statData['fundingMasuk']['nilai'][] = $item->uang_masuk;
                 $statData['fundingKeluar']['tanggal'][] = $item->tanggal;
                 $statData['fundingKeluar']['nilai'][] = $item->uang_keluar;
                 $statData['kontribusi']= (($statData['fundingMasukTotal'] - $statData['fundingKeluarTotal'])/ $bisnis->total_penghasilan) * 100 ;


             }
             return $statData;
        }
        $statistik = getStatistik($slug2,$slug,$bisnis);

        return Inertia::render('Dashboard/Investasi/List_funding',['items'=>$items,'bisnis'=>$bisnis,'statistik'=>Inertia::lazy(fn()=>$statistik),'umkm'=>$slug2]);
     }




     public function daftar_investor(Request $request,$slug){
        $bisnis= Bisnis::select('name','id')->where('id',$slug)->first();
        $items = User::join('profil','profil.user_id','=','users.id')
             ->join('profil_perusahaan','profil_perusahaan.user_id','=','users.id')
             ->join('bisnis_investor','investor_id','=','users.id')
             ->select('nama_perusahaan','users.id','kategori_perusahaan','profil.nama_lengkap','profil.no_hp','profil.foto_profil')
            ->filter_investor(request(['nama_investor','lokasi_investor','perusahaan_investor','kategori_investor']))
            ->where('bisnis_investor.bisnis_id',$slug)
            ->orderBy('profil.nama_lengkap','asc')
            ->paginate(10);
        
        $investor_all = User::join('profil','profil.user_id','=','users.id')
             ->join('profil_perusahaan','profil_perusahaan.user_id','=','users.id')
             ->join('roles','roles.user_id','=','users.id')
             ->select('nama_perusahaan','users.id','kategori_perusahaan','profil.nama_lengkap','profil.no_hp','profil.foto_profil')
            ->filter_investor(request(['nama_investor','lokasi_investor','perusahaan_investor','kategori_investor'])) 
            ->where('accepted',true)
            ->where('roles.number','=',3)
            ->filter_investor(request(['nama_investor','lokasi_investor','perusahaan_investor','kategori_investor']))
            ->orderBy('profil.nama_lengkap','asc')
            ->paginate(10);

        $investorJoined = [];
        foreach($bisnis->investor()->select('investor_id')->get() as $investor){

            $investorJoined[] = $investor->investor_id;

        }

        return Inertia::render('Dashboard/Investasi/investasi_investor',
                               ['items'=>$items,
                                'bisnis'=>$bisnis,
                                 'investor'=>Inertia::lazy(fn()=>$investorJoined), 
                                'investor_all'=>Inertia::lazy(fn()=> $investor_all)]);
     }

     public function daftar_umkm(Request $request,$slug){
        $bisnis=Bisnis::select('id','name')->where('id','=',$slug)->first();
          $items = User::join('usaha','usaha.user_id','=','users.id')
                        ->join('produk','produk.user_id','=','users.id')
                        ->join('profil','profil.user_id','=','users.id')
                        ->join('bisnis_peserta','bisnis_peserta.umkm_id','=','users.id')
                        ->select('usaha.nama_perusahaan','users.id','produk.kategori_produk','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.provinsi')      
                         ->filter_umkm(request(['nama_umkm','lokasi_umkm','perusahaan_umkm','produk_umkm']))
                         ->where('bisnis_peserta.bisnis_id','=',$slug)
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
        foreach($bisnis->umkm()->select('umkm_id')->get() as $umkm){

            $umkmJoined[] = $umkm->umkm_id;
        }

        return Inertia::render('Dashboard/Investasi/investasi_umkm',['items'=>$items,
                                                                     'bisnis'=>$bisnis,
                                                                     'umkm'=>Inertia::lazy(fn()=>$umkmJoined),
                                                                     'umkm_all'=>Inertia::lazy(fn()=>$umkm_all)]);
     }

      public function tambah_investor_post(Request $request){
        $data = Bisnis::select('name','id','jumlah_investor')->where('id','=',$request->post('bisnis_id'))->first();
        $investor = $request->post('investor_id');
        if ($data->investor->contains($investor)){
                $request->session()->flash('error','Investor ini sudah bergabung di kegiatan ini !');
                return back();

            }
        $data->investor()->attach($investor,['investor_foreign'=>$investor,'bisnis_foreign'=>$data->id]);
        $notif = Notifikasi::create(['nama'=>'Anda diundang ke bisnis','pesan'=>'Anda diundang ke bisnis '.$data->name,
                            'user_id'=>$investor,'redirect'=>'/investor/dashboard/bisnisku/'.$data->id,'waktu'=>now()]);
        $invNotif = User::select('notifikasi')->where('id',$investor)->first();
        $invNotif->update(['notifikasi'=>$invNotif->notifikasi+=1]);
         return back();


     }
    public function tambah_umkm_post(Request $request){
        $data = Bisnis::where('id','=',$request->post('bisnis_id'))->first();
        $umkm = $request->post('umkm_id');
        if ($data->umkm->contains($umkm)){
                $request->session()->flash('error','umkm ini sudah bergabung di kegiatan ini !');
                return back();

            }
        $data->umkm()->attach($umkm,['umkm_foreign'=>$umkm,'bisnis_foreign'=>$data->id]);
        Notifikasi::create(['nama'=>'diundang diundang ke funding bisnis','pesan'=>'Anda diundang ke funding bisnis '.$data->name,'user_id'=>$umkm,'redirect'=>'/umkm/dashboard/funding/'.$data->id,'waktu'=>now()]);
        $umkmNotif = User::select('notifikasi')->where('id',$umkm)->first();
        $updateNotif = $umkmNotif->notifikasi +=1;
        $umkmNotif->update(['notifikasi'=>$updateNotif]);
        return back();


     }

     public function tambah_investasi_investor(Request $request){
         $rules = [
            'uang_masuk' => 'required',
            'uang_keluar'=>'required', 
            'bukti'=>'required' ,
            
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

   // dd($request->post('berakhir'));
      $this->validate($request, $rules, $customMessages);
      $data=[];
      $data['investasi_masuk'] = $request->post('uang_masuk');
      $data['investasi_keluar']= $request->post('uang_keluar');
      $uploadBukti = $request->file('bukti')->store('investasi/bukti_investasi_investor','public');
      $data['tanggal']=now();
      $data['user_id'] = $request->post('user_id');
      $data['bisnis_id'] = $request->post('bisnis_id');
      $data['bukti'] = $uploadBukti;
      $request->session()->flash('success','Record berhasil dibuat');
      $bisnis = Bisnis::select('bisnis.name','jumlah_investasi','id')->where('id',$data['bisnis_id'])->first();
      $investasi = $bisnis->investasi()->create($data);
      $bisnis->update(['total_penghasilan'=> $bisnis->total_penghasilan + $data['investasi_masuk'] - $data['investasi_keluar'],'jumlah_investasi'=>$bisnis->jumlah_investasi + $data['investasi_masuk'] - $data['investasi_keluar']]);

      Notifikasi::create(['nama'=>'Track record investasi ditambah','pesan'=>'Data investasi di tambah bisnis '.$bisnis->name,'redirect'=>'/investor/dashboard/bisnisku/investasi/'.$bisnis->id,'user_id'=>$data['user_id'],'tanggal'=>now()]);
        $invNotif = User::select('notifikasi')->where('id',$data['user_id'])->first();
        $invNotif->update(['notifikasi'=>$invNotif->notifikasi+=1]);
        $request->session()->flash('success','Investor berhasil ditambah');
      return back();
      
     }

     public function tambah_funding_umkm(Request $request){
         $rules = [
            'uang_masuk' => 'required',
            'uang_keluar'=>'required', 
            'bukti'=>'required' ,
            
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

   // dd($request->post('berakhir'));
      $this->validate($request, $rules, $customMessages);
      $data=[];
      $data['uang_masuk'] = $request->post('uang_masuk');
      $data['uang_keluar']= $request->post('uang_keluar');
      $uploadBukti = $request->file('bukti')->store('funding/bukti_funding_umkm','public');
      $data['tanggal']=now();
      $data['user_id'] = $request->post('user_id');
      $data['bisnis_id'] = $request->post('bisnis_id');
      $data['bukti'] = $uploadBukti;
      $request->session()->flash('success','Record berhasil dibuat');
      $bisnis = Bisnis::select('name','id','persentase_hasil_investasi','total_penghasilan')->where('id',$data['bisnis_id'])->first();
      $bisnis->funding()->create($data);
      $bisnis->update(['total_penghasilan' => $bisnis->total_penghasilan+ $data['uang_masuk'] - $data['uang_keluar'],'persentase_hasil_investasi'=>(($bisnis->jumlah_investasi + $data['uang_masuk'] - $data['uang_keluar']-$bisnis->jumlah_investasi)/$bisnis->total_penghasilan) * 100]);
      Notifikasi::create(['nama'=>'Track Record Ditambah','pesan'=>'Data funding ditambah di bisnis '.$bisnis->name,'redirect'=>'/umkm/dashboard/fundingku/'.$bisnis->id.'/data_fundingku','user_id'=>$data['user_id'],'tanggal'=>now()]);
      $umkmNotif = User::select('notifikasi')->where('id',$data['user_id'])->first();
        $updateNotif = $umkmNotif->notifikasi +=1;
        $umkmNotif->update(['notifikasi'=>$updateNotif]);
      return back();
      
     }


    public function edit_investasi_investor_post(Request $request){
         $rules = [
            'uang_masuk' => 'required',
            'uang_keluar'=>'required', 
            
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

   // dd($request->post('berakhir'));
      $this->validate($request, $rules, $customMessages);
      $data=[];
      $data['investasi_masuk'] = $request->post('uang_masuk');
      $data['investasi_keluar']= $request->post('uang_keluar');
      $bisnis= Bisnis::select('jumlah_investasi','id','total_penghasilan')->where('id',$request->post('bisnis_id'))->first();
      if ($request->file('bukti')) {
          Storage::disk('public')->delete($funding->bukti);
          $data['bukti'] = $request->file('bukti')->store('funding/bukti_funding_umkm','public');
      }

      $bisnis->investasi()->where('user_id',$request->post('user_id'))->update($data);
      $bisnis->update(['total_penghasilan'=>$bisnis->total_penghasilan+ $data['investasi_masuk'] - $data['investasi_keluar'],'jumlah_investasi'=>$bisnis->jumlah_investasi + $data['investasi_masuk'] - $data['investasi_keluar']]);

      $request->session()->flash('success','Record berhasil diubah');
      return back();
     }

      public function edit_umkm_funding_post(Request $request){
         $rules = [
            'uang_masuk' => 'required',
            'uang_keluar'=>'required', 
            
          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

   // dd($request->post('berakhir'));
      $this->validate($request, $rules, $customMessages);
      $data=[];
      $data['uang_masuk'] = $request->post('uang_masuk');
      $data['uang_keluar']= $request->post('uang_keluar');
      $bisnis= Bisnis::select('id','jumlah_investasi','persentase_hasil_investasi','total_penghasilan')->where('id',$request->post('bisnis_id'))->first();
      if ($request->file('bukti')) {
          Storage::disk('public')->delete($funding->bukti);
          $data['bukti'] = $request->file('bukti')->store('funding/bukti_funding_umkm','public');
      }
    
     
      $bisnis->funding()->where('user_id',$request->post('user_id'))->update($data);

      $bisnis->update(['total_penghasilan'=>$bisnis->total_penghasilan +$data['uang_masuk'] - $data['uang_keluar'],'persentase_hasil_investasi'=>  (($bisnis->total_penghasilan+ $data['uang_masuk'] - $data['uang_keluar']-$bisnis->jumlah_investasi)/ $bisnis->total_penghasilan ) * 100]);

      $request->session()->flash('success','Record berhasil diubah');
      return back();
     }

      public function hapus_investasi_investor_post(Request $request){
        $data = Investasi::where('id',$request->post('id'))->first();
        $bisnis = $data->bisnis()->select('id','jumlah_investasi','persentase_hasil_investasi','total_penghasilan');
        $updateJumlahInvestasi=intval($bisnis->first()->jumlah_investasi - $data->investasi_masuk + $data->investasi_keluar);
        $updateTotalPenghasilan =intval($bisnis->first()->total_penghasilan - $data->investasi_masuk + $data->investasi_keluar);
        $bisnis->update(['jumlah_investasi'=> $updateJumlahInvestasi,'total_penghasilan'=>$updateTotalPenghasilan]);
        $data->delete();
        $request->session()->flash('success','Investasi berhasil dihapus');
        return back();
      
     }

     public function hapus_funding_umkm_post(Request $request){
        $data= Funding::where('id',$request->post('id'))->first();
       $bisnis = $data->bisnis()->select('id','jumlah_investasi','persentase_hasil_investasi','total_penghasilan');
        $updateJumlahInvestasi=intval($bisnis->first()->jumlah_investasi - $data->investasi_masuk + $data->investasi_keluar);
        $updateTotalPersen =intval(((($bisnis->first()->total_penghasilan- $data->uang_masuk - $data->uang_keluar
        -$bisnis->first()->jumlah_investasi)/ $bisnis->first()->jumlah_investasi) * 100));
       $bisnis->update(['jumlah_investasi'=> $updateJumlahInvestasi,'persentase_hasil_investasi'=>$updateTotalPersen]);
        $data->delete();
        $request->session()->flash('success','Investasi berhasil dihapus');
        return back();
      
     }

     public function hapus_investor(Request $request){
        $data = Bisnis::select('name','id')->where('id','=',$request->post('bisnis_id'))->first();
        $data->investasi()->where('user_id',$request->post('id'))->delete();
        $data->investor()->detach($request->post('id'));
        Notifikasi::create(['nama'=>'dikeluarkan dari bisnis','pesan'=>'Anda dikeluarkan dari bisnis '.$data->name,'user_id'=>$request->post('id'),'waktu'=>now()]);
        $invNotif = User::select('notifikasi')->where('id',$request->post('id'))->first();
        $updateNotif = $invNotif->notifikasi +=1;
        $invNotif->update(['notifikasi'=>$updateNotif]);
        return back();
     }
     public function hapus_umkm(Request $request){
        $data = Bisnis::select('name','id')->where('id','=',$request->post('bisnis_id'))->first();
        $data->funding()->where('user_id',$request->post('id'))->delete();
        $data->umkm()->detach($request->post('id'));
        Notifikasi::create(['nama'=>'dikeluarkan dari funding','pesan'=>'Anda dikeluarkan dari funding '.$data->name,'user_id'=>$request->post('id'),'waktu'=>now()]);
        $umkmNotif = User::select('notifikasi')->where('id',$request->post('id'))->first();
        $updateNotif = $umkmNotif->notifikasi +=1;
        $umkmNotif->update(['notifikasi'=>$updateNotif]);
        return back();
     }

}