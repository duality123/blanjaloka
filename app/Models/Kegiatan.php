<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Elearning;
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
                         'gambar'];
    protected $table='kegiatan';
    use HasFactory;

    static function beranda($limit = 0,$page=0,$id){
       $offset = ($limit * $page) - $limit;
       $maxData = DB::select("select count(*) as total from kegiatan where id not in (select kegiatan_id from kegiatan_umkm where umkm_id = $id)");
       $data['paginate']['totalPaginasi'] = ceil(($maxData[0]->total)/ $limit);
       //var_dump($maxData[0]->total);
       $data['items'] = DB::select("select kegiatan.id,kegiatan.tema,kegiatan.dimulai,kegiatan.berakhir,kegiatan.link,kegiatan.deskripsi,kegiatan.jumlah_orang_diundang,kegiatan.gambar, count(kegiatan_umkm.umkm_id) as total_peserta from kegiatan left join kegiatan_umkm on kegiatan.id = kegiatan_umkm.kegiatan_id where kegiatan.id not in (select kegiatan_id from kegiatan_umkm where umkm_id = $id) group by kegiatan.id,kegiatan.tema,kegiatan.dimulai,kegiatan.berakhir,kegiatan.link,kegiatan.deskripsi,kegiatan.gambar,kegiatan.jumlah_orang_diundang  order by dimulai  limit $offset,$limit");
       $data['paginate']['nums'] = [];
       $index = ($page % 5 == 0) ? intval($page) - (intval($page) - 4 ): (intval($page) - ((intval($page) % 5))) + 1 ;
       $loopIndex = $index;
       while (count($data['paginate']['nums']) < 5 && $loopIndex <= $data['paginate']['totalPaginasi'] ) {
          $data['paginate']['nums'][] = $loopIndex;
          $loopIndex++;
       }
       //dd($data['paginate']['nums']);
       $data['paginate']['nextBlok'] = $loopIndex + 1 < $data['paginate']['totalPaginasi'] ?  $loopIndex + 1 : 0;
       $data['paginate']['prevBlok'] = $page > 5 ?  $page - 5 : 0;
       //dd($data['paginate']['totalPaginasi']);
       $data['paginate']['prev'] = ($page - 1 > 0) ? $page - 1 : 0;
       $data['paginate']['first'] = ($page > 5) ? 1 : 0;
       $data['paginate']['last'] = ($page+4 < $data['paginate']['totalPaginasi']) ? $data['paginate']['totalPaginasi'] : 0;
       $data['paginate']['next'] = ($page + 1 < $data['paginate']['totalPaginasi'] )? $page + 1 : 0;
      // dd($data);
       return $data;
    }

   static function fetchAndPaginate($limit = 0,$page=0){
       $offset = ($limit * $page) - $limit;
       $maxData = DB::select("select count(*) as total from kegiatan");
       $data['paginate']['totalPaginasi'] = ceil(($maxData[0]->total)/ $limit);
       //var_dump($maxData[0]->total);
       $data['items'] = DB::select("select kegiatan.id,kegiatan.tema,kegiatan.dimulai,kegiatan.berakhir,kegiatan.link,kegiatan.draft,kegiatan.jumlah_orang_diundang, count(kegiatan_umkm.umkm_id) as total_peserta from kegiatan left join kegiatan_umkm on kegiatan.id = kegiatan_umkm.kegiatan_id group by kegiatan.id,kegiatan.tema,kegiatan.dimulai,kegiatan.berakhir,kegiatan.link,kegiatan.draft,kegiatan.jumlah_orang_diundang order by dimulai  limit $offset,$limit");
       $data['paginate']['nums'] = [];
       $index = ($page % 5 == 0) ? intval($page) - (intval($page) - 4 ): (intval($page) - ((intval($page) % 5))) + 1 ;
       $loopIndex = $index;
       while (count($data['paginate']['nums']) < 5 && $loopIndex <= $data['paginate']['totalPaginasi'] ) {
          $data['paginate']['nums'][] = $loopIndex;
          $loopIndex++;
       }
       //dd($data['paginate']['nums']);
       $data['paginate']['nextBlok'] = $loopIndex + 1 < $data['paginate']['totalPaginasi'] ?  $loopIndex + 1 : 0;
       $data['paginate']['prevBlok'] = $page > 5 ?  $page - 5 : 0;
       //dd($data['paginate']['totalPaginasi']);
       $data['paginate']['prev'] = ($page - 1 > 0) ? $page - 1 : 0;
       $data['paginate']['first'] = ($page > 5) ? 1 : 0;
       $data['paginate']['last'] = ($page+4 < $data['paginate']['totalPaginasi']) ? $data['paginate']['totalPaginasi'] : 0;
       $data['paginate']['next'] = ($page + 1 < $data['paginate']['totalPaginasi'] )? $page + 1 : 0;
      // dd($data);
       return $data;
    }

   static function fetchAndPaginate4UMKM($limit = 0,$page=0,$id){
       $offset = ($limit * $page) - $limit;
       $maxData = DB::select("select count(*) as total from kegiatan_umkm where umkm_id = '$id'");
       $data['paginate']['totalPaginasi'] = ceil(($maxData[0]->total)/ $limit);
       $data['items'] = DB::select("select kegiatan.id,kegiatan.tema,kegiatan.dimulai,kegiatan.berakhir,kegiatan.gambar from kegiatan where id in (select kegiatan_id from kegiatan_umkm where umkm_id = '$id')  order by kegiatan.berakhir asc limit $offset,$limit");
       $data['paginate']['nums'] = [];
       $index = ($page % 5 == 0) ? intval($page) - (intval($page) - 4 ): (intval($page) - ((intval($page) % 5))) + 1 ;
       $loopIndex = $index;
       while (count($data['paginate']['nums']) < 5 && $loopIndex <= $data['paginate']['totalPaginasi'] ) {
          $data['paginate']['nums'][] = $loopIndex;
          $loopIndex++;
       }
       //dd($data['paginate']['nums']);
       $data['paginate']['nextBlok'] = $loopIndex + 1 < $data['paginate']['totalPaginasi'] ?  $loopIndex + 1 : 0;
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
            return $this->belongsToMany(User::class,'kegiatan_umkm','kegiatan_id','umkm_id');
    }
   public function investor(){
            return $this->belongsToMany(User::class,'kegiatan_investor','kegiatan_id','investor_id');
   }


   public function Kegiatan(){
         return $this->hasMany(Elearning::class,'id');
   }

   public function deleteKegiatan($id){
      DB::table('kegiatan')->where('id', '=', $id)->delete();
   }
}

