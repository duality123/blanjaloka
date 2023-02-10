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
    protected $fillable =['lokasi','waktu','status','temp_target','investor_id','umkm_id','berakhir'];
    use HasFactory;

    public function scopeFilter($query,array $filters){
       if($filters['cari'] ?? false) {
           $query->whereHas('umkm.profil', function ($query) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');})
                   ->orWhereHas('investor.profil', function ($query) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');})
                   ->orWhere(function ($query) {
            $query->where('lokasi', 'like', '%' . request('cari') . '%')
                ->orWhere('waktu', 'like', '%' . request('cari') . '%')
                ->orWhere('berakhir', 'like', '%' . request('cari') . '%');});
        }
          if($filters['nama_investor'] ?? false) {
            $query ->whereHas('investor.profil', function ($query) {
              $query->where('nama_lengkap', 'like', '%' . request('nama_investor') . '%');
        });
        }
        if($filters['nama_umkm'] ?? false) {
                $query ->whereHas('umkm.profil', function ($query) {
                  $query->where('nama_lengkap', 'like', '%' . request('nama_umkm') . '%');
            });
          }
        if($filters['lokasi'] ?? false) {
             $query->where('lokasi', 'like', '%' . request('lokasi') . '%');
            }
        if ($filters['event_dimulai'] ?? false) {
            $query->where('dimulai', 'like', '%' . request('event_dimulai') . '%');
        }
        if ($filters['event_berakhir'] ?? false) {
            $query->where('berakhir', 'like', '%' . request('event_berakhir') . '%');
        }
        
         if($filters['berakhir'] ?? false) {
                $kondisi;
                 if (request('berakhir')=='t') {
                        $kondisi = '<';
                 }
                else{
                    $kondisi = '>';
                }
                $query->where('berakhir', $kondisi,now());
        }
         
   }
    public function investor(){
        return $this->belongsTo(User::class,'investor_id','id');
    }

     public function umkm(){
        return $this->belongsTo(User::class,'umkm_id','id');
    }

    
}