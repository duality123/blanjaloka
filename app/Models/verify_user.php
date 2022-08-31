<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class verify_user extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $table = 'verify_user';
    
    protected $fillable = [
        'user_id',
        'token',
    ];
   
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
