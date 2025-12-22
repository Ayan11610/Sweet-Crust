<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Password - Sweet Crust</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="split-container">
        {{-- Left: Image --}}
        <div class="split-left" style="background-image: url('https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=800');"></div>
        
        {{-- Right: Set password form --}}
        <div class="split-right">
            <div class="form-box">
                <h2><i class="fas fa-lock"></i> Set Password</h2>
                
                @if(session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
                @endif
                
                <form method="POST" action="{{ route('staff.setPassword') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}">
                    
                    <div class="form-group">
                        <label><i class="fas fa-key"></i> New Password</label>
                        <input type="password" name="password" id="password" required>
                        @error('password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                        
                        {{-- Password strength bullets (live validation) --}}
                        <div class="password-strength">
                            <div class="strength-item" id="length">
                                <i class="fas fa-circle"></i> At least 8 characters
                            </div>
                            <div class="strength-item" id="uppercase">
                                <i class="fas fa-circle"></i> One uppercase letter
                            </div>
                            <div class="strength-item" id="lowercase">
                                <i class="fas fa-circle"></i> One lowercase letter
                            </div>
                            <div class="strength-item" id="number">
                                <i class="fas fa-circle"></i> One number
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-key"></i> Confirm Password</label>
                        <input type="password" name="password_confirmation" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-save"></i> Set Password
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
    // Password strength validation (live bullets)
    document.getElementById('password').addEventListener('input', function() {
        const pwd = this.value;
        document.getElementById('length').classList.toggle('valid', pwd.length >= 8);
        document.getElementById('uppercase').classList.toggle('valid', /[A-Z]/.test(pwd));
        document.getElementById('lowercase').classList.toggle('valid', /[a-z]/.test(pwd));
        document.getElementById('number').classList.toggle('valid', /[0-9]/.test(pwd));
    });
    </script>
</body>
</html>
