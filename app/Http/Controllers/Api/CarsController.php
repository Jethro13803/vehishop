<?php

namespace App\Http\Controllers\Api;

use App\Models\Cars;
use App\Http\Requests\CarsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cars::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarsRequest $request)
    {
        // Retrieve the validated input data...

        $validated = $request->validated();

        $validated['imageURL'] = $request->file('imageURL')->storePublicly('cars', 'public');
        

        $cars = Cars::create($validated);


        return $cars;



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Cars::findOrFail($id);
    }

  /**
     * Update the specified resource in storage.
     */
    public function update(CarsRequest $request, string $id)
    {
        $user = Cars::findOrFail($id);

        $validated = $request->validated();
 
        $user->manufacturer = $validated['manufacturer'];
        $user->model = $validated['model'];
        $user->price = $validated['price'];
        $user->vin = $validated['vin'];
        $user->description = $validated['description'];
        
        $user->save();

        return $user;
    }

    public function image(CarsRequest $request, string $id)
    {
        $cars = Cars::findOrFail($id);

        if(!is_null($cars->imageURL))
        {
            Storage::disk('public')->delete($cars->imageURL);
        }
        
        $cars->imageURL = $request->file('imageURL')->storePublicly('cars', 'public');
        
        $cars->save();

        return $cars;
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cars = Cars::findOrFail($id);

        if(!is_null($cars->imageURL))
        {
            Storage::disk('public')->delete($cars->imageURL);
        }

        $cars->delete();
        return $cars;
    }
}
