<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
         // Retrieve the validated input data...

         $validated = $request->validated();

         $validated['password'] = Hash::make($validated['password']);
 
         $user = User::create($validated);
 
         return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();
 
        $user->firstname = $validated['firstname'];
        $user->lastname = $validated['lastname'];
        $user->middlename = $validated['middlename'];


        $user->save();

        return $user;
    }

    /**
     * Update the email of specified resource in storage.
     */
    public function email(CustomerRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();
 
        $user->email = $validated['email'];
        
        $user->save();

        return $user;
    }

    /**
     * Update the phone nummber of the specified resource in storage.
     */
    public function phone_number(CustomerRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();
 
        $user->phone_number = $validated['phone_number'];

        $user->save();

        return $user;
    }

    /**
     * Update the address of the specified resource in storage.
     */
    public function address(CustomerRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();
 
        $user->address = $validated['address'];

        $user->save();

        return $user;
    }


    /**
     * Update the password of the specified resource in storage.
     */
    public function password(CustomerRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validated();
 
        $user->password = Hash::make($validated['password']);
        
        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = User::findOrFail($id);
        $branch->delete();
        return $branch;
    }

    /**
     * Update the image of the specified resource from storage.
     */
    public function image(CustomerRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        if(!is_null($user->image))
        {
            Storage::disk('public')->delete($user->image);
        }
        $user->image = $request->file('image')->storePublicly('images', 'public');
        
        $user->save();

        return $user;
    }

    public function specificImage(CustomerRequest $request)
    {
        
        $user = User::findOrFail($request->user()->id);

        if(!is_null($user->image))
        {
            Storage::disk('public')->delete($user->image);
        }
        $user->image = $request->file('image')->storePublicly('images', 'public');
        
        $user->save();

        return $user;
    }
}
