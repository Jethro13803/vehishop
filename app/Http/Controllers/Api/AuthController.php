<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login using the specified resource.
     */
    public function login(CustomerRequest $request)
    {
        $user = User::where('email', $request->email)->first();
     
        if (! $user) {
            throw ValidationException::withMessages([
                'email' => ['The provided emaail is incorrect.'],
            ]);
        }
        else if(! Hash::check($request->password, $user->password))
        {
            throw ValidationException::withMessages([
                'password' => ['The entered password is incorrect.'],
            ]);
        }

        $response = [
                'user'      => $user,
                'token'     => $user->createToken($request->email)->plainTextToken
        ];
     
        return $response;
    }

    /**
     * Logout using the specified resource.
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $response = [
            'message' => 'You have been Logout.'
        ];
        return $response;
    }

}
