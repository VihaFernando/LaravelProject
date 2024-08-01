<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('addproducts'); // Form to add a new product
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'nullable|string',
            ]);

            Product::create($validated);

            return redirect()->route('products.index')->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
            // Handle exception
            return redirect()->back()->withErrors(['error' => 'Failed to add product.']);
        }
    }

    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::all();
        return view('productslist', compact('products')); // List of products
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return view('updateproducts', compact('product')); // Form to edit a product
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'nullable|string',
            ]);

            $product->update($validated);

            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            // Handle exception
            return redirect()->back()->withErrors(['error' => 'Failed to update product.']);
        }
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            // Handle exception
            return redirect()->back()->withErrors(['error' => 'Failed to delete product.']);
        }
    }
}
