<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'code'=>$this->code,
            'asset_name'=>$this->asset_name,
            'location_id'=>$this->location_id ,
            'condition'=>$this->condition,
            'modele_id'=>$this->modele_id ,
            'serial'=>$this->serial,
            'supplier_id'=>$this->supplier_id ,
            'manufacturer_id'=>$this->manufacturer_id  ,
            'categorie_id'=>$this->categorie_id  ,
            'price'=>$this->price ,
            'warranty'=>$this->warranty ,
            'created_at'=>$this->warranty ,
            'updated_at'=>$this->warranty ,
            'deleted_at'=>$this->deleted_at ,
        ];
    }
}
