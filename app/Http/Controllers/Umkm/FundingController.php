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
use App\Models\Bisnis;
use Illuminate\Support\Facades\Storage;
class FundingController extends Controller
{
    public function deskripsi_bisnis(Request $request,$link)
    {
       
        $data = Bisnis::with('investor')->where('id','=',$link)->first(); 
        $invest = [];
        foreach ($data->investor()->with('profil:id,nama_lengkap,user_id')->get() as $investor) {
        $invest [] = $investor->profil->nama_lengkap;}

   // $invest = $data->investor();
        return Inertia::render('Umkm/Funding/Deskripsi',['item'=>$data,'investor'=>$invest]);
    }
     public function fundingku(Request $request,$slug)
    {

        if(!$request->user()->accepted){
            return Inertia::render('Profil/UMKM/Lockedscreen',['title'=>'Akses ditolak','desc'=>'Penuhi profil anda lalu acc admin dulu !','section'=>'funding']);
        }
        function getStatistik($bisnis_object,$user_id){
             $bisnis = $bisnis_object;
             $statData = [];
             $statData['fundingMasuk'] =[];
             $statData['tanggal'] = [];
             $statData['fundingMasuk']['nilai']=[];
             $statData['fundingKeluar']['nilai']=[]; 
             $statData['fundingMasukTotal'] = 0;
             $statData['fundingKeluarTotal'] = 0;
             $statData['kontribusi'] = 0;
             $items_stat =DB::table('funding')->where('user_id',$user_id)->where('bisnis_id',$bisnis->id)->orderBy('tanggal','asc')->get();
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
       
        $bisnis=Bisnis::select('id','name','total_penghasilan')->where('id','=',$slug)->first();
         $statistik = getStatistik($bisnis,$request->user()->id);
        $items = $bisnis->funding()->where('user_id',$request->user()->id)->filter(request(['cari']))->paginate(10);
        return Inertia::render('Umkm/Funding/Record_funding_umkm',['items'=>$items,'bisnis'=>$bisnis,'statistik'=>Inertia::lazy(fn()=>$statistik)]);
   
  
    }

    public function list_investor_investasi(Request $request,$slug){
        $data=DB::table('bisnis')->select('id','name')->where('id','=',$slug)->first();
        /*
        $items = $data->investor()->with(['profil:id,nama_lengkap,no_hp,foto_profil,user_id'])->whereHas('profil', function (Builder $query) {
            $query->orderBy('nama_lengkap','asc');})->whereHas('profil', function (Builder $query) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');})->paginate(10);
            */
         $items =User::join('profil','profil.user_id','=','users.id')
             ->join('profil_perusahaan','profil_perusahaan.user_id','=','users.id')
             ->join('bisnis_investor','investor_id','=','users.id')
             ->select('nama_perusahaan','users.id','kategori_perusahaan','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.user_id as investor_id','profil.provinsi')
            ->filter_investor(request(['nama_investor','lokasi_investor','perusahaan_investor','kategori_investor']))
            ->where('bisnis_investor.bisnis_id',$slug)
            ->orderBy('profil.nama_lengkap','asc')
            ->paginate(10);
         $investor = User::with(['profil','profilPerusahaan','dokumenPerusahaan'])->where('id',$request->get('id'))->first();               
        return Inertia::render('Umkm/Funding/Daftar_investor',['items'=>$items,'bisnis'=>$data,'investor'=>Inertia::lazy(fn()=> $investor )]);
     }

    public function list_funding_umkm(Request $request,$slug){
        $data=DB::table('bisnis')->select('id','name')->where('id','=',$slug)->first();
        /*
        $items = $data->investor()->with(['profil:id,nama_lengkap,no_hp,foto_profil,user_id'])->whereHas('profil', function (Builder $query) {
            $query->orderBy('nama_lengkap','asc');})->whereHas('profil', function (Builder $query) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');})->paginate(10);
            */
         $items =User::join('usaha','usaha.user_id','=','users.id')
                        ->join('produk','produk.user_id','=','users.id')
                        ->join('profil','profil.user_id','=','users.id')
                        ->join('bisnis_peserta','bisnis_peserta.umkm_id','=','users.id')
                        ->select('usaha.nama_perusahaan','users.id','produk.kategori_produk','profil.nama_lengkap','profil.no_hp','profil.foto_profil','profil.provinsi','profil.user_id as umkm_id')      
                         ->filter_umkm(request(['nama_umkm','lokasi_umkm','perusahaan_umkm','produk_umkm']))
                         ->where('bisnis_peserta.bisnis_id','=',$slug)
                         ->orderBy('profil.nama_lengkap','asc')
                         ->paginate(10);
        $umkm = User::with('profil','produk','finansial','usaha')->where('id',$request->get('id'))->first();  
        return Inertia::render('Umkm/Funding/Daftar_umkm',['items'=>$items,'bisnis'=>$data,'umkm'=>$umkm]);
     }
      public function leave_funding(Request $request,$slug){
        $bisnis= Bisnis::where('id','=',$slug)->first();
        $bisnis->umkm()->detach([$request->user()->id]);
        $request->session()->flash('success','Anda berhasil leave funding!');
         $admins= Role::with('user')->where('number','=',1)->get();
         foreach ($admins as $admin) {
                 Notifikasi::create(['nama'=>'Pengunduran diri dari funding','pesan'=>'umkm '.$request->user()->profil->nama_lengkap.' dengan nama perusahaan '.$request->user()->usaha->nama_perusahaan.' serta no telepon '.$request->user()->profil->no_hp.' mengundurkan diri dari bisnis '.$bisnis->name,'user_id'=>$admin->user->id,'tanggal'=>now()]);
                $admin->user->update(['notifikasi'=>$admin->user->notifikasi+=1]);
         }
      
        return redirect('umkm/dashboard/funding?page=1');
    }

      public function show_bisnis(Request $request)
    {
       if(!$request->user()->accepted){
            return Inertia::render('Profil/UMKM/Lockedscreen',['title'=>'Fitur Bisnis Masih Terkunci','desc'=>'Akun anda belum dikonfirmasi admin','section'=>'funding']);
        }
        $user = User::where('id','=',$request->user()->id)->first();
        $data = $user->bisnisumkm()->filter(request(['cari','profit']))->paginate(10);
        if($data==null){
            return Inertia::render('Profil/UMKM/Noitemscreen',['title'=>'Anda belum mendapatkan funding apapun','desc'=>'Silahkan tunggu admin sampai menginvit anda !','section'=>'funding']);
        }
       
        return Inertia::render('Umkm/Funding/list_bisnis',['items'=>$data]);

}














}