<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class ProfilPerusahaan extends Model
{
    public $timestamps = false;
    protected $table='profil_perusahaan';
    use HasFactory;



   public function user(){
         return 
         $this->belongsTo(User::class,'user_id','id');
    }

   public function profilPerusahaanList(){
      $data = [];
      $data['nama_perusahaan'] = $this->nama_perusahaan;   
      $data['alamat_perusahaan'] = $this->alamat_perusahaan; 
      $data['nama_pic'] = $this->nama_pic;
      $data['tanggal_berdiri']  = $this->tanggal_berdiri;
      $data['nomor_telepon'] = $this->nomor_telepon;
      $data['email_pic'] = $this->email_pic;
      return $data;
    }

   public function isProfilPerusahaanComplete(){
      if ($this->nama_perusahaan && $this->alamat_perusahaan && $this->nama_pic && $this->tanggal_berdiri && $this->nomor_telepon &&  $this->email_pic){
         return true;
      }
      return false;
    }
   
}