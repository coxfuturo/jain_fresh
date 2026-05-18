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

            'weight' => 'required|array',
            'weight.*' => 'required|string|max:255',

            'price' => 'required|array',
            'price.*' => 'required',

            'category_id' => 'required|exists:categories,id',

            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $weights = [];

        foreach ($request->weight as $key => $weight) {

            $weights[] = [
                'weight' => $weight,
                'price' => $request->price[$key]
            ];
        }

        // Multiple Images
        $images = [];

        if ($request->hasFile('image')) {

            foreach ($request->file('image') as $file) {

                $images[] = $file->store('products', 'public');
            }
        }

        $product = new Product();

        $product->name = $request->name;
        $product->weight = $weights;
        $product->image = $images;

        $product->category_id = $request->category_id;
        $product->delivery_time = $request->delivery_time;
        $product->shelf_life = $request->shelf_life;
        $product->stock_status = $request->stock_status;
        $product->nutrition = $request->nutrition;
        $product->storage_tips = $request->storage_tips;

        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
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

            'weight' => 'required|array',
            'weight.*' => 'required|string|max:255',

            'price' => 'required|array',
            'price.*' => 'required',

            'category_id' => 'required|exists:categories,id',

            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Weight + Price
        $weights = [];

        foreach ($request->weight as $key => $weight) {

            $weights[] = [
                'weight' => $weight,
                'price' => $request->price[$key]
            ];
        }

        $product->name = $request->name;
        $product->weight = $weights;

        $product->category_id = $request->category_id;
        $product->productId = $request->productId;
        $product->delivery_time = $request->delivery_time;
        $product->shelf_life = $request->shelf_life;
        $product->stock_status = $request->stock_status;
        $product->status = $request->status;
        $product->nutrition = $request->nutrition;
        $product->storage_tips = $request->storage_tips;

        // Multiple Images
        if ($request->hasFile('image')) {

            // old images delete
            if ($product->image && is_array($product->image)) {

                foreach ($product->image as $img) {

                    Storage::disk('public')->delete($img);
                }
            }

            $images = [];

            foreach ($request->file('image') as $file) {

                $images[] = $file->store('products', 'public');
            }

            $product->image = $images;
        }

        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
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
