<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_banners' => Banner::count(),
            'total_users' => User::count(),
            'total_coupons' => Coupon::count(),
        ];

        $recent_products = Product::with('category')->latest()->take(5)->get();

        $revenue_data = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'data' => [4500, 5200, 4800, 6100, 7500, 8200, 7800, 9500, 10500, 11000, 12500, 14000]
        ];

        return view('admin.dashboard.dashboard', compact('stats', 'recent_products', 'revenue_data'));
    }
}
