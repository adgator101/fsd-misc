<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Array Search Logic (Email Finder)</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; background: #f9f9f9; padding: 24px; border-radius: 8px; border: 1px solid #ccc; }
        h2 { color: #007bff; }
        form { margin-bottom: 24px; }
        input[type="text"] { padding: 8px; border-radius: 4px; border: 1px solid #aaa; width: 100%; margin-bottom: 16px; }
        button { padding: 8px 16px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; margin-bottom: 16px; font-weight: bold; }
        .success { color: green; margin-bottom: 16px; font-weight: bold; }
        .existing-emails { background: #f0f0f0; padding: 12px; border-radius: 4px; margin-bottom: 16px; }
    </style>
</head>
<body>
    <h2>Array Search Logic (Email Finder)</h2>
    
    <div class="existing-emails">
        <strong>Existing Emails:</strong>
        <ul>
            <li>ram@gmail.com</li>
            <li>sita@gmail.com</li>
            <li>hari@gmail.com</li>
        </ul>
    </div>
    
    <form method="post" action="">
        <label for="newEmail">Check Email:</label>
        <input type="text" id="newEmail" name="newEmail" value="<?php if (isset($_POST['newEmail'])) echo htmlspecialchars($_POST['newEmail']); ?>" placeholder="Enter email to check">

        <button type="submit">Check Availability</button>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php
        $users = [
            ["email" => "ram@gmail.com"],
            ["email" => "sita@gmail.com"],
            ["email" => "hari@gmail.com"]
        ];
        
        $newEmail = trim($_POST["newEmail"] ?? "");
        $emailExists = false;
        
        foreach ($users as $user) {
            if ($user["email"] === $newEmail) {
                $emailExists = true;
                break;
            }
        }
        
        if ($emailExists) {
        ?>
            <div class="error">Email already exists</div>
        <?php } else { ?>
            <div class="success">Email available</div>
        <?php } ?>
    <?php endif; ?>
</body>
</html>
