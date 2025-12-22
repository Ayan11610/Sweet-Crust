<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Sweet Crust Bakery</title>
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
                @auth('customer')
                    <li><a href="{{ route('customer.cart') }}"><i class="fas fa-shopping-cart"></i> Cart (<span id="cartCount">0</span>)</a></li>
                    <li><a href="{{ route('customer.dashboard') }}"><i class="fas fa-user"></i> Dashboard</a></li>
                @else
                    <li><a href="{{ route('customer.login.show') }}"><i class="fas fa-user"></i> Login</a></li>
                @endauth
            </ul>
        </div>
    </nav>
    
    {{-- Products Section --}}
    <div class="container" style="padding:60px 20px;">
        <h1 style="text-align:center;margin-bottom:40px;color:#d4a574;">Our Products</h1>
        
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:30px;">
            @foreach($products as $product)
            <div class="card" style="text-align:center;">
                <img src="{{ $product->imageUrl ? asset($product->imageUrl) : 'https://via.placeholder.com/280x220?text=No+Image' }}" alt="{{ $product->productName }}" 
                     style="width:100%;height:220px;object-fit:cover;border-radius:8px;margin-bottom:15px;">
                <h3 style="color:#d4a574;margin-bottom:10px;">{{ $product->productName }}</h3>
                <p style="color:#666;font-size:14px;margin-bottom:10px;">{{ $product->description }}</p>
                <p style="color:#333;font-weight:bold;font-size:18px;margin-bottom:15px;">Rs. {{ number_format($product->price, 2) }}</p>
                <p style="color:#999;font-size:13px;margin-bottom:15px;">
                    <i class="fas fa-box"></i> Stock: {{ $product->stockQuantity }}
                </p>
                <a href="{{ route('product.details', $product->id) }}" class="btn btn-primary">
                    <i class="fas fa-eye"></i> View Details
                </a>
            </div>
            @endforeach
        </div>
        
        @if($products->isEmpty())
        <p style="text-align:center;color:#999;padding:40px;">No products available at the moment.</p>
        @endif
    </div>
    
    @auth('customer')
    <script>
    // Update cart count
    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem('cart') || '[]');
        const count = cart.reduce((total, item) => total + item.quantity, 0);
        const cartCountEl = document.getElementById('cartCount');
        if (cartCountEl) cartCountEl.textContent = count;
    }
    updateCartCount();
    </script>
    @endauth
</body>
</html>
