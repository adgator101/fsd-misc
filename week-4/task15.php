<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate a Random 6-Digit OTP</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; background: #f9f9f9; padding: 24px; border-radius: 8px; border: 1px solid #ccc; text-align: center; }
        h2 { color: #007bff; }
        .otp-display { background: #007bff; color: white; padding: 24px; border-radius: 8px; font-size: 2em; font-weight: bold; letter-spacing: 8px; margin: 24px 0; }
        .refresh-button { padding: 10px 20px; background: #28a745; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 1em; }
        .refresh-button:hover { background: #218838; }
        .info { color: #666; margin-top: 16px; }
    </style>
</head>
<body>
    <h2>Generate a Random 6-Digit OTP</h2>
    
    <div class="otp-display">
        <?php echo rand(100000, 999999); ?>
    </div>
    
    <form method="post" action="">
        <button type="submit" class="refresh-button">Generate New OTP</button>
    </form>
    
    <div class="info">Refresh the page or click the button to generate a new OTP</div>
</body>
</html>
