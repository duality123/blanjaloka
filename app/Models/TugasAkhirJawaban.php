<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kegiatan;
use App\Models\Eventual;
use App\Models\User;
class TugasAkhirJawaban extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['jawaban','file','gambar','user_id','kegiatan_id' ];
    protected $table='tugas_akhir_jawaban';
   
   public function kegiatan(){
            return $this->belongsTo(Kegiatan::class,'kegiatan_id','id');
    }
   public function user(){
            return $this->belongsTo(User::class,'user_id','id')->orderBy('name','asc');
    }

  public function scopeFilter($query,array $filters){
       if($filters['cari'] ?? false) {
            $query->whereHas('user.profil', function ($query) {
            $query->where('nama_lengkap', 'like', '%' . request('cari') . '%');});
        };
      
  }
public function delete(){
     Storage::disk('public')->delete($this->gambar);
     Storage::disk('public')->delete($this->file);
     parent::delete();
   } 
}
