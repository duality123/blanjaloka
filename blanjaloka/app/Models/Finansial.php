<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Finansial extends Model
{
    public $timestamps = false;
    protected $table='kajian_finansial';
    use HasFactory;



   public function user(){
         return $this->belongsTo(User::class,'user_id','id');
    }

   public function finansialList(){
      $data = [];
      $data['capex'] = $this->capex;
      $data['opex'] = $this->opex;
      $data['swot_faktor_eksternal'] = $this->swot_faktor_eksternal;
      $data['swot_faktor_internal'] = $this->swot_faktor_internal;
      $data['payback_period']=$this->payback_period;
      $data['key_partners'] = $this->key_partners;
      $data['key_activity'] = $this->key_activity;
      $data['value_propotions'] = $this->value_propotions;
      $data['customer_relationship'] = $this->customer_relationship;
      $data['channels'] = $this->channels;
      $data['cost_structure'] = $this->cost_structure;
      $data['revenue_streams'] = $this->revenue_streams;
      return $data;
    }

   public function isFinansialComplete(){
      if ($this->capex && $this->opex && $this->swot_faktor_eksternal && $this->payback_period && $this->key_partners && $this->key_activity && $this->value_propotions && $this->customer_relationship && $this->channels && $this->cost_structure && $this->revenue_streams && $this->swot_faktor_internal)
      {
         return true;
      }
      return false;
    }

}