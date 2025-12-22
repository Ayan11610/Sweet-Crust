<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Sweet Crust</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .cart-item { display: flex; align-items: center; padding: 15px; border-bottom: 1px solid #eee; }
        .cart-item img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; margin-right: 20px; }
        .cart-item-details { flex: 1; }
        .quantity-control { display: flex; align-items: center; gap: 10px; }
        .quantity-control button { width: 30px; height: 30px; border: 1px solid #d4a574; background: white; color: #d4a574; cursor: pointer; border-radius: 4px; }
        .quantity-control button:hover { background: #d4a574; color: white; }
        .quantity-control input { width: 50px; text-align: center; border: 1px solid #ddd; padding: 5px; border-radius: 4px; }
    </style>
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
    
    {{-- Cart Content --}}
    <div class="container" style="padding:60px 20px;">
        <h1 style="margin-bottom:40px;color:#d4a574;"><i class="fas fa-shopping-cart"></i> Shopping Cart</h1>
        
        @if(session('success'))
        <div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div style="background:#f8d7da;color:#721c24;padding:15px;border-radius:8px;margin-bottom:20px;">
            {{ session('error') }}
        </div>
        @endif
        
        <div style="display:grid;grid-template-columns:2fr 1fr;gap:30px;">
            {{-- Cart Items --}}
            <div class="card">
                <h2 style="color:#d4a574;margin-bottom:20px;">Cart Items</h2>
                <div id="cartItems">
                    <!-- Cart items will be loaded here via JavaScript -->
                </div>
            </div>
            
            {{-- Order Summary --}}
            <div>
                <div class="card">
                    <h2 style="color:#d4a574;margin-bottom:20px;">Order Summary</h2>
                    <div style="margin-bottom:20px;">
                        <div style="display:flex;justify-content:space-between;margin-bottom:10px;">
                            <span>Subtotal:</span>
                            <span id="subtotal">Rs. 0</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:10px;padding-top:10px;border-top:2px solid #d4a574;font-weight:bold;font-size:18px;">
                            <span>Total:</span>
                            <span id="total">Rs. 0</span>
                        </div>
                    </div>
                    
                    <form id="checkoutForm" method="POST" action="{{ route('customer.orders.store') }}">
                        @csrf
                        <input type="hidden" name="cart" id="cartData">
                        
                        <div style="margin-bottom:20px;">
                            <label style="display:block;margin-bottom:5px;color:#333;font-weight:bold;">Delivery Address</label>
                            <textarea name="deliveryAddress" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:4px;resize:vertical;" rows="3">{{ auth('customer')->user()->address }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" style="width:100%;">
                            <i class="fas fa-check"></i> Place Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    // Cart management using localStorage
    let cart = JSON.parse(localStorage.getItem('cart') || '[]');
    
    function renderCart() {
        const cartItemsDiv = document.getElementById('cartItems');
        
        if (cart.length === 0) {
            cartItemsDiv.innerHTML = '<p style="text-align:center;color:#999;padding:40px;">Your cart is empty. <a href="{{ route("products") }}" style="color:#d4a574;">Browse products</a></p>';
            document.getElementById('subtotal').textContent = 'Rs. 0';
            document.getElementById('total').textContent = 'Rs. 0';
            return;
        }
        
        let html = '';
        let total = 0;
        
        cart.forEach((item, index) => {
            const subtotal = item.price * item.quantity;
            total += subtotal;
            
            html += `
                <div class="cart-item">
                    <img src="/images/products/${item.image}" alt="${item.name}">
                    <div class="cart-item-details">
                        <h3 style="color:#d4a574;margin-bottom:5px;">${item.name}</h3>
                        <p style="color:#666;margin-bottom:5px;">Rs. ${item.price}</p>
                    </div>
                    <div class="quantity-control">
                        <button onclick="updateQuantity(${index}, -1)">-</button>
                        <input type="number" value="${item.quantity}" min="1" readonly>
                        <button onclick="updateQuantity(${index}, 1)">+</button>
                    </div>
                    <div style="margin-left:20px;min-width:100px;text-align:right;">
                        <p style="font-weight:bold;color:#d4a574;">Rs. ${subtotal}</p>
                    </div>
                    <button onclick="removeItem(${index})" style="margin-left:15px;background:#dc3545;color:white;border:none;padding:8px 12px;border-radius:4px;cursor:pointer;">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
        });
        
        cartItemsDiv.innerHTML = html;
        document.getElementById('subtotal').textContent = 'Rs. ' + total;
        document.getElementById('total').textContent = 'Rs. ' + total;
    }
    
    function updateQuantity(index, change) {
        cart[index].quantity += change;
        if (cart[index].quantity < 1) cart[index].quantity = 1;
        if (cart[index].quantity > cart[index].stock) {
            alert('Not enough stock available!');
            cart[index].quantity = cart[index].stock;
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
    }
    
    function removeItem(index) {
        if (confirm('Remove this item from cart?')) {
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
        }
    }
    
    // Prepare cart data for submission
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        if (cart.length === 0) {
            e.preventDefault();
            alert('Your cart is empty!');
            return;
        }
        
        const cartData = cart.map(item => ({
            productId: item.id,
            quantity: item.quantity
        }));
        
        document.getElementById('cartData').value = JSON.stringify(cartData);
    });
    
    // Initial render
    renderCart();
    </script>
</body>
</html>
