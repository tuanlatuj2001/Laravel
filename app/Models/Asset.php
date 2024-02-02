<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'code','asset_name', 'location_id','condition','modele_id','serial',
        'supplier_id','manufacturer_id','categorie_id','price',
        'warranty','asset_code','note','deleted_at',
    ];
   
}