<?php

namespace App\Repository;
use App\Models\Deparment;
use App\Models\Location;
use App\Models\Asset;
use App\Models\Categorie;
use App\Models\Manufacturer;
use App\Models\Supplier;
use Illuminate\Support\Str;


class AssetRepository implements IAssetRepository{

    public function getAsset(){
        return Asset::join('suppliers', 'assets.supplier_id', '=', 'suppliers.id')
        ->join('modeles', 'assets.modele_id', '=', 'modeles.id')
        ->join('locations', 'assets.location_id', '=', 'locations.id')
        ->join('deparments', 'locations.deparment_id', '=', 'deparments.id')
        ->select('assets.*','suppliers.supplier_name', 'modeles.modele_name','locations.location_name','deparments.deparment_name');
    }
    public function findAsset($id){
        return Asset::select('assets.*','suppliers.supplier_name', 'modeles.modele_name','locations.location_name','deparments.deparment_name')
        ->join('suppliers', 'assets.supplier_id', '=', 'suppliers.id')
        ->join('modeles', 'assets.modele_id', '=', 'modeles.id')
        ->join('locations', 'assets.location_id', '=', 'locations.id')
        ->join('deparments', 'locations.deparment_id', '=', 'deparments.id')
        ->where('assets.id',$id)->groupBy('assets.id')->get()
        
        ;
    }

    public function generate($id){
        return Asset::where('id','=', $id)->update([
            'asset_code'=>random_int(10000000000, 99999999999)]);  
    }

    public function createAsset(array $data){
        Asset::create([
            'asset_name'=>$data['asset_name'],
            'categorie_id'=>$data['categorie_id'],
            'location_id'=>$data['location_id'] ,
            'condition'=>$data['condition'] ,
            'note'=>$data['note'] ,
            'manufacturer_id'=>$data['manufacturer_id'] ,
            'modele_id'=>$data['modele_id'] ,
            'warranty'=>$data['warranty'] ,
            'price'=>$data['price'] ,
            'serial'=>$data['serial'] ,
            'supplier_id'=>$data['supplier_id'] ,
            'asset_code'=>random_int(10000000000, 99999999999),
            'code' => Str::random(10),
        ]);
    }
    
    public function getCategorie(){
        return Categorie::all();
    }
    public function getLocation(){
        return Location::all();
    }
    public function getManufacturer(){
        return Manufacturer::all();
    }
    public function getSupplier(){
        return Supplier::all();
    }
    public function getAllAsset(){
        return Asset::all();
    }
    public function editAsset($id){
        return Asset::find($id);
    }
    public function updateAsset($id ,array $data){
        Asset::find($id)->update([
            'asset_name'=>$data['asset_name'],
            'categorie_id'=>$data['categorie_id'],
            'location_id'=>$data['location_id'] ,
            'condition'=>$data['condition'] ,
            'note'=>$data['note'] ,
            'manufacturer_id'=>$data['manufacturer_id'] ,
            'modele_id'=>$data['modele_id'] ,
            'warranty'=>$data['warranty'] ,
            'price'=>$data['price'] ,
            'serial'=>$data['serial'] ,
            'supplier_id'=>$data['supplier_id'] ,
            'asset_code'=>random_int(10000000000, 99999999999),
            'code' => Str::random(10),
        ]);
    }

    public function deleteLocation($id){
        return Location::find($id)->delete();
    }
}

