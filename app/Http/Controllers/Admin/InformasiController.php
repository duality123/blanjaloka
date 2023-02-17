<?php

namespace App\Http\Controllers\Admin;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notifikasi;
use App\Models\Info_admin;
use Illuminate\Support\Facades\DB;
class InformasiController extends Controller
{
    public function Daftar_informasi(Request $request)
    {
        $data = Info_admin::orderBy('tanggal','desc')->filter(request(['cari','tanda']))->paginate(10);

        return Inertia::render('Dashboard/Info_admin/Daftar_informasi',['items'=>$data]);
    }

    public function tambah_informasi(Request $request)
    {   
       
         $rules = [
            'isi' => 'required',          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
        $this->validate($request, $rules, $customMessages);
        Info_admin::create(['isi'=>$request->post('isi'),'tanggal'=>now()]);
        $request->session()->flash('success','Informasi Berhasil Ditambah !');
        return back();
    }


    public function edit_informasi(Request $request)
    {   
       
         $rules = [
            'isi' => 'required',          
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];
        $this->validate($request, $rules, $customMessages);
        Info_admin::where('id',$request->post('id'))->update(['isi'=>$request->post('isi')]);
        $request->session()->flash('success','Informasi Berhasil Ditambah !');
        return back();
    }

    public function hapus_informasi(Request $request){
        $target = Info_admin::where('id','=',$request->post('id'))->delete();
        $request->session()->flash('success','Info berhasil dihapus');
        return back();
    }

     public function tandai_informasi(Request $request){
        

        if ($request->post('id')== null) {
            $request->session()->flash('error','harap tandai dulu notifikasi anda');
            return back();
        }    
        $targets =Info_admin::whereIn('id',$request->post('id'))->get();
        foreach ($targets as $target) {
           

            if ($target->tandai) {
                 $target->update(['tandai'=>false]);
            }
            else{
                $target->update(['tandai'=>true]);
            }
        }
            
        
       
        $request->session()->flash('success','Info berhasil ditandai');
        return back();
    }


   
}
