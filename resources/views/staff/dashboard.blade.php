<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - Sweet Crust</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    {{-- Navigation --}}
    <nav>
        <div class="container">
            <div class="logo"><i class="fas fa-birthday-cake"></i> Sweet Crust Admin</div>
            <ul>
                <li><a href="{{ route('staff.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('products.index') }}"><i class="fas fa-cookie"></i> Products</a></li>
                <li><a href="{{ route('orders.index') }}"><i class="fas fa-shopping-bag"></i> Orders</a></li>
                <li><a href="{{ route('ingredients.index') }}"><i class="fas fa-box"></i> Inventory</a></li>
                <li>
                    <form method="POST" action="{{ route('staff.logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" style="background:none;border:none;color:#333;cursor:pointer;font-size:16px;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    
    {{-- Dashboard Content --}}
    <div class="container" style="padding:60px 20px;">
        <h1 style="margin-bottom:40px;color:#d4a574;">
            <i class="fas fa-chart-line"></i> Dashboard - {{ auth()->user()->name }} ({{ auth()->user()->role->name }})
        </h1>
        
        {{-- Statistics Cards --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:30px;margin-bottom:40px;">
            <div class="card" style="text-align:center;">
                <i class="fas fa-shopping-cart" style="font-size:48px;color:#d4a574;margin-bottom:15px;"></i>
                <h3 style="color:#333;margin-bottom:10px;">Total Orders</h3>
                <p style="font-size:32px;color:#d4a574;font-weight:bold;">{{ $totalOrders }}</p>
            </div>
            
            <div class="card" style="text-align:center;">
                <i class="fas fa-cookie" style="font-size:48px;color:#17a2b8;margin-bottom:15px;"></i>
                <h3 style="color:#333;margin-bottom:10px;">Total Products</h3>
                <p style="font-size:32px;color:#17a2b8;font-weight:bold;">{{ $totalProducts }}</p>
            </div>
            
            <div class="card" style="text-align:center;">
                <i class="fas fa-users" style="font-size:48px;color:#28a745;margin-bottom:15px;"></i>
                <h3 style="color:#333;margin-bottom:10px;">Total Customers</h3>
                <p style="font-size:32px;color:#28a745;font-weight:bold;">{{ $totalCustomers }}</p>
            </div>
            
            <div class="card" style="text-align:center;">
                <i class="fas fa-exclamation-triangle" style="font-size:48px;color:#dc3545;margin-bottom:15px;"></i>
                <h3 style="color:#333;margin-bottom:10px;">Low Stock Items</h3>
                <p style="font-size:32px;color:#dc3545;font-weight:bold;">{{ $lowStockItems }}</p>
            </div>
        </div>
        
        {{-- Quick Actions --}}
        <div class="card">
            <h2 style="color:#d4a574;margin-bottom:20px;">Quick Actions</h2>
            <div style="display:flex;gap:15px;flex-wrap:wrap;">
                <a href="{{ route('products.create') }}" class="btn btn-primary" style="text-decoration:none;">
                    <i class="fas fa-plus"></i> Add Product
                </a>
                <a href="{{ route('orders.index') }}" class="btn btn-primary" style="text-decoration:none;">
                    <i class="fas fa-list"></i> View Orders
                </a>
                <a href="{{ route('ingredients.index') }}" class="btn btn-primary" style="text-decoration:none;">
                    <i class="fas fa-box"></i> Manage Inventory
                </a>
            </div>
        </div>
    </div>
</body>
</html>
