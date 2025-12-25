<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sweet Crust</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="split-container">
        {{-- Left: Sweet treats image --}}
        <div class="split-left" style="background-image: url('https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=800');"></div>
        
        {{-- Right: Login form --}}
        <div class="split-right">
            <div class="form-box">
                <h2><i class="fas fa-sign-in-alt"></i> Login to Sweet Crust</h2>
                <p style="text-align:center; color:#666; margin-bottom:20px;">
                    Login as Customer or Staff
                </p>
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-error">
                        @foreach($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-lock"></i> Password</label>
                        <input type="password" name="password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                    
                    <div style="margin-top:20px;text-align:center;">
                        <p style="margin-bottom:10px;">Don't have an account?</p>
                        <div style="display:flex; gap:10px; justify-content:center;">
                            <a href="{{ route('customer.register.show') }}" class="btn btn-secondary" style="flex:1;">
                                <i class="fas fa-user"></i> Register as Customer
                            </a>
                            <a href="{{ route('staff.register.show') }}" class="btn btn-secondary" style="flex:1;">
                                <i class="fas fa-user-tie"></i> Register as Staff
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
