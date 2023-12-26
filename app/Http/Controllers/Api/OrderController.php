<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
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
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, string $id)
    {
        $validated = $request->validated();
       $order = Order::findOrFail($id);

       $order->quantity = $validated['quantity'];
       $order->payment_method = $validated['payment_method'];

       $order->save();
       return $order;
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return $order;
    }
}
