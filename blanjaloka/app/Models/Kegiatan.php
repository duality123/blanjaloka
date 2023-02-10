<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Elearning;
use App\Models\Eventual;
use App\Models\Logbook;
use App\Models\TugasAkhirSoal;
use App\Models\TugasAkhirJawaban;
use Illuminate\Support\Facades\Storage;
class Kegiatan extends Model
{
    public $timestamps = false;
    protected $fillable = ['tema' ,
                         'deskripsi',
                         'jumlah_orang_diundang',
                         'nama_investor',
                         'masa_inkubasi',
                         'kurikulum',
                         'nama_juri',
                         'pic',
                         'kontak',
                         'draft',
                         'dimulai',
                         'berakhir',
                         'link',
                         'gambar',
                        'slug'];
    protected $table='kegiatan';
    use HasFactory;

   public function scopeFilter($query,array $filters){
       if($filters['cari'] ?? false) {
            $query->where('tema', 'like', '%' . request('cari') . '%')
                ->orWhere('dimulai', 'like', '%' . request('cari') . '%')
                ->orWhere('berakhir', 'like', '%' . request('cari') . '%');
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

   public function delete(){
     Storage::disk('public')->delete($this->gambar);
     $this->elearning()->delete();
     $this->eventual()->delete();
     $this->TugasAkhirJawaban()->delete();
     $this->logbook()->delete();
     parent::delete();
   }
   

   public function umkm(){
            return $this->belongsToMany(User::class,'kegiatan_umkm','kegiatan_id','umkm_id');
    }
   public function investor(){
            return $this->belongsToMany(User::class,'kegiatan_investor','kegiatan_id','investor_id');
   }


   public function elearning(){
         return $this->hasMany(Elearning::class,'kegiatan_id')->orderBy('hari_tanggal_waktu','asc');
   }

   public function logbook(){
         return $this->hasMany(Logbook::class,'kegiatan_id')->orderBy('waktu','asc');
   }

    public function eventual(){
         return $this->hasMany(Eventual::class,'kegiatan_id');
   }

     public function TugasAkhirSoal(){
         return $this->hasMany(TugasAkhirSoal::class,'kegiatan_id');
   }
   public function TugasAkhirJawaban(){
         return $this->hasMany(TugasAkhirJawaban::class,'kegiatan_id');
   }

}

