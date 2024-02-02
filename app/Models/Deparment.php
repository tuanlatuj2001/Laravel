<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Location;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Deparment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'deparment_name','floor', 'until', 'building','street','city','state','id_countrie','zipcode','deleted_at'
    ];
   
  
    
}
