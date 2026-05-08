<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    // ALL PRODUCTS
    public function index()
    {
        $products = Product::with('category')->latest()->get();

        return response()->json([
            'status' => true,
            'data' => $products
        ]);
    }

    // CREATE PRODUCT
    public function store(Request $request)
    {

        $image = '';

        if ($request->hasFile('image')) {

            $image = time().'.'.$request->image->extension();

            $request->image->move(
                public_path('uploads/products'),
                $image
            );
        }

        $product = Product::create([

            'productId' => $request->productId,

            'name' => $request->name,

            'image' => $image,

            'weight' => $request->weight,

            'category_id' => $request->category_id,

            'delivery_time' => $request->delivery_time,

            'shelf_life' => $request->shelf_life,

            'stock_status' => $request->stock_status,

            'nutrition' => $request->nutrition,

            'storage_tips' => $request->storage_tips,

            'status' => $request->status

        ]);

        return response()->json([
            'status' => true,
            'message' => 'Product Created',
            'data' => $product
        ]);
    }

    // SINGLE PRODUCT
    public function show($id)
    {
        $product = Product::with('category')->find($id);

        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }

    // UPDATE PRODUCT
    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        if ($request->hasFile('image')) {

            $image = time().'.'.$request->image->extension();

            $request->image->move(
                public_path('uploads/products'),
                $image
            );

            $product->image = $image;
        }

        $product->productId = $request->productId;
        $product->name = $request->name;
        $product->weight = $request->weight;

        $product->category_id = $request->category_id;

        $product->delivery_time = $request->delivery_time;

        $product->shelf_life = $request->shelf_life;

        $product->stock_status = $request->stock_status;

        $product->nutrition = $request->nutrition;

        $product->storage_tips = $request->storage_tips;

        $product->status = $request->status;

        $product->save();

        return response()->json([
            'status' => true,
            'message' => 'Product Updated'
        ]);
    }

    // DELETE PRODUCT
    public function destroy($id)
    {
        Product::destroy($id);

        return response()->json([
            'status' => true,
            'message' => 'Product Deleted'
        ]);
    }
}