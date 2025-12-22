<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Login - Sweet Crust</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="split-container">
        {{-- Left: Image --}}
        <div class="split-left" style="background-image: url('https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800');"></div>
        
        {{-- Right: Login form --}}
        <div class="split-right">
            <div class="form-box">
                <h2><i class="fas fa-sign-in-alt"></i> Staff Login</h2>
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
                @endif
                
                <form method="POST" action="{{ route('staff.login') }}">
                    @csrf
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-lock"></i> Password</label>
                        <input type="password" name="password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                    
                    <p style="margin-top:20px;text-align:center;">
                        New here? <a href="{{ route('staff.register.show') }}" style="color:#d4a574;">Register</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
