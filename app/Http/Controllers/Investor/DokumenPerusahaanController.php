<?php

namespace App\Http\Controllers\Investor;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notifikasi;
use App\Models\DokumenPerusahaan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
class DokumenPerusahaanController extends Controller
{
    public function form_wizard_dokumen_perusahaan(Request $request)
    {
       if(!$request->user()->profilPerusahaan->isProfilPerusahaanComplete()){
            return Inertia::render('Profil/Investor/Lockedscreen',['title'=>'Profil Usaha Belum Dapat Diisi','desc'=>'Harap penuhi profil perusahaan terlebih dahulu']);
        }
        return Inertia::render('Profil/Investor/perusahaan/form_wizard_dokumen_perusahaan');
    }

    public function process_wizard(Request $request)
    {   
        /*
       
        dd($request->post('nomor_akta_pendirian_perusahaan').$request->post('no_npwp_perusahaan').$request->post('no_rekening_perusahaan'));
        */
        $rules = [
            'nomor_akta_pendirian_perusahaan' => 'required|max:100',
            'no_npwp_perusahaan' => 'required|max:100',
            'no_rekening_perusahaan' => 'required|max:100',
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max karakter.'
        ];
        $this->validate($request, $rules, $customMessages);
        $data = [];
        $dokumen = DokumenPerusahaan::where('user_id','=',$request->user()->id);
        $old_dokumen = DB::table('dokumen_perusahaan')->select('foto_npwp_perusahaan','foto_ktp_pic','foto_buku_tabungan')->where('user_id','=',$request->user()->id)->first();

        if ($request->file('foto_npwp') && $old_dokumen->foto_npwp_perusahaan) {
            Storage::delete($old_dokumen->foto_npwp_perusahaan);
            $data['foto_npwp_perusahaan'] = $request->file('foto_npwp')->store('umkm/keterangan_halal','public'); 
        }
        elseif ($request->file('foto_npwp')) {  
            $data['foto_npwp_perusahaan'] = $request->file('foto_npwp')->store('umkm/keterangan_halal','public'); 
        }
        if ($request->file('foto_ktp_pic') && $old_dokumen->foto_ktp_pic) {
            Storage::delete($old_dokumen->foto_ktp_pic);
            $data['foto_ktp_pic'] = $request->file('foto_ktp_pic')->store('umkm/keterangan_halal','public'); 
        }
        elseif ($request->file('foto_ktp_pic')) {  
            $data['foto_ktp_pic'] = $request->file('foto_ktp_pic')->store('umkm/keterangan_halal','public'); 
        }
        if ($request->file('foto_buku_tabungan') && $old_dokumen->foto_buku_tabungan) {
            Storage::delete($old_dokumen->foto_buku_tabungan);
            $data['foto_buku_tabungan'] = $request->file('foto_buku_tabungan')->store('umkm/keterangan_halal','public'); 
        }
        elseif ($request->file('foto_buku_tabungan')) {  
            $data['foto_buku_tabungan'] = $request->file('foto_buku_tabungan')->store('umkm/keterangan_halal','public'); 
        }
        $data['nomor_akta_pendirian_perusahaan']= $request->post('nomor_akta_pendirian_perusahaan');
        $data['no_npwp_perusahaan']= $request->post('no_npwp_perusahaan');
        $data['no_rekening']= $request->post('no_rekening_perusahaan');
        $dokumen->update($data);
        $isNotifExist = DB::table('notifikasi')->select('id')->where('redirect','=',$request->user()->id)->first();
        $admins = DB::table('roles')->select('user_id')->where('number','=',1)->get();
        if (!$isNotifExist) {
             foreach ($admins as $admin) {
                 $notif = Notifikasi::create(['nama'=>'Pengajuan Data Investor Baru','pesan'=>'Seorang investor mengajukan data barunya','user_id'=>$admin->user_id,'redirect'=> $request->user()->id,'tanggal'=>now()]);
                 $updateNotif =  DB::table('users')->select('notifikasi')->where('id','=',$admin->user_id)->first();
                 $updateNotif = $updateNotif->notifikasi+= 1;
                User::where('id','=',$admin->user_id)->update(['notifikasi'=>$updateNotif]);

            }
        }
        return back();

    }
}