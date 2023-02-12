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
use App\Models\Bisnis;
use App\Models\Kegiatan;
use App\Models\Role;
use App\Models\Janjitemu;
use App\Models\Investasi;
use App\Models\ProfilPerusahaan;
use App\Models\TugasAkhirJawaban;
use App\Models\kegiatan_umkm_pivot;
use App\Models\kegiatan_investor_pivot;
use App\Models\bisnis_umkm_pivot;
use App\Models\bisnis_investor_pivot;
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

    public function scopeFilter_umkm($query,array $filters){
       if($filters['nama_umkm'] ?? false) {
            $query ->whereHas('profil', function ($query) {
              $query->where('nama_lengkap', 'like', '%' . request('nama_umkm') . '%');
        });
      }
      if($filters['lokasi_umkm'] ?? false) {
            $query ->whereHas('profil', function ($query) {
              $query->where('provinsi', 'like', '%' . request('lokasi_umkm') . '%');
        });
      }
     if($filters['perusahaan_umkm'] ?? false) {
            $query->whereRelation('usaha','nama_perusahaan', 'like', '%' . request('perusahaan_umkm') . '%');
        }
     if ($filters['produk_umkm'] ?? false) {
         $query->whereRelation('produk', 'kategori_produk', 'like', '%' . request('produk_umkm') . '%');
     }

    
   }

    public function scopeFilter_investor($query,array $filters){
       if($filters['nama_investor'] ?? false) {
            $query ->whereHas('profil', function ($query) {
              $query->where('nama_lengkap', 'like', '%' . request('nama_investor') . '%');
        });
      }
      if($filters['lokasi_investor'] ?? false) {
            $query ->whereHas('profil', function ($query) {
              $query->where('provinsi', 'like', '%' . request('lokasi_investor') . '%');
        });
      }
     if($filters['perusahaan_investor'] ?? false) {
            $query->whereRelation('usaha','nama_perusahaan', 'like', '%' . request('perusahaan_investor') . '%');
        }
     if ($filters['kategori_investor'] ?? false) {
         $query->whereRelation('produk', 'kategori_produk', 'like', '%' . request('kategori_investor') . '%');
     }

    
   }

    public function scopeFilter_user_panel($query,array $filters){
       if($filters['cari'] ?? false) {
            $query ->whereHas('profil', function ($query) {
               $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');
        })->orWhere('email','like','%'.request('cari').'%')->orWhere('users.name','like','%'.request('cari').'%')->orWhere('no_telepon','like','%'.request('cari').'%');
      }

    
   }


    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->role()->create([]);
        });
    }

     public function delete(){
        $this->profil()->delete();
        if ($this->Role()->number == 2) {
            $this->produk()->delete();
            $this->finansial()->delete();
            $this->dokumenPerusahaan()->delete();
            $this->logbook()->delete();
            
        }
        else{
            $this->dokumenPerusahaan()->delete();
            $this->profilPerusahaan()->delete();
        }
        parent::delete();
   }
  
  

    public function profil(){
        return $this->hasOne(Profil::class);
    }

    public function inkubasi(){
        $data = DB::table('kegiatan_umkm')->where('umkm_id','=',$this->id)->first();
        if ($data) {
            return true;
        }
        else{
            return false;
        }
    }

     public function inkubasiInvestor(){
        $data = DB::table('kegiatan_investor')->where('investor_id','=',$this->id)->first();
        if ($data) {
            return true;
        }
        else{
            return false;
        }
    }

     public function pendanaanInvestor(){
        $data = DB::table('investasi')->where('user_id','=',$this->id)->first();
        if ($data) {
            return true;
        }
        else{
            return false;
        }
    }




    public function janji_temu(){
        $data = DB::table('janji_temu')->where('umkm_id','=',$this->id)->first();
        if ($data ) {
            return true;
        }
        else{
            return false;
        }
    }
     public function janji_temu_investor(){
        $data = DB::table('janji_temu')->where('investor_id','=',$this->id)->first();
        if ($data) {
            return true;
        }
        else{
            return false;
        }
    }

     public function pendanaan(){
        $data = DB::table('funding')->where('user_id','=',$this->id)->first();
        if ($data) {
            return true;
        }
        else{
            return false;
        }
    }


   public function kegiatanumkm(){
            return $this->belongsToMany(Kegiatan::class,'kegiatan_umkm','umkm_id','kegiatan_id')->using(kegiatan_umkm_pivot::class)->withPivot('lulus_funding')->orderBy('dimulai','desc');
    }
   public function kegiataninvestor(){
            return $this->belongsToMany(Kegiatan::class,'kegiatan_investor','investor_id','kegiatan_id')->orderBy('dimulai','desc');
   }

   public function bisnisinvestor(){
            return $this->belongsToMany(Bisnis::class,'bisnis_investor','investor_id','bisnis_id')->orderBy('name','asc');
   }

    public function bisnisumkm(){
            return $this->belongsToMany(Bisnis::class,'bisnis_peserta','umkm_id','bisnis_id')->orderBy('name','asc');
   }


    public function janjitemuinvestor(){
         return $this->hasMany(Janjitemu::class,'investor_id');
    }

    public function kegiatanumkm_pivot(){
         return $this->hasMany(kegiatan_umkm_pivot::class,'umkm_id');
    }

     public function kegiataninvestor_pivot(){
         return $this->hasMany(kegiatan_investor_pivot::class,'investor_id');
    }

    public function bisnisumkm_pivot(){
            return $this->hasMany(bisnis_umkm_pivot::class,'umkm_id');
    }
   public function bisnisinvestor_pivot(){
            return $this->hasMany(bisnis_investor_pivot::class,'investor_id');
   }


    public function investasi(){
         return $this->hasMany(investasi::class,'user_id');
   }

    public function janjitemumkm(){
         return $this->hasMany(Janjitemu::class,'umkm_id');
   }
    public function TugasAkhirJawaban(){
        return $this->hasOne(TugasAkhirJawaban::class,'user_id');
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
        return $this->hasOne(ProfilPerusahaan::class);
    }

    public function getPermissionArray()
    {
        return $this->getAllPermissions()->mapWithKeys(function ($pr) {
            return [$pr['name'] => true];
        });
    }
}
