<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();

        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentProducts = Product::latest()->take(5)->get();

        return view('teacher.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalCategories',
            'totalUsers',
            'recentOrders',
            'recentProducts'
        ));
    }
}
