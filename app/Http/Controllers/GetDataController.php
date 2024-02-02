<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deparment;
use App\Models\Countrie;
use App\Models\Categorie;
use App\Models\Manufacturer;
use App\Models\Modele;
use App\Models\Supplier;

class GetDataController extends Controller
{
    public function deparment(){
        $data=Deparment::paginate(10);
        return $data;
    }
    public function countrie(){
        $data=Countrie::paginate(10);
        return $data;
    }
    public function categorie(){
        $data=Categorie::paginate(10);
        return $data;
    }
    public function manufacturer(){
        $data=Manufacturer::paginate(10);
        return $data;
    }
    public function modele(){
        $data=Modele::paginate(10);
        return $data;
    }
    public function supplier(){
        $data=Supplier::paginate(10);
        return $data;
    }
}
