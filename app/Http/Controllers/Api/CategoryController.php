<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::latest()->get();
    }

    public function store(Request $request)
    {
        $image = '';

        if ($request->hasFile('image')) {
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/category'), $image);
        }

        $category = Category::create([
            'name' => $request->name,
            'image' => $image,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Category Created',
            'data' => $category
        ]);
    }

    public function show($id)
    {
        return Category::find($id);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if ($request->hasFile('image')) {
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/category'), $image);
            $category->image = $image;
        }

        $category->name = $request->name;
        $category->status = $request->status;

        $category->save();

        return response()->json([
            'status' => true,
            'message' => 'Category Updated'
        ]);
    }

    public function destroy($id)
    {
        Category::destroy($id);

        return response()->json([
            'status' => true,
            'message' => 'Category Deleted'
        ]);
    }
}