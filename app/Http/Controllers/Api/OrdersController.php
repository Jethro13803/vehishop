<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        // Retrieve the validated input data...

        $validated = $request->validated();

        $order = Order::create($validated);

        return $order;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Order::findOrFail($id);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, string $id)
    {
        $user = Order::findOrFail($id);

        $validated = $request->validated();
 
        $user->status = $validated['status'];
        $user->quantity = $validated['quantity'];
        $user->payment_method = $validated['payment_method'];


        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Order::findOrFail($id);
        $user->delete();
        return $user;
    }
}
