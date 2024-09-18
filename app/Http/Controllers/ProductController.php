<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Producto::all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
        ]);

        $product = Producto::create($request->only(['name', 'price', 'quantity']));

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Producto::findOrFail($id);
        return response()->json($product, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Producto::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'quantity' => 'sometimes|required|integer|min:0',
        ]);

        $product->update($request->all());

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Producto::findOrFail($id);
        $product->delete();

        return response()->json(null, 204);
    }
    public function increaseStock(Request $request, $id)
    {
        $product = Producto::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product->increment('quantity', $request->quantity);

        return response()->json($product, 200);
    }

    // Salida de productos
    public function decreaseStock(Request $request, $id)
    {
        $product = Producto::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($product->quantity < $request->quantity) {
            return response()->json(['message' => 'Cantidad insuficiente'], 400);
        }

        $product->decrement('quantity', $request->quantity);

        return response()->json($product, 200);
    }
}
