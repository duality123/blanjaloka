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
use App\Models\Finansial;
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
            $user->profil()->create([]);
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

  
   public function umkm(){
      $data = DB::table('profil')
                ->join('usaha', 'profil.user_id' , '=', 'usaha.user_id')
                ->join('produk', 'profil.user_id' , '=', 'produk.user_id')
                ->join('kajian_finansial', 'profil.user_id' , '=', 'kajian_finansial.user_id')
                ->select('profil.nama_lengkap', 'profil.tempat_kelahiran', 'profil.tanggal_lahir','profil.alamat','profil.pendidikan_terakhir','profil.kelurahan','profil.kecamatan','profil.kabupaten','profil.provinsi','profil.no_hp','profil.kewarganegaraan','profil.status','profil.agama','profil.pengalaman_kerja','profil.foto_profil','profil.foto_ktp','profil.foto_dengan_ktp','usaha.nama_perusahaan','usaha.status_perusahaan','usaha.legalitas','usaha.dokumen_amdal','usaha.informasi_pajak','usaha.alamat_perusahaan','usaha.npwp','usaha.deskripsi_usaha','usaha.email_perusahaan','produk.jenis_produk','produk.jumlah_produk_yang_dijual','produk.bahan_produk','produk.harga_produk','produk.keterangan_halal','produk.manfaat_fungsional','produk.manfaat_nonfungsional','kajian_finansial.capex','kajian_finansial.opex','kajian_finansial.swot_faktor_internal','kajian_finansial.swot_faktor_eksternal','kajian_finansial.payback_period','kajian_finansial.key_activity','kajian_finansial.value_propotions','kajian_finansial.customer_relationship','kajian_finansial.channels','kajian_finansial.cost_structure','kajian_finansial.revenue_streams')
                ->where('profil.user_id','=',$this->id)
                ->first(); 
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
        return $this->hasOne(Role::class);
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
