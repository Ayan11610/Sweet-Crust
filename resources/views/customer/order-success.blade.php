<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed Successfully - Sweet Crust Bakery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .success-container {
            max-width: 700px;
            margin: 80px auto;
            padding: 40px;
            text-align: center;
        }
        .success-icon {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 20px;
            animation: scaleIn 0.5s ease-in-out;
        }
        @keyframes scaleIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        .order-details {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            margin: 30px 0;
            text-align: left;
        }
        .order-details h3 {
            color: #d4a574;
            margin-bottom: 20px;
            text-align: center;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #dee2e6;
        }
        .detail-row:last-child {
            border-bottom: none;
            font-weight: bold;
            font-size: 18px;
            color: #d4a574;
        }
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }
    </style>
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
                <li><a href="{{ route('customer.cart') }}"><i class="fas fa-shopping-cart"></i> Cart</a></li>
                <li><a href="{{ route('customer.dashboard') }}"><i class="fas fa-user"></i> Dashboard</a></li>
            </ul>
        </div>
    </nav>

    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h1 style="color: #28a745; margin-bottom: 15px;">🎉 Thank You for Your Order! 🎉</h1>
        <h2 style="color: #d4a574; margin-bottom: 10px; font-size: 24px;">Order Placed Successfully!</h2>
        <p style="color: #666; font-size: 18px; margin-bottom: 10px; line-height: 1.6;">
            <strong>Dear {{ $order->customer->name }},</strong>
        </p>
        <p style="color: #666; font-size: 16px; margin-bottom: 30px; line-height: 1.6;">
            Thank you for choosing Sweet Crust Bakery! We truly appreciate your business. 
            Your order has been received and our team will start preparing your delicious treats right away. 
            We can't wait for you to enjoy our freshly baked goods!
        </p>

        <div class="order-details">
            <h3><i class="fas fa-receipt"></i> Order Details</h3>
            
            <div class="detail-row">
                <span><strong>Order ID:</strong></span>
                <span>#{{ $order->id }}</span>
            </div>
            
            <div class="detail-row">
                <span><strong>Order Date:</strong></span>
                <span>{{ $order->created_at->format('d M Y, h:i A') }}</span>
            </div>
            
            <div class="detail-row">
                <span><strong>Status:</strong></span>
                <span class="badge badge-warning">{{ $order->status }}</span>
            </div>
            
            <div class="detail-row">
                <span><strong>Delivery Address:</strong></span>
                <span>{{ $order->deliveryAddress }}</span>
            </div>
            
            <div class="detail-row">
                <span><strong>Total Amount:</strong></span>
                <span>Rs. {{ number_format($order->totalAmount, 2) }}</span>
            </div>
        </div>

        <div style="background: #fff3cd; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #ffc107;">
            <p style="margin: 0; color: #856404;">
                <i class="fas fa-info-circle"></i> 
                You will receive updates about your order via email. You can also track your order status in the "My Orders" section.
            </p>
        </div>

        <div class="action-buttons">
            <a href="{{ route('customer.orders') }}" class="btn btn-primary">
                <i class="fas fa-list"></i> View My Orders
            </a>
            <a href="{{ route('products') }}" class="btn btn-secondary">
                <i class="fas fa-shopping-bag"></i> Continue Shopping
            </a>
        </div>
    </div>

    <script>
        // Clear cart from localStorage after successful order
        localStorage.removeItem('cart');
    </script>
</body>
</html>
