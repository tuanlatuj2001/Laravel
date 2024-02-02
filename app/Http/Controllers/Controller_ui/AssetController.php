<?php

namespace App\Http\Controllers\Controller_ui;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssetRequest;
use App\Imports\AssetImport;
use App\Repository\IAssetRepository;
use Illuminate\Http\Request;
use App\Http\Requests\ImportsRequest;
use Maatwebsite\Excel\Facades\Excel;

class AssetController extends Controller
{
    public $asset;
    public function __construct(IAssetRepository $asset){
        $this->asset = $asset;
    }
    public function index(Request $request){
        if($request->keyword){
            $data=$this->asset->getAsset()->where('asset_name','like','%'.$request->keyword.'%')->paginate(10);
        }else{
            $data=$this->asset->getAsset()
            ->paginate(10);
        }

        return view("admin.asset.list",compact("data"));
    }

    public function qr(Request $request){
        if($request->keyword){
            $data=$this->asset->getAsset()->where('asset_name','like','%'.$request->keyword.'%')->paginate(10);
        }else{
            $data=$this->asset->getAsset()
            ->paginate(10);
        }
        return view("admin.asset.qr",compact("data"));
    }

    public function re_generate($id) 
    {
        $this -> asset->generate($id);
        return redirect('/admin/asset/qr');
    }

    public function create(){
        $catagorie=$this->asset->getCategorie();
        $location=$this->asset->getLocation();
        $manufacturer=$this->asset->getManufacturer();
        $supplier= $this->asset->getSupplier();
        $asset=$this->asset->getAsset();
        return view('admin.asset.add',compact('catagorie','asset','location','manufacturer','supplier'));
    }

    public function store(AssetRequest $request){
        $data= $request->all();
       $this->asset->createAsset($data);
        return redirect(url('admin/asset/list'));
    }

    public function edit($id){
        $asset= $this->asset->editAsset($id);
        $catagorie=$this->asset->getCategorie();
        $location=$this->asset->getLocation();
        $manufacturer=$this->asset->getManufacturer();
        $supplier= $this->asset->getSupplier();
        return view('admin.asset.edit',compact('asset','catagorie','location','manufacturer','supplier'));
    }

    public function update(AssetRequest $request, $id){
        $data= $request->all();
        $this->asset->updateAsset($id,$data);
        return redirect(url('admin/asset/list'));
    }

    public function import(ImportsRequest $request) 
    {
        Excel::import(new AssetImport, $request->file);
        
        return  redirect(url('admin/asset/list'));
    }

    public function print($id){
        $asset= $this->asset->findAsset($id);
        // dd($asset);
        return view('admin.asset.print',compact('asset'));
    }
    public function review(Request $request){
        $data= $request->all();
        // dd($data);
        if($data['layout']=='5x2'){
            return view('admin.asset.review5_2',compact('data'));
        }elseif($data['layout']=='7x3'){
            return view('admin.asset.review7_3',compact('data'));
        }else{
            return view('admin.asset.review8_3',compact('data'));
        }
    }
}
