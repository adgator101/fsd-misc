<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student - Portfolio Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            padding: 10px;
            background-color: #ffe6e6;
            border-radius: 5px;
            margin: 10px 0;
        }
        .success {
            color: green;
            padding: 10px;
            background-color: #e6ffe6;
            border-radius: 5px;
            margin: 10px 0;
        }
        .back-link {
            display: inline-block;
            margin: 10px 0;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    require '../header.php';
    require 'utils.php';
    ?>

    <h2>Add Student Information</h2>
    <a href="index.php" class="back-link">← Back to Home</a>

    <div class="form-container">
        <form method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required 
                       value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required 
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="skills">Skills (comma-separated):</label>
                <input type="text" name="skills" id="skills" required 
                       placeholder="e.g., PHP, JavaScript, MySQL"
                       value="<?php echo isset($_POST['skills']) ? htmlspecialchars($_POST['skills']) : ''; ?>">
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            // Get form data
            $name = $_POST["name"] ?? '';
            $email = $_POST["email"] ?? '';
            $skills = $_POST["skills"] ?? '';
            
            // Validate inputs
            if (empty($name)) {
                throw new Exception("Please enter a name");
            }
            
            if (empty($email)) {
                throw new Exception("Please enter an email address");
            }
            
            if (empty($skills)) {
                throw new Exception("Please enter at least one skill");
            }
            
            // Use custom validation function
            if (!validateEmail($email)) {
                throw new Exception("Invalid email format");
            }
            
            // Format name using custom function
            $formattedName = formatName($name);
            
            // Clean and process skills using custom function
            $skillsArray = cleanSkills($skills);
            
            if (empty($skillsArray)) {
                throw new Exception("Please enter at least one valid skill");
            }
            
            // Save student using custom function
            saveStudent($formattedName, $email, $skillsArray);
            
            echo '<div class="success">';
            echo '<strong>Success!</strong> Student information saved successfully.<br>';
            echo 'Name: ' . htmlspecialchars($formattedName) . '<br>';
            echo 'Email: ' . htmlspecialchars($email) . '<br>';
            echo 'Skills: ' . htmlspecialchars(implode(', ', $skillsArray));
            echo '</div>';
            
        } catch (Exception $e) {
            echo '<div class="error">';
            echo '<strong>Error:</strong> ' . htmlspecialchars($e->getMessage());
            echo '</div>';
        }
    }
    ?>

    <?php
    require '../footer.php';
    ?>
</body>

</html>