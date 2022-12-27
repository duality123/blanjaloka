<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kegiatan;
use App\Models\Eventual;
class Tugas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['kegiatan_id',
                           'soal',
                           'id'];
    protected $table='tugas';
   
   public function kegiatan(){
            return $this->belongsToMany(User::class,'kegiatan_umkm','kegiatan_id','umkm_id');
    }
   public function investor(){
            return $this->belongsToMany(User::class,'kegiatan_investor','kegiatan_id','investor_id');
   }


   public function elearning(){
         return $this->hasMany(Elearning::class);
   }
    public function eventual(){
         return $this->hasMany(Eventual::class);
   }

   public function deleteKegiatan($id){
      DB::table('kegiatan')->where('id', '=', $id)->delete();
   }
}

