<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - Sweet Crust</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="split-container">
        {{-- Left: Image --}}
        <div class="split-left" style="background-image: url('https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800');"></div>
        
        {{-- Right: Verification form --}}
        <div class="split-right">
            <div class="form-box">
                <h2><i class="fas fa-envelope-open"></i> Verify Email</h2>
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
                @endif
                
                <p style="margin-bottom:20px;color:#666;">
                    Enter the 6-digit code sent to your email.
                </p>
                
                <form method="POST" action="{{ route('staff.verify') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}">
                    
                    <div class="form-group">
                        <label><i class="fas fa-key"></i> Verification Code</label>
                        <input type="text" name="code" maxlength="6" required style="text-align:center;font-size:24px;letter-spacing:5px;">
                        @error('code')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-full">
                        <i class="fas fa-check"></i> Verify
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
