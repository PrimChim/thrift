<?php

namespace App\Http\Controllers;

use App\Models\Products;

class DashboardController extends Controller
{
    public function index()
    {   
        $totalProducts = Products::count();
        $outOfStockProducts = Products::where('quantity', 0)->count();

        return view('dashboard', compact('totalProducts', 'outOfStockProducts'));
    }
}
