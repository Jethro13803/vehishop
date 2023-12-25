<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Branch::all();
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(BranchRequest $request)
    {
        // Retrieve the validated input data...

        $validated = $request->validated();

        $carouselItems = Branch::create($validated);

        return $carouselItems;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Branch::findOrFail($id);
    }

}
