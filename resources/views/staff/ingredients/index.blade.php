<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Inventory - Sweet Crust</title>
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
    
    {{-- Inventory Management --}}
    <div class="container" style="padding:60px 20px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:40px;">
            <h1 style="color:#d4a574;"><i class="fas fa-box"></i> Manage Inventory</h1>
            <a href="{{ route('ingredients.create') }}" class="btn btn-primary" style="text-decoration:none;">
                <i class="fas fa-plus"></i> Add New Ingredient
            </a>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="card">
            <table id="ingredientsTable" style="width:100%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ingredients as $ingredient)
                    <tr>
                        <td>{{ $ingredient->id }}</td>
                        <td>{{ $ingredient->name }}</td>
                        <td>{{ $ingredient->quantity }}</td>
                        <td>{{ $ingredient->unit }}</td>
                        <td>
                            @if($ingredient->quantity < 10)
                                <span style="padding:5px 10px;border-radius:5px;font-size:12px;background:#dc3545;color:#fff;">
                                    <i class="fas fa-exclamation-triangle"></i> Low Stock
                                </span>
                            @else
                                <span style="padding:5px 10px;border-radius:5px;font-size:12px;background:#28a745;color:#fff;">
                                    <i class="fas fa-check"></i> In Stock
                                </span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('ingredients.edit', $ingredient->id) }}" style="color:#17a2b8;margin-right:10px;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('ingredients.destroy', $ingredient->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this ingredient?')" 
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
        $('#ingredientsTable').DataTable();
    });
    </script>
</body>
</html>
