<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarsRequest extends FormRequest
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
        if(request()->routeIs('cars.store'))
        {
            return [
                'manufacturer'      => 'required|string|max:255',
                'model'             => 'required|string|max:255',
                'price'             => 'required|numeric',
                'vin'               => 'required|string|max:17|min:17',
                'imageURL'          => 'required|image|unique:App\Models\Cars,imageURL|mimes:jpg,gif,png,bmp|max:2048',
                'description'       => 'required|string|max:255',
                'branch_id'         => 'required|integer',
            ];
        }

        else if(request()->routeIs('cars.update'))
        {
            return [
                'manufacturer' => 'required|string|max:255',
                'model'    => 'required|string|max:255',
                'price'   => 'required|numeric',
                'vin'       => 'required|string|max:17|min:17',
                'description'   => 'required|string|max:255',

            ];
        }

        else if(request()->routeIs('cars.image'))
        {
            return [
                'imageURL'       => 'required|image|mimes:jpg,gif,png|max:2048',
            ];
        }
       
    }
}
