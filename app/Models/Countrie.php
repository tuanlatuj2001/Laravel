<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Deparment;

class Countrie extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'countrie_name', 'code','deleted_at'
    ];
    
    public function deparment(){
        $this->hasOne('App\Models\Deparment');
    }
}
