<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Category Distribution (Pie Chart)
        $categoryDistribution = Category::withCount('products')->get()->map(function($cat) {
            return [
                'name' => $cat->name,
                'count' => $cat->products_count
            ];
        });

        // User Registrations by Month (Bar Chart)
        $userRegistrations = User::select(
            DB::raw('COUNT(*) as count'), 
            DB::raw("DATE_FORMAT(created_at, '%M') as month"),
            DB::raw("MIN(created_at) as sort_date")
        )
        ->groupBy('month')
        ->orderBy('sort_date')
        ->get();

        // Top Categories by Product Count
        $topCategories = Category::withCount('products')->orderBy('products_count', 'desc')->take(5)->get();

        // General Stats
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_users' => User::count(),
            'total_coupons' => Coupon::count(),
        ];

        return view('admin.analytics.index', compact('categoryDistribution', 'userRegistrations', 'topCategories', 'stats'));
    }
}
