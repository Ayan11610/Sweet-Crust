<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->productName }} - Sweet Crust Bakery</title>
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
    
    {{-- Product Details --}}
    <div class="container" style="padding:60px 20px;">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;max-width:1000px;margin:0 auto;">
            {{-- Product Image --}}
            <div>
                <img src="{{ $product->imageUrl ? asset($product->imageUrl) : 'https://via.placeholder.com/500x500?text=No+Image' }}" alt="{{ $product->productName }}" 
                     style="width:100%;border-radius:8px;box-shadow:0 4px 15px rgba(0,0,0,0.1);">
            </div>
            
            {{-- Product Info --}}
            <div>
                <h1 style="color:#d4a574;margin-bottom:20px;">{{ $product->productName }}</h1>
                <p style="color:#666;line-height:1.8;margin-bottom:20px;">{{ $product->description }}</p>
                
                <div style="margin-bottom:20px;">
                    <p style="font-size:32px;color:#d4a574;font-weight:bold;">Rs. {{ number_format($product->price, 2) }}</p>
                </div>
                
                <div style="margin-bottom:20px;">
                    <p style="color:#666;"><i class="fas fa-box"></i> Stock: <strong>{{ $product->stockQuantity }}</strong></p>
                    <p style="color:#666;"><i class="fas fa-tag"></i> Category: <strong>{{ $product->category }}</strong></p>
                </div>
                
                @auth('customer')
                    @if($product->stockQuantity > 0)
                        <div style="margin-bottom:20px;">
                            <label style="display:block;margin-bottom:5px;color:#333;font-weight:bold;">Quantity:</label>
                            <input type="number" id="quantity" value="1" min="1" max="{{ $product->stockQuantity }}" style="width:80px;padding:8px;border:1px solid #ddd;border-radius:4px;">
                        </div>
                        <button onclick="addToCart()" class="btn btn-primary" style="display:inline-block;">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                    @else
                        <p style="color:#dc3545;font-weight:bold;">Out of Stock</p>
                    @endif
                @else
                    <a href="{{ route('customer.login.show') }}" class="btn btn-primary" style="display:inline-block;text-decoration:none;">
                        <i class="fas fa-shopping-cart"></i> Login to Order
                    </a>
                @endauth
                
                <a href="{{ route('products') }}" style="display:inline-block;margin-left:15px;color:#d4a574;text-decoration:none;">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>
        </div>
    </div>
    
    @auth('customer')
    <script>
    const product = {
        id: {{ $product->id }},
        name: "{{ $product->productName }}",
        price: {{ $product->price }},
        image: "{{ $product->imageUrl }}",
        stock: {{ $product->stockQuantity }}
    };
    
    function addToCart() {
        const quantity = parseInt(document.getElementById('quantity').value);
        
        if (quantity < 1 || quantity > product.stock) {
            alert('Invalid quantity!');
            return;
        }
        
        let cart = JSON.parse(localStorage.getItem('cart') || '[]');
        
        // Check if product already in cart
        const existingIndex = cart.findIndex(item => item.id === product.id);
        
        if (existingIndex > -1) {
            cart[existingIndex].quantity += quantity;
            if (cart[existingIndex].quantity > product.stock) {
                cart[existingIndex].quantity = product.stock;
                alert('Maximum stock reached!');
            }
        } else {
            cart.push({
                id: product.id,
                name: product.name,
                price: product.price,
                image: product.image,
                stock: product.stock,
                quantity: quantity
            });
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        alert('Product added to cart!');
    }
    
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
