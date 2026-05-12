<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{

    // MY ORDERS
    public function myOrders()
    {

        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return response()->json([

            'status' => true,

            'data' => $orders
        ]);
    }


    // ORDER DETAILS
    public function orderDetails($id)
    {

        $order = Order::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$order) {

            return response()->json([

                'status' => false,

                'message' => 'Order Not Found'
            ]);
        }

        return response()->json([

            'status' => true,

            'data' => $order
        ]);
    }

    public function placeOrder(Request $request)
    {

        $subtotal = 0;

        foreach ($request->products as $item) {

            $subtotal += $item['price'] * $item['qty'];
        }

        $discount = $request->discount_amount ?? 0;

        $finalAmount = $subtotal - $discount;

        $order = Order::create([

            'user_id' => auth()->id(),

            'address_id' => $request->address_id,

            'subtotal' => $subtotal,

            'discount_amount' => $discount,

            'total_amount' => $finalAmount,

            'payment_method' => $request->payment_method,

            'payment_status' => 'Pending',

            'order_status' => 'Pending'
        ]);

        foreach ($request->products as $item) {

            OrderItem::create([

                'order_id' => $order->id,

                'product_id' => $item['product_id'],

                'qty' => $item['qty'],

                'price' => $item['price'],

                'total' => $item['price'] * $item['qty']
            ]);
        }

        return response()->json([

            'status' => true,

            'message' => 'Order Placed Successfully',

            'order_id' => $order->id,

            'total_amount' => $finalAmount
        ]);
    }
}