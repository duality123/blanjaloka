<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Usaha extends Model
{
    public $timestamps = false;
    protected $table='usaha';
    use HasFactory;



   public function user(){
         return $this->belongsTo(User::class,'id','user_id');
    }

   public function usahaList(){
      $data = [];
      $data['nama_perusahaan']= $this->nama_perusahaan;
      $data['status_perusahaan'] = $this->status_perusahaan;
      $data['legalitas'] = $this->legalitas;
      $data['dokumen_amdal'] = $this->dokumen_amdal;
      $data['informasi_pajak'] = $this->informasi_pajak;
      $data['alamat_perusahaan'] = $this->alamat_perusahaan;
      $data['npwp'] = $this->npwp;
      $data['deskripsi_usaha'] = $this->deskripsi_usaha;
      $data['email_perusahaan'] = $this->email_perusahaan;
      return $data;
    }

   public function isUsahaComplete(){
      if ($this->nama_perusahaan && $this->status_perusahaan && $this->legalitas && $this->dokumen_amdal && $this->informasi_pajak && $this->npwp && $this->deskripsi_usaha && $this->email_perusahaan &&
      $this->alamat_perusahaan )
      {
         return true;
      }
      return false;
    }

}