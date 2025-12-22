<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Sweet Crust Bakery</title>
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
    
    {{-- About Section --}}
    <div class="container" style="padding:60px 20px;max-width:800px;">
        <h1 style="text-align:center;margin-bottom:40px;color:#d4a574;">About Sweet Crust Bakery</h1>
        
        <div class="card">
            <h2 style="color:#d4a574;margin-bottom:20px;"><i class="fas fa-heart"></i> Our Story</h2>
            <p style="line-height:1.8;color:#666;margin-bottom:20px;">
                Sweet Crust Bakery has been serving delicious, freshly baked goods since 2020. 
                We believe in using only the finest ingredients to create treats that bring joy to every occasion.
            </p>
            
            <h2 style="color:#d4a574;margin-bottom:20px;margin-top:30px;"><i class="fas fa-star"></i> Our Mission</h2>
            <p style="line-height:1.8;color:#666;margin-bottom:20px;">
                To provide our customers with the highest quality baked goods, made with love and care. 
                Every product is crafted to perfection by our skilled bakers.
            </p>
            
            <h2 style="color:#d4a574;margin-bottom:20px;margin-top:30px;"><i class="fas fa-check-circle"></i> Why Choose Us</h2>
            <ul style="line-height:2;color:#666;margin-left:20px;">
                <li><i class="fas fa-check" style="color:#d4a574;"></i> Fresh ingredients daily</li>
                <li><i class="fas fa-check" style="color:#d4a574;"></i> Expert bakers with years of experience</li>
                <li><i class="fas fa-check" style="color:#d4a574;"></i> Custom orders available</li>
                <li><i class="fas fa-check" style="color:#d4a574;"></i> Fast and reliable delivery</li>
            </ul>
        </div>
    </div>
</body>
</html>
