<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kegiatan;
use App\Models\Eventual;
class TugasAkhirSoal extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['kegiatan_id',
                           'soal',];
    protected $table='tugas_akhir_soal';
   
    public function kegiatan(){
            return $this->belongsTo(Kegiatan::class,'kegiatan_id','id');
    }
}


