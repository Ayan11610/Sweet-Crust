<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Staff dashboard dikhana
    public function staffDashboard()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'Pending')->count();
        $totalProducts = Product::count();
        $lowStockProducts = Product::lowStock()->count();
        $totalCustomers = Customer::count();
        $lowStockIngredients = Ingredient::lowStock()->count();
        
        // Combined low stock items
        $lowStockItems = $lowStockProducts + $lowStockIngredients;
        
        $recentOrders = Order::with('customer')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('staff.dashboard', compact(
            'totalOrders', 'pendingOrders', 'totalProducts',
            'lowStockProducts', 'totalCustomers', 'lowStockIngredients',
            'lowStockItems', 'recentOrders'
        ));
    }

    // Customer dashboard dikhana
    public function customerDashboard()
    {
        $customer = auth('customer')->user();
        
        $totalOrders = Order::where('customerId', $customer->id)->count();
        $pendingOrders = Order::where('customerId', $customer->id)
            ->where('status', 'Pending')
            ->count();
        $completedOrders = Order::where('customerId', $customer->id)
            ->where('status', 'Completed')
            ->count();
        
        $recentOrders = Order::where('customerId', $customer->id)
            ->with('orderItems.product')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('customer.dashboard', compact(
            'totalOrders', 'pendingOrders', 'completedOrders', 'recentOrders'
        ));
    }

    // Customer orders list dikhana
    public function customerOrders()
    {
        $customer = auth('customer')->user();
        $orders = Order::where('customerId', $customer->id)
            ->with('orderItems.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('customer.orders', compact('orders'));
    }
}
