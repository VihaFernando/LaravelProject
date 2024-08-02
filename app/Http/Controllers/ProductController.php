<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of the products.
    public function index()
    {
        $products = Product::with('category')->get(); // Eager load category
        return view('products.index', compact('products'));
    }

    // Show the form for creating a new product.
    public function create()
    {
        $categories = Category::all(); // Retrieve all categories
        return view('products.create', compact('categories'));
    }

    // Store a newly created product in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id' // Validate category_id
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show the form for editing the specified product.
    public function edit(Product $product)
    {
        $categories = Category::all(); // Retrieve all categories
        return view('products.edit', compact('product', 'categories'));
    }

    // Update the specified product in storage.
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id' // Validate category_id
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Remove the specified product from storage.
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
