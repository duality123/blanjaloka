<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Bisnis;
use Illuminate\Support\Facades\Storage;
class Investasi extends Model
{
    public $timestamps = false;
    protected $table='investasi';
    protected $fillable =[ 'investasi_masuk','investasi_keluar','bukti','bisnis_id'  ,'user_id','tanggal'];
    use HasFactory;

    public function scopeFilter($query,array $filters){
       if($filters['cari'] ?? false) {
            $query->where('investasi_masuk', 'like', '%' . request('cari') . '%')
                ->orWhere('investasi_keluar', 'like', '%' . request('cari') . '%')
                ->orWhere('tanggal', 'like', '%' . request('cari') . '%');
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