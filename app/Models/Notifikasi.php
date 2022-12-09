<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class Notifikasi extends Model
{
    public $timestamps = false;
    protected $table='notifikasi';
    protected $fillable =['nama','pesan','user_id','redirect'];
    use HasFactory;



   public function user(){
         return $this->belongsToMany(User::class,'id','user_id');
    }

   static function deleteNotif($id){
      DB::table('notifikasi')->where('id', '=', $id)->delete();
    }


   static function fetchAndPaginate($user_id,$limit = 0,$page=0){
       $offset = ($limit * $page) - $limit;
       $maxData = DB::select("select count(*) as total from notifikasi where user_id = '$user_id'");
       $data['paginate']['totalPaginasi'] = ceil(($maxData[0]->total)/ $limit);
       //var_dump($maxData[0]->total);
       $data['items'] = DB::select("select id,nama,pesan,tanggal,redirect from notifikasi where user_id = '$user_id' order by tanggal desc");
       /*
       $data['paginate']['nums'] = [];
       $index = ($page % 5 == 0) ? intval($page) - (intval($page) - 4 ): (intval($page) - ((intval($page) % 5))) + 1 ;
       $loopIndex = $index;
       while (count($data['paginate']['nums']) < 5 && $loopIndex <= $data['paginate']['totalPaginasi'] ) {
          $data['paginate']['nums'][] = $loopIndex;
          $loopIndex++;
       }
       //dd($data['paginate']['nums']);
       $data['paginate']['nextBlok'] = $loopIndex < $data['paginate']['totalPaginasi'] ?  $index + 5 : 0;
       $data['paginate']['prevBlok'] = $page > 5 ?  $page - 5 : 0;
       //dd($data['paginate']['totalPaginasi']);
       $data['paginate']['prev'] = ($page - 1 > 0) ? $page - 1 : 0;
       $data['paginate']['first'] = ($page > 5) ? 1 : 0;
       $data['paginate']['last'] = ($page+4 < $data['paginate']['totalPaginasi']) ? $data['paginate']['totalPaginasi'] : 0;
       $data['paginate']['next'] = ($page + 1 < $data['paginate']['totalPaginasi'] )? $page + 1 : 0;
      // dd($data);
       return $data;
    }
    */
     return $data;

}

}