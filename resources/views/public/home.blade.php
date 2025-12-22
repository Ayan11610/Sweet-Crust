<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Crust Bakery - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    {{-- Navigation --}}
    <nav>
        <div class="container">
            <div class="logo"><i class="fas fa-birthday-cake"></i> Sweet Crust</div>
            <ul>
                <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{ route('products') }}"><i class="fas fa-cookie"></i> Products</a></li>
                <li><a href="{{ route('about') }}"><i class="fas fa-info-circle"></i> About</a></li>
                <li><a href="{{ route('contact') }}"><i class="fas fa-envelope"></i> Contact</a></li>
                <li><a href="{{ route('customer.login.show') }}"><i class="fas fa-user"></i> Login</a></li>
            </ul>
        </div>
    </nav>
    
    {{-- Hero Section --}}
    <div style="background:linear-gradient(rgba(0,0,0,0.3),rgba(0,0,0,0.3)),url('https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=1200') center/cover;
                height:500px;display:flex;align-items:center;justify-content:center;color:white;text-align:center;">
        <div>
            <h1 style="font-size:48px;margin-bottom:20px;">Welcome to Sweet Crust Bakery</h1>
            <p style="font-size:20px;margin-bottom:30px;">Freshly baked with love, every day</p>
            <a href="{{ route('products') }}" class="btn btn-primary" style="display:inline-block;text-decoration:none;">
                <i class="fas fa-shopping-cart"></i> Order Now
            </a>
        </div>
    </div>
    
    {{-- Featured Products --}}
    <div class="container" style="padding:60px 20px;">
        <h2 style="text-align:center;margin-bottom:40px;color:#d4a574;">Featured Products</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:30px;">
            @forelse($featuredProducts as $product)
            <div class="card" style="text-align:center;">
                <img src="{{ $product->imageUrl ? asset($product->imageUrl) : 'https://via.placeholder.com/200x200?text=No+Image' }}" 
                     alt="{{ $product->productName }}" 
                     style="width:100%;height:200px;object-fit:cover;border-radius:8px;margin-bottom:15px;">
                <h3 style="color:#d4a574;margin-bottom:10px;">{{ $product->productName }}</h3>
                <p style="color:#666;margin-bottom:15px;">Rs. {{ number_format($product->price, 2) }}</p>
                <a href="{{ route('product.details', $product->id) }}" class="btn btn-primary">
                    <i class="fas fa-eye"></i> View Details
                </a>
            </div>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:40px;">
                <p style="color:#666;font-size:18px;">No products available at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>
