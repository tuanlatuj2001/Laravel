<?php

namespace App\Repository;
use App\Models\Deparment;
use App\Models\Location;
use App\Models\User;
use App\Models\Asset;
use App\Models\Manufacturer;
use App\Models\Supplier;
use Illuminate\Support\Str;


class DashboardRepository implements IDashboardRepository{

    public function getUser(){
        return User::join('locations', 'locations.id', '=', 'users.location_id')
        ->select('locations.location_name','users.*')->take(10)->get();
    }
    public function getAsset(){
        return Asset::join('suppliers', 'assets.supplier_id', '=', 'suppliers.id')
        ->join('modeles', 'assets.modele_id', '=', 'modeles.id')
        ->join('locations', 'assets.location_id', '=', 'locations.id')
        ->join('deparments', 'locations.deparment_id', '=', 'deparments.id')
        ->select('assets.*','suppliers.supplier_name', 'modeles.modele_name','locations.location_name','deparments.deparment_name')->take(10)->get();
    }
    public function countUser(){
        return User::count();
    }
    public function countAsset(){
        return Asset::count();
    }
}

