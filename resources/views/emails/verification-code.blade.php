<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verification Code</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2>Sweet Crust Bakery</h2>
    
    <p>Hello {{ $userName }},</p>
    
    <p>Your verification code is: <strong style="font-size: 24px; color: #8B4513;">{{ $code }}</strong></p>
    
    <p>This code will expire in 15 minutes.</p>
    
    <p>Best regards,<br>Sweet Crust Team</p>
</body>
</html>
