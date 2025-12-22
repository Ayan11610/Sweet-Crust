<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - Sweet Crust</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
    
    {{-- Orders Table --}}
    <div class="container" style="padding:60px 20px;">
        <h1 style="margin-bottom:40px;color:#d4a574;"><i class="fas fa-shopping-bag"></i> My Orders</h1>
        
        <div class="card">
            <table id="ordersTable" style="width:100%;">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>Rs. {{ $order->totalAmount }}</td>
                        <td>
                            <span style="padding:5px 10px;border-radius:5px;font-size:12px;
                                @if($order->status == 'Pending') background:#ffc107;color:#000;
                                @elseif($order->status == 'In-Process') background:#17a2b8;color:#fff;
                                @elseif($order->status == 'Completed') background:#28a745;color:#fff;
                                @else background:#6c757d;color:#fff; @endif">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" style="color:#d4a574;text-decoration:none;">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
    // Initialize DataTable (jQuery DataTables)
    $(document).ready(function() {
        $('#ordersTable').DataTable({
            order: [[0, 'desc']]
        });
    });
    </script>
</body>
</html>
