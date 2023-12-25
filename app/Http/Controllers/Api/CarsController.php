<?php

namespace App\Http\Controllers\Api;

use App\Models\Cars;
use App\Http\Requests\CarsRequest;
use App\Http\Controllers\Controller;
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
        $validated = $request->validated();
        
       $carouselItem = Cars::findOrFail($id);
       $carouselItem->update($validated);

        return $carouselItem;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cars = Cars::findOrFail($id);
        $cars->delete();
        return $cars;
    }
}
