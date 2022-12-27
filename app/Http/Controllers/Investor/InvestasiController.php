<?php
namespace App\Http\Controllers\Investor;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bisnis;
use App\Models\Notifikasi;
use App\Models\DokumenPerusahaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
class InvestasiController extends Controller
{
    public function show(Request $request,$slug)
    {
       if(!$request->user()->accepted){
            return Inertia::render('Profil/Investor/Lockedscreen',['title'=>'Fitur Bisnis Masih Terkunci','desc'=>'Akun anda belum dikonfirmasi admin']);
        }
        $data = Bisnis::fetchAndPaginate($limit=9,$page=$slug,$request->user()->id);
        return Inertia::render('Profil/Investor/bisnis/Daftar_bisnis',['items'=>$data['items'],
                                                           'paginationNums'=>$data['paginate']['nums'],
                                                           'nextBlok'=>$data['paginate']['nextBlok'],
                                                           'prevBlok'=>$data['paginate']['prevBlok'],
                                                           'prev'=>$data['paginate']['prev'],
                                                           'next'=>$data['paginate']['next'],
                                                           'first'=>$data['paginate']['first'],
                                                           'last'=>$data['paginate']['last'],]);
    }

    public function add(Request $request)
    {
       if(!$request->user()->accepted){
            return Inertia::render('Profil/Investor/Lockedscreen',['title'=>'Fitur Bisnis Masih Terkunci','desc'=>'Akun anda belum dikonfirmasi admin']);
        }
        return Inertia::render('Profil/Investor/bisnis/Tambah_investasi');
    }

        public function create(Request $request)
        {


    
        $rules =  [
            'name' => ['required','max:255',],
            'jumlah_investor' => ['required','digits_between:0,8388607','Integer'],
            'minimum_investasi' => ['required','digits_between:0,2147483647 ','Integer'],
            'kategori' =>  ['required','max:50'],
            'gambar'=>'required',
            'jumlah_investasi'=>'required',
            'target_investasi' =>'required',
            'lokasi'=>  ['required','max:30'],
            'waktu_balik_modal_start'=>'required',
            'waktu_balik_modal_end'=>'required'
        ];
        $customMessages = [
              'required' => 'Filed ini wajib diisi, silahkan isi sesuai data anda !',
              'max'=>'Karakter yang anda input melebihi batas :max karakter.'


        ];
        
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
        $tempFoto = '';
        foreach ($request->file('gambar') as $foto) {
             $foto_bisnis = $foto->store('investor/foto_bisnis','public');
             $tempFoto = $tempFoto.','.$foto_bisnis;
                     
        }
        $data['foto_bisnis'] = $tempFoto ;
        $request->session()->flash('success','Bisnis berhasil ditambah');
        $bisnis = Bisnis::create($data);
        $bisnis->investor()->attach($request->user()->id);

        return back();
}

}