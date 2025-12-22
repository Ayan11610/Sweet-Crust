<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - Sweet Crust</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    {{-- Navigation --}}
    <nav>
        <div class="container">
            <div class="logo"><i class="fas fa-birthday-cake"></i> Sweet Crust</div>
            <ul>
                <li><a href="{{ route('customer.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('products') }}"><i class="fas fa-cookie"></i> Products</a></li>
                <li><a href="{{ route('customer.orders') }}"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
                <li>
                    <form method="POST" action="{{ route('customer.logout') }}" style="display:inline;">
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
            <i class="fas fa-user-circle"></i> Welcome, {{ auth('customer')->user()->name }}!
        </h1>
        
        {{-- Stats Cards --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:30px;margin-bottom:40px;">
            <div class="card" style="text-align:center;">
                <i class="fas fa-shopping-cart" style="font-size:48px;color:#d4a574;margin-bottom:15px;"></i>
                <h3 style="color:#333;margin-bottom:10px;">Total Orders</h3>
                <p style="font-size:32px;color:#d4a574;font-weight:bold;">{{ $totalOrders }}</p>
            </div>
            
            <div class="card" style="text-align:center;">
                <i class="fas fa-clock" style="font-size:48px;color:#f39c12;margin-bottom:15px;"></i>
                <h3 style="color:#333;margin-bottom:10px;">Pending Orders</h3>
                <p style="font-size:32px;color:#f39c12;font-weight:bold;">{{ $pendingOrders }}</p>
            </div>
            
            <div class="card" style="text-align:center;">
                <i class="fas fa-check-circle" style="font-size:48px;color:#28a745;margin-bottom:15px;"></i>
                <h3 style="color:#333;margin-bottom:10px;">Completed Orders</h3>
                <p style="font-size:32px;color:#28a745;font-weight:bold;">{{ $completedOrders }}</p>
            </div>
        </div>
        
        {{-- Quick Actions --}}
        <div class="card">
            <h2 style="color:#d4a574;margin-bottom:20px;">Quick Actions</h2>
            <div style="display:flex;gap:15px;flex-wrap:wrap;">
                <a href="{{ route('products') }}" class="btn btn-primary" style="text-decoration:none;">
                    <i class="fas fa-shopping-cart"></i> Browse Products
                </a>
                <a href="{{ route('customer.cart') }}" class="btn btn-primary" style="text-decoration:none;">
                    <i class="fas fa-shopping-bag"></i> View Cart
                </a>
                <a href="{{ route('customer.orders') }}" class="btn btn-primary" style="text-decoration:none;">
                    <i class="fas fa-list"></i> View My Orders
                </a>
            </div>
        </div>
    </div>
</body>
</html>
