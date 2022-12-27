<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Elearning;
class BabElearning extends Model
{
    public $timestamps = false;
    protected $table='bab';
    protected $fillable =['elearning_id','link_video','judul','deskripsi','bab'];
    use HasFactory;



   public function elearning(){
         return $this->belongsTo(Elearning::class,'id','elearning_id');
    }



}