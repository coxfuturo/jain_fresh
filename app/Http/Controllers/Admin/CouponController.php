<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:coupons',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->title = $request->title;
        $coupon->description = $request->description;
        $coupon->amount = $request->amount;
        $coupon->save();

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:coupons,name,'.$coupon->id,
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ]);

        $coupon->name = $request->name;
        $coupon->title = $request->title;
        $coupon->description = $request->description;
        $coupon->amount = $request->amount;
        $coupon->status = $request->status;
        $coupon->save();

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }
}
