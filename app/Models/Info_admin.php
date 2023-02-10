<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Elearning;
use App\Models\Investasi;
use Illuminate\Support\Facades\Storage;
class Info_admin extends Model
{
    public $timestamps = false;
    protected $table='info_admin';
    protected $fillable =[ 'judul','isi','tanggal','tandai' ];
    use HasFactory;
    public function scopeFilter($query,array $filters){
       if($filters['cari'] ?? false) {
            $query->Where('isi', 'like', '%' . request('cari') . '%')
                ->orWhere('tanggal', 'like' ,'%' . request('cari') . '%');
        }

       if($filters['tanda'] ?? false) {
            $query->where('tandai','=',request('tanda'));
        }
   }



}