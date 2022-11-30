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



   public function kegiatan(){
         return $this->belongsTo(Elearning::class,'id','elearning_id');
    }


   static function fetchAndPaginate($limit = 0,$page=0,$elearning_id=null){
       $offset = ($limit * $page) - $limit;
       $maxData = DB::select("select count(*) as total from bab where elearning_id = $elearning_id ");
       $data['paginate']['totalPaginasi'] = ceil(($maxData[0]->total)/ $limit);
       //var_dump($maxData[0]->total);
       $data['items'] = DB::select("select bab.id,bab.judul,bab.deskripsi,bab.bab,bab.link_video from bab where bab.elearning_id = $elearning_id order by bab.bab asc limit $offset,$limit");
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

}