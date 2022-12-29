<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Elearning;
class Bisnis extends Model
{
    public $timestamps = false;
    protected $table='bisnis';
    protected $fillable =['name','jumlah_investor','minimum_investasi','kategori','jumlah_investasi','target_investasi','target_investasi',
        'lokasi','persentase_hasil_investasi','waktu_balik_modal_start','waktu_balik_modal_end','foto_bisnis','status'];
    use HasFactory;


   public function umkm(){
         return $this->belongsToMany(User::class,'bisnis_peserta','bisnis_id','umkm_id');
    }
   public function investor(){
         return $this->belongsToMany(User::class,'bisnis_investor','bisnis_id','investor_id');
   }


}