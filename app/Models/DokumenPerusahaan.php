<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class DokumenPerusahaan extends Model
{
    public $timestamps = false;
    protected $table='dokumen_perusahaan';
    use HasFactory;



   public function user(){
         return $this->belongsTo(User::class,'id','user_id');
    }

    public function foto_npwp()
    {
        return $this->foto_profil;
    }
     public function foto_ktp_pic()
    {
        return $this->foto_ktp_pic;
    }
      public function foto_buku_tabungan()
    {
        return $this->foto_buku_tabungan;
    }

   public function dokumenPerusahaanList(){
      $data = [];
      $data['nomor_akta_pendirian_perusahaan'] = $this->nomor_akta_pendirian_perusahaan;   
      $data['foto_npwp_perusahaan'] = $this->foto_npwp_perusahaan; 
      $data['no_npwp_perusahaan'] = $this->no_npwp_perusahaan;
      $data['foto_ktp_pic']  = $this->foto_ktp_pic;
      $data['no_rekening'] = $this->no_rekening;
      $data['foto_buku_tabungan'] = $this->foto_buku_tabungan;
      return $data;
    }

   public function isDokumenPerusahaanComplete(){
      if ($this->nomor_akta_pendirian_perusahaan && $this->foto_npwp_perusahaan && $this->no_npwp_perusahaan && $this->foto_ktp_pic && $this->foto_ktp_pic && $this->no_rekening && $this->foto_buku_tabungan){
         return true;
      }
      return false;
    }
   
}