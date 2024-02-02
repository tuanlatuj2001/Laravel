<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Deparment;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'location_name', 'note', 'deparment_id','deleted_at'
    ];
    
    function deparment(){
        return $this->belongsTo(Deparment::class);
    }
}
