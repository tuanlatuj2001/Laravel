<?php

namespace App\Http\Controllers\Controller_ui;

use App\Repository\ILocationRepository;
use Illuminate\Http\Request;
use App\Imports\LocationImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\LocationsRequest;
use App\Http\Requests\ImportsRequest;

class LocationController extends Controller
{
    public $location;
    public function __construct(ILocationRepository $location){
        $this->location = $location;
    }
    public function list(Request $request){
        if($request->keyword){
            $data=$this->location->getLocation()
            ->where('location_name','like','%'.$request->keyword.'%')->paginate(10);
        }else{
            $data=$this->location->getLocation()->paginate(10);
        }
        return view('admin.location.list',compact('data'));
    }
    public function create(){
        $deparment=$this->location->getDeparment();
        return view('admin.location.create',compact('deparment'));
    }
    public function store(LocationsRequest $request){
        
        $data= $request->all();
        $this->location->createLocation($data);
        return redirect(url('admin/location/list'));
    }
    public function copy($id){
        $this->location->copyLocation($id);
        return redirect(url('admin/location/list'));
    }
    public function edit($id){
        $location=$this->location->editLocation($id);
        // dd($location);
        $data=$this->location->getDeparment();
        $deparment=$this->location->finddeparment($id);
        // dd($deparment);
        return view('admin.location.edit',compact('data','location','deparment'));
    }

    public function update(LocationsRequest $request,$id){
        $data=$request->all();
        $this->location->updateLocation($id,$data);
        return redirect(url('admin/location/list'));
    }
    public function delete($id){
        $this->location->deleteLocation($id);
        return  redirect(url('admin/location/list'));
    }

    public function import(ImportsRequest $request) 
    {
        Excel::import(new LocationImport, $request->file);
        
        return  redirect(url('admin/location/list'));
    }

}
