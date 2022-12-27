<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Elearning;
use App\Models\Eventual;
class Submission extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 
                           'kegiatan_id',
                           'user_id',
                           'jawaban',
                           'nama'];
    protected $table='submission';
    use HasFactory;




   public function user(){
         return $this->belongsTo(User::class,'id','user_id');
   }

   public function kegiatan(){
         return $this->belongsTo(User::class,'id','user_id');
   }
}

