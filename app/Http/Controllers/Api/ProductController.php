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

            $image = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('uploads/products'),
                $image
            );
        }

        $product = Product::create([

            'name' => $request->name,

            'image' => $image,

            'weight' => $this->parseWeightPrice($request->weight),

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

            $image = time() . '.' . $request->image->extension();

            $request->image->move(
                public_path('uploads/products'),
                $image
            );

            $product->image = $image;
        }

        $product->productId = $request->productId;
        $product->name = $request->name;
        $product->weight = $this->parseWeightPrice($request->weight);

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

    // similar product
    public function similarProducts($id)
    {

        $product = Product::find($id);

        if (!$product) {

            return response()->json([

                'status' => false,

                'message' => 'Product Not Found'
            ]);
        }

        $similarProducts = Product::where('category_id', $product->category_id)

            ->where('id', '!=', $id)

            ->latest()

            ->take(10)

            ->get();

        return response()->json([
            'status' => true,
            'data' => $similarProducts
        ]);
    }

    private function parseWeightPrice($weightString)
    {
        if (empty($weightString)) {
            return [];
        }

        if (is_array($weightString)) {
            return $weightString;
        }

        $pairs = explode(',', $weightString);
        $result = [];

        foreach ($pairs as $pair) {
            $parts = explode('/', $pair);
            if (count($parts) == 2) {
                $result[] = [
                    'weight' => trim($parts[0]),
                    'price' => trim($parts[1])
                ];
            }
        }

        return $result;
    }
}