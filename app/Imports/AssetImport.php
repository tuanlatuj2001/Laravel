<?php

namespace App\Imports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\ToModel;

class AssetImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Asset([
            'code' => $row[0],
            'asset_name' => $row[1],
            'location_id' => $row[2],
            'condition' => $row[3],
            'modele_id' => $row[4],
            'serial' => $row[5],
            'supplier_id' => $row[6],
            'manufacturer_id' => $row[7],
            'categorie_id' => $row[8],
            'price' => $row[9],
            'warranty' => $row[10],
            'asset_code' => $row[11],
            'note' => $row[12],
        ]);
    }
}
