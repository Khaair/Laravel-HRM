<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;



class ProductController extends Controller
{
    public function create()
    {
        return view('products.create'); // Create form view
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'productImage' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validation for image file
        ]);

        $productImage = $request->file('productImage');
        $imagePath = $productImage->store('product_images', 'public'); // Store image in 'public/storage/product_images'

        Product::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'productImage' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products')); // Show all products
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product')); // Show a single product
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product')); // Edit form view
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'productImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Image optional
        ]);

        if ($request->hasFile('productImage')) {
            $productImage = $request->file('productImage');
            $imagePath = $productImage->store('product_images', 'public');
            $product->update(['productImage' => $imagePath]);
        }

        $product->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}