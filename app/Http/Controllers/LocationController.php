<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Deparment;
use App\Http\Requests\CreateLocationFormRequest;
use Illuminate\Support\Facades\Validator;
use App\Imports\LocationImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\LocationRequest;
use App\Http\Requests\ImportRequest;
// use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{

    public function list(Request $request){
        if($request->name){
            $data=Location::where('name','like','%'.$request->name.'%')->paginate(10);
        }else{
            $data=Location::paginate(10);
        }
        return $data;
    }
    public function create(LocationRequest $request){
        $data=Location::create([
            'location_name'=>$request->name,
            'note'=>$request->note,
            'deparment_id'=>$request->deparment_id ,
        ]);
        return $data;
    }
    public function copy($id){
        $location= Location::find($id);
        $data=Location::create([
            'location_name'=>$location->name,
            'note'=>$location->note,
            'deparment_id'=>$location->deparment_id ,
        ]);
        return  $data;
    }
    public function edit(LocationRequest $request,$id){
        $data=Location::find($id)->update([
            'location_name'=>$request->name,
            'note'=>$request->note,
            'deparment_id'=>$request->deparment_id ,
        ]);
        return "Update thanh cong";
    }

    public function delete($id){
        $location= Location::find($id)->delete();
        return  $location;
    }

    public function import(ImportRequest $request) 
    {
        Excel::import(new LocationImport, $request->file);
        
        return'success';
    }
}
