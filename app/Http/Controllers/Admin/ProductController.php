<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'productId' => 'nullable|string|max:255',
            'delivery_time' => 'nullable|string',
            'shelf_life' => 'nullable|string',
            'stock_status' => 'nullable|string',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->weight = $request->weight;
        $product->category_id = $request->category_id;
        $product->productId = $request->productId;
        $product->delivery_time = $request->delivery_time;
        $product->shelf_life = $request->shelf_life;
        $product->stock_status = $request->stock_status;
        $product->nutrition = $request->nutrition;
        $product->storage_tips = $request->storage_tips;

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'weight' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->name = $request->name;
        $product->weight = $request->weight;
        $product->category_id = $request->category_id;
        $product->productId = $request->productId;
        $product->delivery_time = $request->delivery_time;
        $product->shelf_life = $request->shelf_life;
        $product->stock_status = $request->stock_status;
        $product->status = $request->status;
        $product->nutrition = $request->nutrition;
        $product->storage_tips = $request->storage_tips;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
