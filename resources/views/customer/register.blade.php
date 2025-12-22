<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration - Sweet Crust</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="split-container">
        {{-- Left: Bakery products image --}}
        <div class="split-left" style="background-image: url('https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=800');"></div>
        
        {{-- Right: Registration form --}}
        <div class="split-right">
            <div class="form-box">
                <h2><i class="fas fa-user-plus"></i> Customer Registration</h2>
                
                @if(session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
                @endif
                
                <form method="POST" action="{{ route('customer.register') }}">
                    @csrf
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-phone"></i> Phone Number</label>
                        <input type="text" name="phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-map-marker-alt"></i> Address</label>
                        <input type="text" name="address" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-paper-plane"></i> Register
                    </button>
                    
                    <p style="margin-top:20px;text-align:center;">
                        Already registered? <a href="{{ route('customer.login.show') }}" style="color:#d4a574;">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
