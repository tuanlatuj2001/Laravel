<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modele extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'modele_name','manufacturer_id','deleted_at'
    ];
    
}
