<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Elearning;
use App\Models\Investasi;
use Illuminate\Support\Facades\Storage;
class Funding extends Model
{
    public $timestamps = false;
    protected $table='funding';
    protected $fillable =[ 'uang_masuk','uang_keluar','bukti' ,'bisnis_id'  ,'user_id','tanggal'];
    use HasFactory;
    public function scopeFilter($query,array $filters){
       if($filters['cari'] ?? false) {
            $query->where('uang_masuk', 'like', '%' . request('cari') . '%')
                ->orWhere('uang_keluar', 'like', '%' . request('cari') . '%')
                ->orWhere('tanggal', 'like' ,'%' . request('cari') . '%');
        }
   }

   public function delete(){
    Storage::disk('public')->delete($this->bukti);
     parent::delete();
   }

   public function user(){
         return $this->belongsTo(User::class,'user_id','id');
    }
   public function bisnis(){
         return $this->belongsTo(Bisnis::class,'bisnis_id','id');
    }



}