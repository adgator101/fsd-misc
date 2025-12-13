<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Basic Form Validation – Required Fields</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; background: #f9f9f9; padding: 24px; border-radius: 8px; border: 1px solid #ccc; }
        h2 { color: #007bff; }
        form { margin-bottom: 24px; }
        input[type="text"], input[type="email"] { padding: 8px; border-radius: 4px; border: 1px solid #aaa; width: 100%; margin-bottom: 16px; }
        button { padding: 8px 16px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; margin-bottom: 16px; font-weight: bold; }
        .success { color: green; margin-bottom: 16px; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Basic Form Validation – Required Fields</h2>
    <form method="post" action="">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" value="<?php if (isset($_POST['fullname'])) echo htmlspecialchars($_POST['fullname']); ?>">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>">

        <button type="submit">Submit</button>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php
        $fullname = trim($_POST["fullname"] ?? "");
        $email = trim($_POST["email"] ?? "");
        if ($fullname === "" || $email === "") {
        ?>
            <div class="error">Error: All fields are required!</div>
        <?php } else { ?>
            <div class="success">All good!</div>
        <?php } ?>
    <?php endif; ?>
</body>
</html>
