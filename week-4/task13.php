<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Preview Only</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; background: #f9f9f9; padding: 24px; border-radius: 8px; border: 1px solid #ccc; }
        h2 { color: #007bff; }
        form { margin-bottom: 24px; }
        input[type="text"], input[type="email"], input[type="password"] { padding: 8px; border-radius: 4px; border: 1px solid #aaa; width: 100%; margin-bottom: 16px; }
        label { display: block; margin-bottom: 4px; font-weight: bold; }
        button { padding: 8px 16px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; margin-bottom: 8px; }
        .preview { background: #e6f7ff; padding: 16px; border-radius: 6px; margin-top: 16px; }
        .preview h3 { margin-top: 0; color: #007bff; }
        .preview-item { margin-bottom: 8px; }
        .strength-strong { color: green; font-weight: bold; }
        .strength-weak { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Build a "Registration Preview Only" Screen</h2>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php if (isset($_POST['name'])) echo htmlspecialchars($_POST['name']); ?>">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password">

        <button type="submit">Preview Registration</button>
    </form>
    
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php
        $name = trim($_POST["name"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $password = $_POST["password"] ?? "";
        $confirm_password = $_POST["confirm_password"] ?? "";
        $errors = [];
        
        if ($name === "") $errors[] = "Name is required.";
        if ($email === "") $errors[] = "Email is required.";
        if ($password === "") $errors[] = "Password is required.";
        if ($confirm_password === "") $errors[] = "Confirm Password is required.";
        if ($password !== "" && $confirm_password !== "" && $password !== $confirm_password) {
            $errors[] = "Passwords do not match.";
        }
        if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }
        
        if (count($errors) > 0) {
            foreach ($errors as $error) {
        ?>
                <div class="error">✗ <?php echo htmlspecialchars($error); ?></div>
        <?php
            }
        } else {
            // Determine password strength
            $strength = "Weak";
            if (strlen($password) >= 8 && preg_match('/[0-9]/', $password) && preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
                $strength = "Strong";
            }
            $strengthClass = $strength === "Strong" ? "strength-strong" : "strength-weak";
        ?>
            <div class="preview">
                <h3>Registration Preview:</h3>
                <div class="preview-item"><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></div>
                <div class="preview-item"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></div>
                <div class="preview-item"><strong>Password Strength:</strong> <span class="<?php echo $strengthClass; ?>"><?php echo $strength; ?></span></div>
            </div>
        <?php } ?>
    <?php endif; ?>
</body>
</html>
