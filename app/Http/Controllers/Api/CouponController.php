<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{

    // ALL COUPONS
    public function index()
    {
        $coupons = Coupon::latest()->get();

        return response()->json([
            'status' => true,
            'data' => $coupons
        ]);
    }

    // CREATE COUPON
    public function store(Request $request)
    {

        $coupon = Coupon::create([

            'name' => $request->name,

            'title' => $request->title,

            'description' => $request->description,

            'amount' => $request->amount,

            'status' => $request->status
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Coupon Created',
            'data' => $coupon
        ]);
    }

    // SINGLE COUPON
    public function show($id)
    {
        $coupon = Coupon::find($id);

        return response()->json([
            'status' => true,
            'data' => $coupon
        ]);
    }

    // UPDATE COUPON
    public function update(Request $request, $id)
    {

        $coupon = Coupon::find($id);

        $coupon->name = $request->name;

        $coupon->title = $request->title;

        $coupon->description = $request->description;

        $coupon->amount = $request->amount;

        $coupon->status = $request->status;

        $coupon->save();

        return response()->json([
            'status' => true,
            'message' => 'Coupon Updated'
        ]);
    }

    // DELETE COUPON
    public function destroy($id)
    {

        Coupon::destroy($id);

        return response()->json([
            'status' => true,
            'message' => 'Coupon Deleted'
        ]);
    }


    // APPLY COUPON
    public function applyCoupon(Request $request)
    {

        $coupon = Coupon::where('name', $request->coupon_name)
                    ->where('status', 1)
                    ->first();

        if (!$coupon) {

            return response()->json([
                'status' => false,
                'message' => 'Invalid Coupon'
            ]);
        }

        $totalAmount = $request->total_amount;

        $discount = $coupon->amount;

        $finalAmount = $totalAmount - $discount;

        if ($finalAmount < 0) {
            $finalAmount = 0;
        }

        return response()->json([

            'status' => true,

            'message' => 'Coupon Applied',

            'total_amount' => $totalAmount,

            'discount_amount' => $discount,

            'final_amount' => $finalAmount
        ]);
    }
}