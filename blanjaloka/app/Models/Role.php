<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Role extends Model
{
    public $timestamps = false;
    protected $table='roles';
    protected $fillable = ['number'];
    use HasFactory;



   public function user(){
         return $this->belongsTo(User::class,'user_id','id');
    }

}