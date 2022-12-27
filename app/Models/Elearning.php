<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Kegiatan;
use App\Models\BabElearning;
class Elearning extends Model
{
    public $timestamps = false;
    protected $table='elearning';
    protected $fillable =['kegiatan_id','hari_tanggal_waktu','judul','deskripsi','foto','id'];

    use HasFactory;



   public function kegiatan(){
         return $this->belongsTo(Kegiatan::class,'kegiatan_id','id');
    }

    public function bab(){
      return $this->hasMany(BabElearning::class);
    }


}