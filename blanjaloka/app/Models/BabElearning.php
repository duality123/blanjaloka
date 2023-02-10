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


    public function scopeFilter($query,array $filters){
       if($filters['cari'] ?? false) {
            $query->where('judul', 'like', '%' . request('cari') . '%')
                ->orWhere('deskripsi', 'like', '%' . request('cari') . '%');
        }
   }

   public function elearning(){
         return $this->belongsTo(Elearning::class,'elearning_id','id');
    }



}