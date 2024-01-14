<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderDetailsRequest;
use App\Models\OrderDetails;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderDetails::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderDetailsRequest $request)
    {
        // Retrieve the validated input data...

        $validated = $request->validated();

        $order_details = OrderDetails::create($validated);

        return $order_details;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return OrderDetails::findOrFail($id);
    }
}
