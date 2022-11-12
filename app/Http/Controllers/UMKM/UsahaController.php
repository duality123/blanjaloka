<?php

namespace App\Http\Controllers\UMKM;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usaha;
use Illuminate\Support\Facades\DB;

class UsahaController extends Controller
{
    public function pertama(Request $request)
    {
       if(!$request->user()->profil->isProfileComplete()){
            return Inertia::render('Profil/Lockedscreen',['title'=>'Profil Usaha Belum Dapat Diisi','desc'=>'Harap penuhi profil diri terlebih dahulu']);
        }
        return Inertia::render('Profil/usaha/Pertama');
    }

    public function process_pertama(Request $request)
    {   
           $rules = [
            'nama_perusahaan' => 'required|max:200',
            'alamat_perusahaan' => 'required|max:100',
            'status_perusahaan' => 'required|max:50',
            'informasi_pajak' => 'required|max:100',
            'npwp' => 'required|max:100',
            'email_perusahaan' => 'required|max:100',
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

        $this->validate($request, $rules, $customMessages);
        $data = [];

        if ($request->file('legalitas')) {
             $legalitas= $request->file('legalitas')->store('umkm/dokumen_legalitas','public') ;
             $data['legalitas']= $legalitas;
        };
        if($request->file('dokumen_amdal')){
            $dokumen_amdal = $request->file('dokumen_amdal')->store('umkm/dokumen_amdal','public') ;   
            $data['dokumen_amdal']= $dokumen_amdal;
        }

        
        $data['nama_perusahaan']= $request->post('nama_perusahaan');
        $data['status_perusahaan']= $request->post('status_perusahaan');
        $data['informasi_pajak']= $request->post('informasi_pajak');
        $data['npwp']= $request->post('npwp');
        $data['deskripsi_usaha']= $request->post('deskripsi_usaha');
        $data['email_perusahaan']=$request->post('email_perusahaan');
        $data['alamat_perusahaan'] = $request->post('alamat_perusahaan');
        $profil =  Usaha::where('user_id','=',$request->user()->id)->update($data);
        return redirect('umkm/dashboard/profil_produk/1');

    }
}
