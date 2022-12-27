<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Produk extends Model
{
    public $timestamps = false;
    protected $table='produk';
    use HasFactory;



   public function user(){
         return $this->belongsTo(User::class,'user_id','id');
    }

   public function produkList(){
      $data = [];
      $data['jenis_produk'] = $this->jenis_produk;
      $data['jumlah_produk_yang_dijual'] = $this->jumlah_produk_yang_dijual;
      $data['bahan_produk'] = $this->bahan_produk;
      $data['kategori_produk'] = $this->kategori_produk;
      $data['harga_produk']=$this->harga_produk;
      $data['keterangan_halal'] = $this->keterangan_halal;
      $data['manfaat_fungsional'] = $this->manfaat_fungsional;
      $data['manfaat_nonfungsional'] = $this->manfaat_nonfungsional;
      return $data;
    }

   public function isProdukComplete(){
      if ($this->jenis_produk && $this->jumlah_produk_yang_dijual && $this->bahan_produk && $this->kategori_produk && $this->harga_produk && $this->keterangan_halal && $this->manfaat_fungsional && $this->manfaat_nonfungsional)
      {
         return true;
      }
      return false;
    }

}