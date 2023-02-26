<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        $categoriesCount = Category::count();
        $productsCount = Product::count();
        $ordersCount = Order::count();
        $latestUsers = User::orderByDesc('id')->take(10)->get();
        $latestOrders = Order::orderByDesc('id')->take(10)->get();

        return view('dashboard.index',compact('usersCount','categoriesCount','productsCount','ordersCount','latestUsers','latestOrders'));
    }
}
