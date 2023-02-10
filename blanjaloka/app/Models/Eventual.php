<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Kegiatan;
use App\Models\Profil;
class Eventual extends Model
{
    public $timestamps = false;
    protected $table='eventual';
    protected $fillable =['profil_id','waktu','kontak','perihal','nama_mentor','link_meeting','jadwal','status','kegiatan_id'];
   
    use HasFactory;

    public function scopeFilter($query,array $filters){
        if($filters['cari'] ?? false) {
       $query->whereHas('profil', function ($query) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');})
                  ->orWhere(function ($query) {
             $query->where('perihal', 'like', '%' . request('cari') . '%')
                ->orWhere('nama_mentor', 'like', '%' . request('cari') . '%')
                ->orWhere('kontak', 'like', '%' . request('cari') . '%');});
   }
}
   public function profil(){
     return $this->belongsTo(Profil::class,'profil_id','id');
   }

   public function kegiatan(){
      return $this->belongsTo(Kegiatan::class,'kegiatan_id','id');
    }

 


}