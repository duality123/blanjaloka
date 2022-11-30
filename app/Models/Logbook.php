<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class Logbook extends Model
{
    public $timestamps = false;
    protected $table='logbook';
    protected $fillable =['deskripsi','status','bukti_kegiatan','waktu','user_id','kegiatan_id'];
    use HasFactory;




   public function user(){
         return $this->belongsToMany(User::class,'id','user_id');
    }
   static function fetchAndPaginate($limit = 0,$page=0,$user_id=null,$kegiatan_id=null){
       $offset = ($limit * $page) - $limit;
       $maxData = DB::select("select count(*) as total from logbook where kegiatan_id = '$kegiatan_id' and user_id = '$user_id'");
       $data['paginate']['totalPaginasi'] = ceil(($maxData[0]->total)/ $limit);
       //var_dump($maxData[0]->total);
       $data['items'] = DB::select("select id,waktu,status,deskripsi,bukti_kegiatan from logbook where user_id = '$user_id' and kegiatan_id = '$kegiatan_id' limit $offset,$limit");
       
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

   public function usahaList(){
      $data = [];
      $data['nama_perusahaan']= $this->nama_perusahaan;
      $data['status_perusahaan'] = $this->status_perusahaan;
      $data['legalitas'] = $this->legalitas;
      $data['dokumen_amdal'] = $this->dokumen_amdal;
      $data['informasi_pajak'] = $this->informasi_pajak;
      $data['alamat_perusahaan'] = $this->alamat_perusahaan;
      $data['npwp'] = $this->npwp;
      $data['deskripsi_usaha'] = $this->deskripsi_usaha;
      $data['email_perusahaan'] = $this->email_perusahaan;
      return $data;
    }

   public function isUsahaComplete(){
      if ($this->nama_perusahaan && $this->status_perusahaan && $this->legalitas && $this->dokumen_amdal && $this->informasi_pajak && $this->npwp && $this->deskripsi_usaha && $this->email_perusahaan &&
      $this->alamat_perusahaan )
      {
         return true;
      }
      return false;
    }

}