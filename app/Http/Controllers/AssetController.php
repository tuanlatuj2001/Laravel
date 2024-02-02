<?php

namespace App\Http\Controllers;

use App\Models\Deparment;
use App\Models\Location;
use App\Models\Manufacturer;
use App\Models\Modele;
use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\AssetResource;
use App\Imports\AssetImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ImportRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Http\Requests\CreateAssetRequest;

class AssetController extends Controller
{
    public function list(Request $request)
    {
        if ($request->name) {
            $data = Asset::where('name', 'like', '%' . $request->name . '%')->paginate(10);
        } else {
            $data = Asset::
                join('suppliers', 'assets.supplier_id', '=', 'suppliers.id')
                ->join('modeles', 'assets.modele_id', '=', 'modeles.id')
                ->join('locations', 'assets.location_id', '=', 'locations.id')
                ->join('deparments', 'locations.deparment_id', '=', 'deparments.id')
                ->select('assets.*', 'suppliers.supplier_name', 'modeles.modele_name', 'locations.location_name', 'deparments.deparment_name')
                ->paginate(10);
        }

        return $data;

    }

    public function create(CreateAssetRequest $request)
    {

        $data = Asset::create([
            'asset_name' => $request->asset_name,
            'code' => $request->code,
            'location_id' => $request->location_id,
            'condition' => $request->condition,
            'modele_id' => $request->modele_id,
            'serial' => $request->serial,
            'supplier_id' => $request->supplier_id,
            'manufacturer_id' => $request->manufacturer_id,
            'categorie_id' => $request->categorie_id,
            'price' => $request->price,
            'warranty' => $request->warranty,
            'asset_code' => $request->asset_code,
        ]);
        $asset = DB::table('assets')->latest('created_at')->first();
        return new AssetResource($asset);
    }
    public function update(CreateAssetRequest $request, $id)
    {

        $data = Asset::find($id)->update([
            'asset_name' => $request->asset_name,
            'code' => $request->code,
            'location_id' => $request->location_id,
            'condition' => $request->condition,
            'modele_id' => $request->modele_id,
            'serial' => $request->serial,
            'supplier_id' => $request->supplier_id,
            'manufacturer_id' => $request->manufacturer_id,
            'categorie_id' => $request->categorie_id,
            'price' => $request->price,
            'warranty' => $request->warranty,
            'asset_code' => $request->asset_code,
        ]);
        $asset = Asset::where('id', $id)->first();
        return new AssetResource($asset);

    }
    public function delete($id)
    {
        $asset = Asset::find($id)->first()->delete();

        return "Success";
    }

    public function import(ImportRequest $request)
    {
        Excel::import(new AssetImport, $request->file);

        return 'success';
    }

    public function generate()
    {
        $qr = Asset::all();
        $code = $qr->toArray();
        foreach ($code as $k) {
            $qrCodes = QrCode::size(120)->generate($k['asset_code']);
        }
        return $qrCodes;

    }

    public function re_generate($id)
    {
        $asset = Asset::find($id)->update([
            'asset_code' => random_int(10000000000, 99999999999)
        ]);
        // $qr=Asset::find($id)->first();
        // $qrCodes= QrCode::size(120)->generate($qr->asset_code);

        return $asset;
    }

    public function getModels($manufacturer)
    {
        $models = Modele::where('manufacturer_id', $manufacturer)->get();
        return $models;
    }
    public function getDeparment($deparment)
    {
        $id = Location::find($deparment);
        $models = Deparment::where('id', $id->deparment_id)->get();
        return $models;
    }
}
