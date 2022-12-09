<?php

namespace App\Http\Controllers\Investor;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfilPerusahaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProfilPerusahaanController extends Controller
{
    public function form_wizard_profil_perusahaan(Request $request)
    {
       if(!$request->user()->profil->isProfileComplete()){
            return Inertia::render('Profil/Investor/Lockedscreen',['title'=>'Profil Usaha Belum Dapat Diisi','desc'=>'Harap penuhi profil diri terlebih dahulu']);
        }
        return Inertia::render('Profil/Investor/perusahaan/form_wizard_perusahaan');
    }

    public function process_wizard(Request $request)
    {   
        $rules = [
            'nama_perusahaan' => 'required|max:255',
            'alamat_perusahaan' => 'required',
            'nama_pic' => 'required|max:255',
            'tanggal_berdiri' => 'required',
            'nomor_telepon' => 'required|max:20',
            'email_pic' => 'required|max:255',
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max karakter.'

        ];

        $this->validate($request, $rules, $customMessages);
        
        $data = [];

        
        $data['nama_perusahaan']= $request->post('nama_perusahaan');
        $data['alamat_perusahaan']= $request->post('alamat_perusahaan');
        $data['nama_pic']= $request->post('nama_pic');
        $data['tanggal_berdiri']= $request->post('tanggal_berdiri');
        $data['nomor_telepon']= $request->post('nomor_telepon');
        $data['email_pic']=$request->post('email_pic');
        $profil =  ProfilPerusahaan::where('user_id','=',$request->user()->id)->update($data);
        return redirect('investor/dashboard/dokumen_perusahaan');

    }
}
