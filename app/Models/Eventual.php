<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Kegiatan;
use App\Models\Profil;
class Eventual extends Model
{
    public $timestamps = false;
    protected $table='eventual';
    protected $fillable =['profil_id','waktu','kontak','perihal','id','nama_mentor','link_meeting','jadwal'];
   
    use HasFactory;


/*
   public function kegiatan(){
         return $this->belongsTo(Kegiatan::class,'kegiatan_id','id');
    }
*/
   public function profil(){
      return $this->belongsTo(Profil::class,'profil_id','id');
   }


}