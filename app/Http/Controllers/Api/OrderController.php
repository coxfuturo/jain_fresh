<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

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
}