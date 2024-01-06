<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function image(CustomerRequest $request)
    {
        $user = User::findOrFail($request->user()->customerID);

        if(!is_null($user->image))
        {
            Storage::disk('public')->delete($user->image);
        }
        $user->image = $request->file('image')->storePublicly('images', 'public');
        
        $user->save();

        return $user;
    }

    /**
     * Display the specified info about the token bearer.
     */
    public function show(Request $request)
    {
        return User::findOrFail($request->user()->customerID);
    }
}
