<?php

namespace App\Http\Controllers\Api;

use App\Models\Cars;
use App\Http\Requests\CarsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // //show data on who's logged in
        //$cars = Cars::where('customerID', $request->user()->carID);
        
        // if($request->keyword){
        //     $cars->where(function ($query) use ($request){
        //         $query->where('manufacturer', 'like', '%' . $request->keyword . '%')
        //             ->orWhere('model', 'like', '%' . $request->keyword . '%')
        //             ->orWhere('price', 'like', '%' . $request->keyword . '%');
        //     }); 
                  
        // }

       // return $cars->paginate(2);
                    
       $cars = Cars::all();
       return $cars;
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
       $validated = $request -> validated();
       $cars = Cars::findOrFail($id);

       if(!is_null($cars->imageURL))
        {
            Storage::disk('public')->delete($cars->imageURL);
        }
        
    $cars->imageURL = $request->file('imageURL')->storePublicly('cars', 'public');

       $cars -> update($validated);


        return $cars;
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
