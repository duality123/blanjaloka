<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Elearning;
use App\Models\Eventual;
class Kegiatan extends Model
{
    public $timestamps = false;
    protected $fillable = ['tema' ,
                         'deskripsi',
                         'jumlah_orang_diundang',
                         'nama_investor',
                         'masa_inkubasi',
                         'kurikulum',
                         'nama_juri',
                         'pic',
                         'kontak',
                         'draft',
                         'dimulai',
                         'berakhir',
                         'link',
                         'gambar','id'];
    protected $table='kegiatan';
    use HasFactory;



   public function umkm(){
            return $this->belongsToMany(User::class,'kegiatan_umkm','kegiatan_id','umkm_id');
    }
   public function investor(){
            return $this->belongsToMany(User::class,'kegiatan_investor','kegiatan_id','investor_id');
   }


   public function elearning(){
         return $this->hasMany(Elearning::class,'kegiatan_id');
   }

   public function tugas(){
         return $this->hasMany(Tugas::class);
   }
    public function eventual(){
         return $this->hasMany(Eventual::class,'kegiatan_id');
   }

   public function deleteKegiatan($id){
      DB::table('kegiatan')->where('id', '=', $id)->delete();
   }
}

