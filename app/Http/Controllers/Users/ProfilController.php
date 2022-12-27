<?php

namespace App\Http\Controllers\Users;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Profil;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class ProfilController extends Controller
{
    //GET Section / the form view.

    public function form_wizard_profil_pertama(Request $request)
    {
       
        return Inertia::render('Profil/global_profil/form_wizard_profil_pertama');
    }

    public function form_wizard_profil_kedua(Request $request){
        return Inertia::render('Profil/global_profil/form_wizard_profil_kedua');
    }
    public function form_wizard_profil_ketiga(Request $request){
        return Inertia::render('Profil/global_profil/form_wizard_profil_ketiga');
    }

    //POST section / insert the data.

    public function process_wizard_profil_pertama(Request $request)
    { 

        $update ='';
        $profil =  Profil::where('user_id',$request->user()->id);
        if ($request->file('foto_profil')) {

            $update = $request->file('foto_profil')->store('umkm/foto_profil','public') ; 
               
        }  
        $profil->update(['foto_profil' => $update]);
        return redirect('profil/2');
    }

    public function process_wizard_profil_kedua(Request $request)
    {
        $nama_lengkap = $request->post('nama_lengkap');
        $tempat_kelahiran = $request->post('tempat_kelahiran');
        $tanggal_lahir = $request->post('tanggal_lahir');
        $alamat = $request->post('alamat');
        $pendidikan_terakhir = $request->post('pendidikan_terakhir');
        $kelurahan =$request->post('kelurahan');
        $kecamatan =$request->post('kecamatan');
        $kabupaten =$request->post('kabupaten');
        $provinsi = $request->post('provinsi');
        $no_hp = $request->post('no_hp');
        $kewarganegaraan = $request->post('kewarganegaraan');
        $status = $request->post('status');
        $agama = $request->post('agama');
        $pengalaman_kerja = $request->post('pengalaman_kerja');
         $rules = [
            'nama_lengkap' => 'required|max:200',
            'tempat_kelahiran' => 'required|max:50',
            'tanggal_lahir' => 'required',
            'alamat' => 'required|max:200',
            'pendidikan_terakhir' => 'required|max:20',
            'kelurahan' => 'required|max:50',
            'kecamatan' => 'required|max:50',
            'kabupaten' => 'required|max:50',
            'provinsi' => 'required|max:50',
            'kewarganegaraan' => 'required|max:30',
            'status' => 'required|max:30',
            'pengalaman_kerja' => 'required|max:20',
            'agama'=>'required|max:10'
        ];

        $customMessages = [
            'required' => 'Harap diisi bagian ini !.',
            'max'=>'Karakter yang anda input melebihi batas :max .'

        ];

        $this->validate($request, $rules, $customMessages);

        $profil =  Profil::where('user_id','=',$request->user()->id)->update(['nama_lengkap' => 
        $nama_lengkap,'tempat_kelahiran'=>$tempat_kelahiran,'tanggal_lahir'=> $tanggal_lahir,'alamat'=> $alamat,'kelurahan'=>$kelurahan,'kecamatan'=> $kecamatan,'kabupaten'=>$kabupaten,'provinsi'=>$provinsi,'pendidikan_terakhir'=>$pendidikan_terakhir,'no_hp'=>$no_hp,'kewarganegaraan'=>$kewarganegaraan,'status'=>$status,'agama'=>$agama,'pengalaman_kerja'=>$pengalaman_kerja

            ]);
        return redirect('profil/3');

    }
    public function process_wizard_profil_ketiga(Request $request)
    { 
        $update = [];
        if ( $request->file('foto_ktp')) {
             $update['foto_ktp'] = $request->file('foto_ktp')->store('umkm/foto_ktp','public') ; 

        }
        if ($request->file('foto_selfie_ktp')) {
            $update['foto_dengan_ktp'] = $request->file('foto_selfie_ktp')->store('umkm/foto_selfie_ktp','public') ;
        };       
        $profil =  Profil::where('user_id','=',$request->user()->id)->update($update);
        $redirect = '';
        if ($request->user()->Role->number == 2) {
            $redirect = '/umkm/dashboard/profil_usaha/';
        }
        elseif ($request->user()->Role->number == 3) {
            $redirect = '/investor/dashboard/profil_perusahaan/';
        }
        return redirect($redirect);

    }
    public function detailUMKM(Request $request,$slug)
    {
        /*
     $data = DB::table('profil')
                ->join('usaha', 'profil.user_id' , '=', 'usaha.user_id')
                ->join('produk', 'profil.user_id' , '=', 'produk.user_id')
                ->join('kajian_finansial', 'profil.user_id' , '=', 'kajian_finansial.user_id')
                ->join('roles', 'profil.user_id' , '=', 'roles.user_id')
                ->select('profil.nama_lengkap', 'profil.tempat_kelahiran', 'profil.tanggal_lahir','profil.alamat','profil.pendidikan_terakhir','profil.kelurahan','roles.number','profil.kecamatan','profil.kabupaten','profil.provinsi','profil.no_hp','profil.kewarganegaraan','profil.status','profil.agama','profil.pengalaman_kerja','profil.foto_profil','profil.foto_ktp','profil.foto_dengan_ktp','usaha.nama_perusahaan','usaha.status_perusahaan','usaha.legalitas','usaha.dokumen_amdal','usaha.informasi_pajak','usaha.alamat_perusahaan','usaha.npwp','usaha.deskripsi_usaha','usaha.email_perusahaan','produk.jenis_produk','produk.jumlah_produk_yang_dijual','produk.bahan_produk','produk.harga_produk','produk.kategori_produk','produk.keterangan_halal','produk.manfaat_fungsional','produk.manfaat_nonfungsional','kajian_finansial.capex','kajian_finansial.opex','kajian_finansial.swot_faktor_internal','kajian_finansial.swot_faktor_eksternal','kajian_finansial.payback_period','kajian_finansial.key_activity','kajian_finansial.key_partners','kajian_finansial.value_propotions','kajian_finansial.customer_relationship','kajian_finansial.channels','kajian_finansial.cost_structure','kajian_finansial.revenue_streams')
                ->where('profil.user_id','=',$slug)
                ->first(); 
        */

        $data = User::with('profil','produk','finansial','usaha','roles')->where('id','=',$slug)->first();
       //dd($data);
        DB::table('notifikasi')->where('redirect','=',$slug)->delete();
        return Inertia::render('Profil/Detail_profil',['data'=>$data,'id'=>$slug]);

    }

     public function ubah_password(Request $request){
        $popup = false;
        if ($request->post('password')) {
          if(Hash::check($request->post('old_password'),$request->user()->password)){
            User::where('id','=',$request->user()->id)->update(['password' =>Hash::make($request->post('password'))]);
                $request->session()->flash('success','password berhasil diubah');
            }
          else{
            return Inertia::render('Profil/Change_password',['wrongOldPassword'=>'Kata sandi lama anda salah!']);
          }
        }


        return Inertia::render('Profil/Change_password',['popup'=>$popup]);

    }


}
