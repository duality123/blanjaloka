<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Kegiatan;
class Janjitemu extends Model
{
    public $timestamps = false;
    protected $table='janji_temu';
    protected $fillable =['lokasi','waktu','status','temp_target','investor_id','umkm_id'];
    use HasFactory;

    
}