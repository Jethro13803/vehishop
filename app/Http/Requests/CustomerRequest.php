<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        if(request()->routeIs('user.login'))
        {
            return [
                'email'                  => 'required|string|email|max:255',
                'password'               => 'required|min:8',
            ];
        }
        else if(request()->routeIs('user.store'))
        {
            return [
                'lastname'               => 'required|string|max:255',
                'firstname'              => 'required|string|max:255',
                'middlename'             => 'string|max:255',
                'email'                  => 'required|string|email|unique:App\Models\User,email|max:255',
                'phone_number'           => 'required|digits_between:11,12',
                'address'                => 'required|string|max:255',
                'password'               => 'required|min:8',
            ];
        }
        else if(request()->routeIs('user.update'))
        {
            return [
                'lastname'               => 'required|string|max:255',
                'firstname'              => 'required|string|max:255',
                'middlename'             => 'string|max:255',
            ];
        }
        else if(request()->routeIs('user.email'))
        {
            return [
                'email'                  => 'required|string|email|max:255',
            ];
        }
        else if(request()->routeIs('user.phone'))
        {
            return [
                'phone_number'           => 'required|digits_between:11,12',            
            ];
        }
        else if(request()->routeIs('user.address'))
        {
            return [
                'address'                => 'required|string|max:255',
            ];
        }
        else if(request()->routeIs('user.password'))
        {
            return 
            [
                'password'               => 'required|confirmed|min:8',
            ];
        }
        else if(request()->routeIs('user.image') || request()->routeIs('profile.image'))
        {
            return 
            [
                'image'                  => 'required|image|mimes:jpg,bmp,png|max:5000',
            ];
        }
        
        
    
    }
}
