<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateAssetRequest extends FormRequest
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
            'code'=>'required',
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
    public function failedValidation(Validator $validator)

    {

        throw new HttpResponseException(response()->json([

            'success'   => false,

            'message'   => 'Validation errors',

            'data'      => $validator->errors()

        ]));

    }
    public function messages()

    {

        return [

            'asset_name.required' => 'name is required',
            'code.required' => 'code is required',
            'location_id.required' => 'location_id is required',
            'condition.required' => 'condition is required',
            'modele_id.required' => 'modele_id is required',
            'serial.required' => 'serial is required',
            'supplier_id.required' => 'supplier_id is required',
            'manufacturer_id.required' => 'manufacturer_id is required',
            'categorie_id.required' => 'categorie_id is required',
            'price.required' => 'price is required',
            'warranty.required' => 'warranty is required'

        ];

    }

  
}
