<?php

namespace App\Repository;
use App\Models\Deparment;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotMail;

class LocationRepository implements ILocationRepository{

    public function getLocation(){
        return Location::join('deparments', 'locations.deparment_id', '=', 'deparments.id')
        ->join('countries', 'deparments.countrie_id', '=', 'countries.id')
        ->select('locations.*','deparments.building',
        'deparments.street','deparments.city','deparments.state',
       'countries.countrie_name');
    }

    public function getDeparment(){
        return Deparment::all();
    }

    public function createLocation(array $data){
        Location::insert([
            'location_name'=>$data['location_name'],
            'note'=>$data['note'],
            'deparment_id'=>$data['deparment_id'] ,
        ]);
    }
    
    public function copyLocation($id){
        $location=Location::find($id)->replicate();
        $location->save();
    }
    public function editLocation($id){
        return Location::find($id);
    }
    public function updateLocation($id ,array $data){
        Location::find($id)->update([
            'location_name'=>$data['location_name'],
            'note'=>$data['note'],
            'deparment_id'=>$data['deparment_id'] ,
        ]);
    }

    public function deleteLocation($id){
        return Location::find($id)->delete();
    }
    public function finddeparment($id){
       $l=Location::find($id);
       return Deparment::where('id',$l->deparment_id)->get();
    }
}

