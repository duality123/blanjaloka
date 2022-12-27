<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use App\Models\Profil;
use App\Models\Usaha;
use App\Models\Produk;
use App\Models\Kegiatan;
use App\Models\Role;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $guarded = [];

    protected $hidden = [ 
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->role()->create([]);
        });
    }

    static function fetchAndPaginate($role,$limit = 0,$page=0){
       $offset = ($limit * $page) - $limit;
       $maxData = DB::select("select count(*) as total from users where role = '$role'");
       $data['paginate']['totalPaginasi'] = ceil(($maxData[0]->total)/ $limit);
       //var_dump($maxData[0]->total);
       $data['items'] = DB::select("select users.id,users.email,users.created_at,users.accepted,users.no_telepon from users where id in (select user_id from roles where number = $role) limit $offset,$limit");
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

    static function fetchAndPaginate4Inkubasi($limit = 0,$page=0,$kegiatan_id=null){
       $offset = ($limit * $page) - $limit;
       $maxData = DB::select("select count(*) as total from kegiatan_umkm where kegiatan_id = '$kegiatan_id'");
       $data['paginate']['totalPaginasi'] = ceil(($maxData[0]->total)/ $limit);
       //var_dump($maxData[0]->total);
       $data['items'] = DB::select("select nama_lengkap,user_id as id from profil where user_id in (select umkm_id from kegiatan_umkm where kegiatan_id = '$kegiatan_id') order by nama_lengkap asc limit $offset,$limit");
       
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

  
  

    public function profil(){
        return $this->hasOne(Profil::class);
    }

    public function inkubasi(){
        $data = DB::table('kegiatan_umkm')->where('umkm_id','=',$this->id)->get();
        if ($data) {
            return true;
        }
        else{
            return false;
        }
    }


   public function kegiatanumkm(){
            return $this->belongsToMany(Kegiatan::class,'kegiatan_umkm','umkm_id','kegiatan_id');
    }
   public function kegiataninvestor(){
            return $this->belongsToMany(Kegiatan::class,'kegiatan_investor','investor_id','kegiatan_id');
   }

    public function produk(){
        return $this->hasOne(Produk::class);
    }
    public function usaha(){
        return $this->hasOne(Usaha::class);
    }
     public function finansial(){
        return $this->hasOne(Finansial::class);
    }
    public function role(){
        return $this->hasOne(Role::class,'user_id');
    }
    public function dokumenPerusahaan(){
        return $this->hasOne(DokumenPerusahaan::class);
    }
    public function profilPerusahaan(){
        return $this->hasOne(profilPerusahaan::class);
    }

    public function getPermissionArray()
    {
        return $this->getAllPermissions()->mapWithKeys(function ($pr) {
            return [$pr['name'] => true];
        });
    }
}
