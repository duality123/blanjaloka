<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Kegiatan;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;
class KegiatanController extends Controller
{
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

    public function all(Request $request){
        $data = Kegiatan::select('tema','deskripsi')->orderBy('tema','asc')->get();
    return response(['data'=>$data]);
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

    public function delete(Request $request,$id){
      Kegiatan::deleteKegiatan($id);
      return response(['message'=>'item deleted']);
    }


    


}
