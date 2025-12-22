<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Sweet Crust Bakery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    {{-- Navigation --}}
    <nav>
        <div class="container">
            <div class="logo"><i class="fas fa-birthday-cake"></i> Sweet Crust</div>
            <ul>
                <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{ route('products') }}"><i class="fas fa-cookie"></i> Products</a></li>
                <li><a href="{{ route('about') }}"><i class="fas fa-info-circle"></i> About</a></li>
                <li><a href="{{ route('contact') }}"><i class="fas fa-envelope"></i> Contact</a></li>
                <li><a href="{{ route('customer.login.show') }}"><i class="fas fa-user"></i> Login</a></li>
            </ul>
        </div>
    </nav>
    
    {{-- Contact Section --}}
    <div class="container" style="padding:60px 20px;max-width:600px;">
        <h1 style="text-align:center;margin-bottom:40px;color:#d4a574;">Contact Us</h1>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="card">
            <form method="POST" action="{{ route('contact.submit') }}">
                @csrf
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Name</label>
                    <input type="text" name="name" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-comment"></i> Message</label>
                    <textarea name="message" rows="5" required style="width:100%;padding:12px;border:1px solid #ddd;border-radius:5px;font-family:inherit;"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary btn-full">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>
        
        <div class="card" style="margin-top:30px;text-align:center;">
            <h3 style="color:#d4a574;margin-bottom:20px;">Get In Touch</h3>
            <p style="color:#666;margin-bottom:10px;"><i class="fas fa-phone"></i> +92 300 1234567</p>
            <p style="color:#666;margin-bottom:10px;"><i class="fas fa-envelope"></i> info@sweetcrust.com</p>
            <p style="color:#666;"><i class="fas fa-map-marker-alt"></i> Wah Cantt, Pakistan</p>
        </div>
    </div>
</body>
</html>
