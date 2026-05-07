<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //View

        return Banner::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Store in db

        $image = '';

        if ($request->hasFile('image')) {
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/banner'), $image);
        }

        $banner = Banner::create([
            'name' => $request->name,
            'title' => $request->title,
            'image' => $image,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Banner Created',
            'data' => $banner
        ]);
    }

    // Showing the banner
    public function show($id)
    {
        return Banner::find($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //For Update
        $banner = Banner::find($id);

        if ($request->hasFile('image')) {
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/banner'), $image);
            $banner->image = $image;
        }

        $banner->name = $request->name;
        $banner->title = $request->title;
        $banner->status = $request->status;

        $banner->save();

        return response()->json([
            'status' => true,
            'message' => 'Banner Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //remove data
        
        Banner::destroy($id);

        return response()->json([
            'status' => true,
            'message' => 'Banner Deleted'
        ]);
    }
}
