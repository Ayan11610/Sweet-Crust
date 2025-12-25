<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body >
    <div >
        <h2 >Sweet Crust Bakery</h2>
        
        <p>Hello <strong>{{ $order->customerName }}</strong>,</p>

        <p>Thank you for your order! Your order has been successfully placed.</p>

        <div >
            <h3 >Order Details</h3>
            <p><strong>Order ID:</strong> #{{ $order->id }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
            <p><strong>Status:</strong> <span>{{ $order->status }}</span></p>
            <p><strong>Delivery Address:</strong> {{ $order->deliveryAddress }}</p>
        </div>

        <h3 >Order Items</h3>
        <table >
            <thead>
                <tr >
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr >
                    <td >{{ $item->product->name }}</td>
                    <td >{{ $item->quantity }}</td>
                    <td >Rs. {{ number_format($item->price, 2) }}</td>
                    <td >Rs. {{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
                <tr >
                    <td >Total Amount:</td>
                    <td >Rs. {{ number_format($order->totalAmount, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
