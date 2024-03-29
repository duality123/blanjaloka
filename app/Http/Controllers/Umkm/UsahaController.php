<?php

namespace App\Http\Controllers\UMKM;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usaha;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
class UsahaController extends Controller
{
    public function form_wizard(Request $request)
    {
       if(!$request->user()->profil->isProfileComplete()){
            return Inertia::render('Profil/UMKM/Lockedscreen',['title'=>'Profil Usaha Belum Dapat Diisi','desc'=>'Harap penuhi profil diri terlebih dahulu','section'=>'profil_usaha']);
        }
        return Inertia::render('Profil/UMKM/usaha/form_wizard');
    }

    public function process_form_wizard(Request $request)
    {   
        $rules = [
            'nama_perusahaan' => 'required|max:255',
            'alamat_perusahaan' => 'required',
            'dokumen_amdal'=>'required',
            'dokumen_legalitas'=>'required',
            'status_perusahaan' => 'required|max:50',
            'informasi_pajak' => 'required|max:100',
            'npwp' => 'required|max:100',
            'email_perusahaan' => 'required|max:255',
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

        $this->validate($request, $rules, $customMessages);
        $data = [];
        $usaha =  Usaha::where('user_id','=',$request->user()->id)->first();
        if ($request->file('legalitas') && $usaha->legalitas) {
            Storage::disk('public')->delete($usaha->legalitas);
            $data['legalitas']=$request->file('legalitas')->store('umkm/dokumen_legalitas','public') ;
        }
        elseif($request->file('legalitas')){
            $data['legalitas']=$request->file('legalitas')->store('umkm/dokumen_legalitas','public') ;
        }
        if($request->file('dokumen_amdal') && $usaha->dokumen_amdal){ 
            Storage::delete($usaha->dokumen_amdal);  
            $data['dokumen_amdal']= $request->file('dokumen_amdal')->store('umkm/dokumen_amdal','public') ; 
        }
        elseif($request->file('dokumen_amdal')){
            $data['dokumen_amdal']= $request->file('dokumen_amdal')->store('umkm/dokumen_amdal','public') ; 
        }

        
        $data['nama_perusahaan']= $request->post('nama_perusahaan');
        $data['status_perusahaan']= $request->post('status_perusahaan');
        $data['informasi_pajak']= $request->post('informasi_pajak');
        $data['npwp']= $request->post('npwp');
        $data['deskripsi_usaha']= $request->post('deskripsi_usaha');
        $data['email_perusahaan']=$request->post('email_perusahaan');
        $data['alamat_perusahaan'] = $request->post('alamat_perusahaan');
        $usaha->update($data);
        return redirect('umkm/dashboard/profil_produk/');

    }
}
