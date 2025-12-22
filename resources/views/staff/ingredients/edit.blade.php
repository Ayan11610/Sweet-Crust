<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ingredient - Sweet Crust</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    
    {{-- Edit Ingredient Form --}}
    <div class="container" style="padding:60px 20px;">
        <h1 style="margin-bottom:40px;color:#d4a574;"><i class="fas fa-edit"></i> Edit Ingredient</h1>
        
        @if($errors->any())
        <div style="background:#f8d7da;color:#721c24;padding:15px;border-radius:8px;margin-bottom:20px;">
            <ul style="margin:0;padding-left:20px;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <div class="card" style="max-width:800px;margin:0 auto;">
            <form method="POST" action="{{ route('ingredients.update', $ingredient->id) }}">
                @csrf
                @method('PUT')
                
                <div style="margin-bottom:20px;">
                    <label style="display:block;margin-bottom:5px;color:#333;font-weight:bold;">Ingredient Name *</label>
                    <input type="text" name="ingredientName" value="{{ old('ingredientName', $ingredient->ingredientName) }}" required 
                           style="width:100%;padding:10px;border:1px solid #ddd;border-radius:4px;">
                </div>
                
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
                    <div>
                        <label style="display:block;margin-bottom:5px;color:#333;font-weight:bold;">Unit *</label>
                        <select name="unit" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:4px;">
                            <option value="">Select Unit</option>
                            <option value="kg" {{ old('unit', $ingredient->unit) == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                            <option value="g" {{ old('unit', $ingredient->unit) == 'g' ? 'selected' : '' }}>Gram (g)</option>
                            <option value="L" {{ old('unit', $ingredient->unit) == 'L' ? 'selected' : '' }}>Liter (L)</option>
                            <option value="ml" {{ old('unit', $ingredient->unit) == 'ml' ? 'selected' : '' }}>Milliliter (ml)</option>
                            <option value="pcs" {{ old('unit', $ingredient->unit) == 'pcs' ? 'selected' : '' }}>Pieces (pcs)</option>
                        </select>
                    </div>
                    
                    <div>
                        <label style="display:block;margin-bottom:5px;color:#333;font-weight:bold;">Quantity in Stock *</label>
                        <input type="number" name="quantityInStock" value="{{ old('quantityInStock', $ingredient->quantityInStock) }}" min="0" step="0.01" required 
                               style="width:100%;padding:10px;border:1px solid #ddd;border-radius:4px;">
                    </div>
                </div>
                
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
                    <div>
                        <label style="display:block;margin-bottom:5px;color:#333;font-weight:bold;">Reorder Level *</label>
                        <input type="number" name="reorderLevel" value="{{ old('reorderLevel', $ingredient->reorderLevel) }}" min="0" step="0.01" required 
                               style="width:100%;padding:10px;border:1px solid #ddd;border-radius:4px;">
                        <small style="color:#666;">Alert when stock falls below this level</small>
                    </div>
                    
                    <div>
                        <label style="display:block;margin-bottom:5px;color:#333;font-weight:bold;">Price per Unit (Rs.) *</label>
                        <input type="number" name="pricePerUnit" value="{{ old('pricePerUnit', $ingredient->pricePerUnit) }}" min="0" step="0.01" required 
                               style="width:100%;padding:10px;border:1px solid #ddd;border-radius:4px;">
                    </div>
                </div>
                
                <div style="display:flex;gap:15px;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Ingredient
                    </button>
                    <a href="{{ route('ingredients.index') }}" class="btn" style="background:#6c757d;color:white;text-decoration:none;">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
