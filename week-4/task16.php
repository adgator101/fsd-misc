<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simulate a Simple Login</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 40px auto; background: #f9f9f9; padding: 24px; border-radius: 8px; border: 1px solid #ccc; }
        h2 { color: #007bff; text-align: center; }
        form { margin-bottom: 24px; }
        input[type="text"], input[type="password"] { padding: 8px; border-radius: 4px; border: 1px solid #aaa; width: 100%; margin-bottom: 16px; }
        label { display: block; margin-bottom: 4px; font-weight: bold; }
        button { padding: 10px 16px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; width: 100%; }
        button:hover { background: #0056b3; }
        .success { background: #d4edda; color: #155724; padding: 16px; border-radius: 4px; border: 1px solid #c3e6cb; text-align: center; font-weight: bold; }
        .error { background: #f8d7da; color: #721c24; padding: 16px; border-radius: 4px; border: 1px solid #f5c6cb; text-align: center; font-weight: bold; }
        .credentials { background: #fff3cd; padding: 12px; border-radius: 4px; margin-bottom: 16px; font-size: 0.9em; }
    </style>
</head>
<body>
    <h2>Simulate a Simple Login (Validation Only)</h2>
    
    <div class="credentials">
        <strong>Test Credentials:</strong><br>
        Username: admin<br>
        Password: 1234@admin
    </div>
    
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php if (isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
    </form>
    
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php
        $username = trim($_POST["username"] ?? "");
        $password = $_POST["password"] ?? "";
        
        if ($username === "admin" && $password === "1234@admin") {
        ?>
            <div class="success">✓ Welcome Admin</div>
        <?php } else { ?>
            <div class="error">✗ Invalid credentials</div>
        <?php } ?>
    <?php endif; ?>
</body>
</html>
