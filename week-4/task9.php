<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Rule Validator</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; background: #f9f9f9; padding: 24px; border-radius: 8px; border: 1px solid #ccc; }
        h2 { color: #007bff; }
        form { margin-bottom: 24px; }
        input[type="password"] { padding: 8px; border-radius: 4px; border: 1px solid #aaa; width: 100%; margin-bottom: 16px; }
        button { padding: 8px 16px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; margin-bottom: 8px; }
        .success { color: green; margin-bottom: 16px; font-weight: bold; }
        .rule { margin-bottom: 8px; }
    </style>
</head>
<body>
    <h2>Password Rule Validator (No Confirm Field)</h2>
    <form method="post" action="">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <button type="submit">Validate Password</button>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php
        $password = $_POST["password"] ?? "";
        $errors = [];
        
        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long.";
        }
        if (!preg_match('/[0-9]/', $password)) {
            $errors[] = "Password must include at least one number.";
        }
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $errors[] = "Password must include at least one special character.";
        }
        
        if (count($errors) > 0) {
            foreach ($errors as $error) {
        ?>
                <div class="error rule">✗ <?php echo htmlspecialchars($error); ?></div>
        <?php
            }
        } else {
        ?>
            <div class="success">✓ Password is valid!</div>
        <?php } ?>
    <?php endif; ?>
</body>
</html>
