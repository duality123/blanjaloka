<?php

namespace App\Models;
use App\Models\Profil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eventual;
use App\Models\User;
class Profil extends Model
{
    public $timestamps = false;
    protected $table='profil';
    use HasFactory;
    protected $fillable = ['user_id',  
                           'foto_profil', 
                           'id',
                           'nama_lengkap',
                           'tanggal_lahir',  
                           'pendidikan_terakhir',  
                           'tempat_kelahiran',  
                           'alamat',   
                           'kelurahan',   
                           'kecamatan',  
                           'kabupaten',   
                           'provinsi', 
                           'foto_ktp', 
                           'foto_dengan_ktp',   
                           'no_hp', 
                           'status',   
                           'kewarganegaraan',   
                           'agama', 
                           'pengalaman_kerja'
                           ];  



   public function user(){
         return $this->belongsTo(User::class,'user_id','id');
    }
   public function eventual()
    {
        return $this->hasMany(Eventual::class,'profil_id');
   }
    public function foto_profil()
    {
        return $this->foto_profil;
    }

   public function profilList(){
      $data = [];
      $data['foto_profil'] = $this->foto_profil;
      $data['nama_lengkap'] = $this->nama_lengkap; 
      $data['tanggal_lahir'] = $this->tanggal_lahir;
      $data['tempat_kelahiran'] = $this->tempat_kelahiran; 
      $data['alamat'] = $this->alamat;
      $data['pendidikan_terakhir'] =  $this->pendidikan_terakhir;
      $data['kelurahan'] = $this->kelurahan;
      $data['kecamatan'] = $this->kecamatan;
      $data['kabupaten'] = $this->kabupaten; 
      $data['provinsi'] = $this->provinsi;
      $data['foto_ktp'] = $this->foto_ktp; 
      $data['foto_dengan_ktp'] = $this->foto_dengan_ktp;
      $data['no_hp'] = $this->no_hp;
      $data['kewarganegaraan'] = $this->kewarganegaraan;
      $data['status'] = $this->status;
      $data['agama'] = $this->agama;
      $data['pengalaman_kerja'] = $this->pengalaman_kerja;
      return $data;
    }

   public function isProfileComplete(){
      if ($this->foto_profil && $this->nama_lengkap && $this->tanggal_lahir && $this->tempat_kelahiran && $this->alamat && $this->pendidikan_terakhir && $this->kelurahan && $this->kecamatan && $this->kabupaten && $this->provinsi && $this->foto_ktp && $this->foto_dengan_ktp){
         return true;
      }
      return false;
    }

   public function umkm(){
      $data = DB::table('profil')
                ->join('usaha', 'profil.user_id' , '=', 'usaha.user_id')
                ->join('produk', 'profil.user_id' , '=', 'produk.user_id')
                ->join('roles', 'profil.user_id' , '=', 'roles.user_id')
                ->join('kajian_finansial', 'profil.user_id' , '=', 'kajian_finansial.user_id')
                ->select('roles.number,profil.nama_lengkap', 'profil.tempat_kelahiran', 'profil.tanggal_lahir','profil.alamat','profil.pendidikan_terakhir','profil.kelurahan','profil.kecamatan','profil.kabupaten','profil.provinsi','profil.no_hp','profil.kewarganegaraan','profil.status','profil.agama','profil.pengalaman_kerja','profil.foto_profil','profil.foto_ktp','profil.foto_dengan_ktp','usaha.nama_perusahaan','usaha.status_perusahaan','usaha.legalitas','usaha.dokumen_amdal','usaha.informasi_pajak','usaha.alamat_perusahaan','usaha.npwp','usaha.deskripsi_usaha','usaha.email_perusahaan','produk.jenis_produk','produk.jumlah_produk_yang_dijual','produk.bahan_produk','produk.harga_produk','produk.keterangan_halal','produk.manfaat_fungsional','produk.manfaat_nonfungsional','kajian_finansial.capex','kajian_finansial.opex','kajian_finansial.swot_faktor_internal','kajian_finansial.swot_faktor_eksternal','kajian_finansial.payback_period','kajian_finansial.key_activity','kajian_finansial.value_propotions','kajian_finansial.customer_relationship','kajian_finansial.channels','kajian_finansial.cost_structure','kajian_finansial.revenue_streams')
                ->where('profil.user_id','=',$slug)
                ->first(); 
      return $data;
   }
   

}