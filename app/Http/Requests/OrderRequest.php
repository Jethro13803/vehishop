<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ServerStatus;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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

        if(request()->routeIs('order.store'))
        {
            return [
                // 'date'              => 'date_format:Y-m-d',
                'status'            => 'required|string',
                'quantity'          => 'required|numeric',
                'payment_method'    => 'required|string|max:255',
                'customerID'        => 'required|integer',
                'carID'             => 'required|integer',
            ];
        }
        else if(request()->routeIs('order.update'))
        {
            return [
                'quantity'          => 'required|numeric',
                'payment_method'    => 'required|string|max:255',
            ];
        }
        
    }
}
