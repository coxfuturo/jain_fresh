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

        $images = [];

        // MULTIPLE IMAGE UPLOAD
        if ($request->hasFile('image')) {

            foreach ($request->file('image') as $file) {

                $imageName = time() . rand(1,1000) . '.' . $file->extension();

                $file->move(public_path('uploads/products'), $imageName);

                $images[] = $imageName;
            }
        }

        $product = Product::create([

            'name' => $request->name,

            'image' => $images,

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

        if (!$product) {

            return response()->json([

                'status' => false,

                'message' => 'Product Not Found'

            ]);
        }

        return response()->json([

            'status' => true,

            'data' => $product

        ]);
    }

    // UPDATE PRODUCT
    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        if (!$product) {

            return response()->json([

                'status' => false,

                'message' => 'Product Not Found'

            ]);
        }

        // MULTIPLE IMAGE UPDATE
        if ($request->hasFile('image')) {

            // DELETE OLD IMAGES
            if (!empty($product->image)) {

                foreach ($product->image as $oldImage) {

                    $oldPath = public_path('uploads/products/' . $oldImage);

                    if (file_exists($oldPath)) {

                        unlink($oldPath);
                    }
                }
            }

            $images = [];

            foreach ($request->file('image') as $file) {

                $imageName = time() . rand(1,1000) . '.' . $file->extension();

                $file->move(public_path('uploads/products'), $imageName);

                $images[] = $imageName;
            }

            $product->image = $images;
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

            'message' => 'Product Updated',

            'data' => $product

        ]);
    }

    // DELETE PRODUCT
    public function destroy($id)
    {

        $product = Product::find($id);

        if (!$product) {

            return response()->json([

                'status' => false,

                'message' => 'Product Not Found'

            ]);
        }

        // DELETE MULTIPLE IMAGES
        if (!empty($product->image)) {

            foreach ($product->image as $image) {

                $path = public_path('uploads/products/' . $image);

                if (file_exists($path)) {

                    unlink($path);
                }
            }
        }

        $product->delete();

        return response()->json([

            'status' => true,

            'message' => 'Product Deleted'

        ]);
    }

    // SIMILAR PRODUCTS
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

    // WEIGHT & PRICE ARRAY
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
