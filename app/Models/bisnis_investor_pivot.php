<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Elearning;
use App\Models\Investasi;
use App\Models\Funding;
class bisnis_investor_pivot extends Pivot
{
  protected $table = 'bisnis_investor';
  public $timestamps = false; 

}