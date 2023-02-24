<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Elearning;
use App\Models\Investasi;
use App\Models\Funding;
class Bisnis extends Model
{
    public $timestamps = false;
    protected $table='bisnis';
    protected $fillable =['name','jumlah_investor','minimum_investasi','kategori','jumlah_investasi','target_investasi',
        'lokasi','persentase_hasil_investasi','waktu_balik_modal_start','waktu_balik_modal_end','foto_bisnis','status','total_penghasilan'];
    use HasFactory;


    public function scopeFilter($query,array $filters){
       if($filters['cari'] ?? false) {
            $query->where('name', 'like', '%' . request('cari') . '%');
         }
        if($filters['profit'] ?? false) {
                $kondisi;
                 if (request('profit')=='t') {
                        $kondisi = '>';
                }
                else{
                    $kondisi = '<';
                }
                $query->where('persentase_hasil_investasi', $kondisi,0);
        }
         

   }
    public function delete(){
        $this->funding()->delete();
        $this->investasi()->delete();

    }

   
   public function umkm(){
         return $this->belongsToMany(User::class,'bisnis_peserta','bisnis_id','umkm_id');
    }

   public function investasi(){
         return $this->hasMany(Investasi::class,'bisnis_id')->orderBy('tanggal','desc');;
    } 


   public function funding(){
         return $this->hasMany(Funding::class,'bisnis_id')->orderBy('tanggal','desc');;
    } 
   public function investor(){
         return $this->belongsToMany(User::class,'bisnis_investor','bisnis_id','investor_id');
   }


}