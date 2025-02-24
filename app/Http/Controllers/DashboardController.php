<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {   
        $totalProducts = Products::count();
        $outOfStockProducts = Products::where('quantity', 0)->count();

        // Get start of the week and month
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();

        // Calculate revenue from delivered orders
        $weeklyRevenue = Order::where('status', 'delivered')
                            ->where('created_at', '>=', $startOfWeek)
                            ->sum('total_price');

        $monthlyRevenue = Order::where('status', 'delivered')
                             ->where('created_at', '>=', $startOfMonth)
                             ->sum('total_price');

        return view('dashboard', compact('totalProducts', 'outOfStockProducts', 'weeklyRevenue', 'monthlyRevenue'));
    }
}
