<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            font-size: 14px;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #007bff;
        }
        .error {
            color: #dc3545;
            font-size: 13px;
            margin-bottom: 12px;
            display: block;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #c3e6cb;
            margin-bottom: 20px;
            text-align: center;
        }
        .general-error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #f5c6cb;
            margin-bottom: 20px;
            text-align: center;
        }
        button {
            width: 100%;
            padding: 12px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }
        button:hover {
            background: #0056b3;
        }
        .field-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <?php
    // Initialize variables
    $errors = [];
    $successMessage = "";
    $generalError = "";
    $name = "";
    $email = "";
    
    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get and sanitize form data
        $name = trim($_POST["name"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $password = $_POST["password"] ?? "";
        $confirmPassword = $_POST["confirm_password"] ?? "";
        
        // Validation
        // 1. Check if all fields are filled
        if (empty($name)) {
            $errors['name'] = "Name is required.";
        } elseif (strlen($name) < 2) {
            $errors['name'] = "Name must be at least 2 characters long.";
        }
        
        if (empty($email)) {
            $errors['email'] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please enter a valid email address.";
        }
        
        if (empty($password)) {
            $errors['password'] = "Password is required.";
        } elseif (strlen($password) < 8) {
            $errors['password'] = "Password must be at least 8 characters long.";
        } elseif (!preg_match('/[A-Z]/', $password)) {
            $errors['password'] = "Password must contain at least one uppercase letter.";
        } elseif (!preg_match('/[a-z]/', $password)) {
            $errors['password'] = "Password must contain at least one lowercase letter.";
        } elseif (!preg_match('/[0-9]/', $password)) {
            $errors['password'] = "Password must contain at least one number.";
        } elseif (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            $errors['password'] = "Password must contain at least one special character.";
        }
        
        if (empty($confirmPassword)) {
            $errors['confirm_password'] = "Please confirm your password.";
        } elseif ($password !== $confirmPassword) {
            $errors['confirm_password'] = "Passwords do not match.";
        }
        
        // If no validation errors, proceed with registration
        if (empty($errors)) {
            $jsonFile = __DIR__ . '/users.json';
            
            try {
                // Read existing users from JSON file
                if (!file_exists($jsonFile)) {
                    // Create the file if it doesn't exist
                    file_put_contents($jsonFile, json_encode([]));
                }
                
                $jsonContent = file_get_contents($jsonFile);
                if ($jsonContent === false) {
                    throw new Exception("Unable to read users file.");
                }
                
                $users = json_decode($jsonContent, true);
                if ($users === null) {
                    $users = [];
                }
                
                // Check if email already exists
                $emailExists = false;
                foreach ($users as $user) {
                    if ($user['email'] === $email) {
                        $emailExists = true;
                        break;
                    }
                }
                
                if ($emailExists) {
                    $errors['email'] = "This email is already registered.";
                } else {
                    // Hash the password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Create new user array
                    $newUser = [
                        'name' => $name,
                        'email' => $email,
                        'password' => $hashedPassword,
                        'registered_at' => date('Y-m-d H:i:s')
                    ];
                    
                    // Add new user to users array
                    $users[] = $newUser;
                    
                    // Write updated array back to JSON file
                    $jsonData = json_encode($users, JSON_PRETTY_PRINT);
                    if (file_put_contents($jsonFile, $jsonData) === false) {
                        throw new Exception("Unable to save user data.");
                    }
                    
                    // Set success message
                    $successMessage = "Registration successful! Welcome, " . htmlspecialchars($name) . "!";
                    
                    // Clear form fields
                    $name = "";
                    $email = "";
                }
                
            } catch (Exception $e) {
                $generalError = "An error occurred during registration: " . $e->getMessage();
            }
        }
    }
    ?>
    
    <div class="container">
        <h2>User Registration</h2>
        
        <?php if ($successMessage): ?>
            <div class="success">✓ <?php echo $successMessage; ?></div>
        <?php endif; ?>
        
        <?php if ($generalError): ?>
            <div class="general-error">✗ <?php echo htmlspecialchars($generalError); ?></div>
        <?php endif; ?>
        
        <form action="registration.php" method="post">
            <div class="field-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                <?php if (isset($errors['name'])): ?>
                    <span class="error">✗ <?php echo htmlspecialchars($errors['name']); ?></span>
                <?php endif; ?>
            </div>

            <div class="field-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <?php if (isset($errors['email'])): ?>
                    <span class="error">✗ <?php echo htmlspecialchars($errors['email']); ?></span>
                <?php endif; ?>
            </div>

            <div class="field-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                <?php if (isset($errors['password'])): ?>
                    <span class="error">✗ <?php echo htmlspecialchars($errors['password']); ?></span>
                <?php endif; ?>
                <small style="color: #666; font-size: 12px;">Min 8 chars, 1 uppercase, 1 lowercase, 1 number, 1 special character</small>
            </div>

            <div class="field-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password">
                <?php if (isset($errors['confirm_password'])): ?>
                    <span class="error">✗ <?php echo htmlspecialchars($errors['confirm_password']); ?></span>
                <?php endif; ?>
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
