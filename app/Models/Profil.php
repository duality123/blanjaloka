<?php

namespace App\Models;
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
  
  public function scopeFilter($query,array $filters){
       if($filters['cari'] ?? false) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');
             $query->where('no_hp', 'like', '%' . request('cari') . '%');
        }
   }


   public function delete(){
        Storage::disk('public')->delete($this->foto_ktp);
        Storage::disk('public')->delete($this->foto_dengan_ktp);
        parent::delete();
   }


   public function user(){
         return $this->belongsTo(User::class,'user_id','id');
    }
  public function eventual(){
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

   

}