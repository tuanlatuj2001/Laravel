<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'asset_name'=>'required',
            'location_id'=>'required',
            'condition'=>'required',
            'modele_id'=>'required',
            'serial'=>'required',
            'supplier_id'=>'required',
            'manufacturer_id'=>'required',
            'categorie_id'=>'required',
            'price'=>'required',
            'warranty'=>'required',
        ];
    }
}
