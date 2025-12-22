<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Registration - Sweet Crust</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="split-container">
        {{-- Left: Bakery image --}}
        <div class="split-left" style="background-image: url('https://images.unsplash.com/photo-1517433670267-08bbd4be890f?w=800');"></div>
        
        {{-- Right: Form --}}
        <div class="split-right">
            <div class="form-box">
                <h2><i class="fas fa-user-tie"></i> Staff Registration</h2>
                
                @if(session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
                @endif
                
                <form method="POST" action="{{ route('staff.register') }}">
                    @csrf
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Role</label>
                        <select name="roleId" style="width:100%;padding:12px;border:1px solid #ddd;border-radius:5px;">
                            <option value="1">Admin</option>
                            <option value="2">Baker</option>
                            <option value="3">Staff</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-paper-plane"></i> Register
                    </button>
                    
                    <p style="margin-top:20px;text-align:center;">
                        Already registered? <a href="{{ route('staff.login.show') }}" style="color:#d4a574;">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
