<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Elearning;
class Bisnis extends Model
{
    public $timestamps = false;
    protected $table='bisnis';
    protected $fillable =['name','jumlah_investor','minimum_investasi','kategori','jumlah_investasi','target_investasi','target_investasi',
        'lokasi','presentase_hasil_investasi','waktu_balik_modal_start','waktu_balik_modal_end','foto_bisnis'];
    use HasFactory;


   static function fetchAndPaginate($limit = 0,$page=0,$user_id=null){
       $offset = ($limit * $page) - $limit;
       $maxData = DB::select("select count(*) as total from bisnis where id in (select bisnis_id from bisnis_investor where investor_id = $user_id)");
       $data['paginate']['totalPaginasi'] = ceil(($maxData[0]->total)/ $limit);
       $data['items'] = DB::select("select bisnis.name,foto_bisnis from bisnis where id in (select bisnis_id from bisnis_investor where investor_id = $user_id) order by bisnis.jumlah_investasi asc limit $offset,$limit");
       $data['paginate']['nums'] = [];
       $index = ($page % 5 == 0) ? intval($page) - (intval($page) - 4 ): (intval($page) - ((intval($page) % 5))) + 1 ;
       $loopIndex = $index;
       while (count($data['paginate']['nums']) < 5 && $loopIndex <= $data['paginate']['totalPaginasi'] ) {
          $data['paginate']['nums'][] = $loopIndex;
          $loopIndex++;
       }
       //dd($data['paginate']['nums']);
       $data['paginate']['nextBlok'] = $loopIndex + 1 < $data['paginate']['totalPaginasi'] ?  $index + 1 : 0;
       $data['paginate']['prevBlok'] = $page > 5 ?  $page - 5 : 0;
       //dd($data['paginate']['totalPaginasi']);
       $data['paginate']['prev'] = ($page - 1 > 0) ? $page - 1 : 0;
       $data['paginate']['first'] = ($page > 5) ? 1 : 0;
       $data['paginate']['last'] = ($page+4 < $data['paginate']['totalPaginasi']) ? $data['paginate']['totalPaginasi'] : 0;
       $data['paginate']['next'] = ($page + 1 < $data['paginate']['totalPaginasi'] )? $page + 1 : 0;
      // dd($data);
       return $data;
    }

   public function umkm(){
         return $this->belongsToMany(User::class,'bisnis_umkm','bisnis_id','umkm_id');
    }
   public function investor(){
         return $this->belongsToMany(User::class,'bisnis_investor','bisnis_id','investor_id');
   }


}