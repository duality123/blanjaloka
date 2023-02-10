<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\DB;
class Logbook extends Model
{
    public $timestamps = false;
    protected $table='logbook';
    protected $fillable =['deskripsi','status','bukti_kegiatan','waktu','user_id','kegiatan_id'];
    use HasFactory;


   public function scopeFilter($query,array $filters){
       if($filters['cari'] ?? false) {
            $query->where('deskripsi', 'like', '%' . request('cari') . '%')
                ->orWhere('status', 'like', '%' . request('cari') . '%')
                ->orWhere('waktu', 'like', '%' . request('cari') . '%');
        }
   }


   public function user(){
         return $this->belongsTo(User::class,'user_id','id');
    }


   public function kegiatan(){
         return $this->belongsTo(Kegiatan::class,'kegiatan_id','id');
    }


   public function delete(){

     Storage::disk('public')->delete($this->bukti_kegiatan);


     parent::delete();
   }
  


}