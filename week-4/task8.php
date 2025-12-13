<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manual Email Format Check</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; background: #f9f9f9; padding: 24px; border-radius: 8px; border: 1px solid #ccc; }
        h2 { color: #007bff; }
        form { margin-bottom: 24px; }
        input[type="text"] { padding: 8px; border-radius: 4px; border: 1px solid #aaa; width: 100%; margin-bottom: 16px; }
        button { padding: 8px 16px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; margin-bottom: 16px; font-weight: bold; }
        .success { color: green; margin-bottom: 16px; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Manual Email Format Check (Without filter_var)</h2>
    <form method="post" action="">
        <label for="email">Enter your email:</label>
        <input type="text" id="email" name="email" value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>">

        <button type="submit">Check Email</button>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php
        $email = trim($_POST["email"] ?? "");
        $hasAt = strpos($email, "@") !== false;
        $hasDot = strpos($email, ".") !== false;
        $atPosition = strpos($email, "@");
        $atNotFirst = $atPosition !== false && $atPosition > 0;
        
        if ($hasAt && $hasDot && $atNotFirst) {
        ?>
            <div class="success">Email format is correct (basic check)!</div>
        <?php } else { ?>
            <div class="error">Email format incorrect (basic check).</div>
        <?php } ?>
    <?php endif; ?>
</body>
</html>
