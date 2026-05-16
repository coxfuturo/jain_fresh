<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');
        $query = Order::query();

        if ($filter == 'month') {
            $query->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year);
        }

        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_banners' => Banner::count(),
            'total_users' => User::count(),
            'total_coupons' => Coupon::count(),
            'total_orders' => $query->count(),
            'total_revenue' => $query->sum('total_amount'),
            'pending_orders_count' => Order::where('order_status', 'Pending')->count(),
        ];

        $recent_products = Product::with('category')->latest()->take(5)->get();
        $recent_orders = (clone $query)->with('user')->latest()->take(5)->get();
        $pending_notifications = Order::with('user')->where('order_status', 'Pending')->latest()->take(5)->get();

        // Dynamic Revenue Chart Data
        $monthly_revenue = Order::select(
            DB::raw('SUM(total_amount) as total'),
            DB::raw('MONTH(created_at) as month')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('total', 'month')
        ->toArray();

        $chart_data = [];
        for ($i = 1; $i <= 12; $i++) {
            $chart_data[] = (float)($monthly_revenue[$i] ?? 0);
        }

        $revenue_data = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'data' => $chart_data
        ];

        return view('admin.dashboard.dashboard', compact('stats', 'recent_products', 'recent_orders', 'revenue_data', 'filter', 'pending_notifications'));
    }
}
