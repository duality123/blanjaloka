<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Elearning;
use App\Models\Investasi;
use App\Models\Funding;
class Laporan extends Model
{
  protected $table = 'laporan';
  protected $fillable =['pesan','email','gambar','tandai'];
  public $timestamps = false; 

    public function scopeFilter($query,array $filters){
        if($filters['cari'] ?? false) {
             $query->where('pesan', 'like', '%' . request('cari') . '%')
             ->where('email', 'like', '%' . request('cari') . '%');
            }
        if($filters['tanda'] ?? false) {
             $kondisi;
                 if (request('tanda')=='t') {
                        $kondisi = 1;
                 }
                else{
                    $kondisi = 0;
                }
            $query->where('tandai','=',$kondisi);
        }
    }

    public function delete(){
     Storage::disk('public')->delete($this->gambar);
     parent::delete();
   }
}