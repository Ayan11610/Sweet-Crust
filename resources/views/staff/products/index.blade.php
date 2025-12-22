<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Sweet Crust</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
    
    {{-- Products Management --}}
    <div class="container" style="padding:60px 20px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:40px;">
            <h1 style="color:#d4a574;"><i class="fas fa-cookie"></i> Manage Products</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary" style="text-decoration:none;">
                <i class="fas fa-plus"></i> Add New Product
            </a>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="card">
            <table id="productsTable" style="width:100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category }}</td>
                        <td>Rs. {{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" style="color:#17a2b8;margin-right:10px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this product?')" 
                                        style="background:none;border:none;color:#dc3545;cursor:pointer;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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
    $(document).ready(function() {
        $('#productsTable').DataTable();
    });
    </script>
</body>
</html>
