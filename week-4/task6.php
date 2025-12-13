<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Info Preview</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 40px auto;
            background: #f9f9f9;
            padding: 24px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        h2 {
            color: #007bff;
        }

        form {
            margin-bottom: 24px;
        }

        input,
        select {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #aaa;
            width: 100%;
            margin-bottom: 16px;
        }

        button {
            padding: 8px 16px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            margin-bottom: 16px;
        }

        .preview {
            background: #e6f7ff;
            padding: 16px;
            border-radius: 6px;
            margin-top: 16px;
            font-size: 1.1em;
        }
    </style>
</head>

<body>
    <h2>Mini User Info Preview Form</h2>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php if (isset($_POST['name'])) echo htmlspecialchars($_POST['name']); ?>" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" value="<?php if (isset($_POST['age'])) echo htmlspecialchars($_POST['age']); ?>" required min="1" max="120">

        <label for="language">Favorite Programming Language:</label>
        <input type="text" id="language" name="language" value="<?php if (isset($_POST['language'])) echo htmlspecialchars($_POST['language']); ?>" required>

        <button type="submit">Preview</button>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php
        $name = trim($_POST["name"] ?? "");
        $age = trim($_POST["age"] ?? "");
        $language = trim($_POST["language"] ?? "");
        $error = "";
        $preview = "";
        if ($name === "" || $age === "" || $language === "") {
            $error = "All fields are required.";
        } elseif (!ctype_digit($age) || intval($age) < 1 || intval($age) > 120) {
            $error = "Please enter a valid age (1-120).";
        } elseif (!preg_match('/^[a-zA-Z ]+$/', $name)) {
            $error = "Name must contain only letters and spaces.";
        } else {
            $preview = "Hello, <strong>" . htmlspecialchars($name) . "</strong>! You are <strong>" . intval($age) . "</strong> years old and your favorite programming language is <strong>" . htmlspecialchars($language) . "</strong>.";
        }
        ?>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if ($preview): ?>
            <div class="preview"><?php echo $preview; ?></div>
        <?php endif; ?>
    <?php endif; ?>
</body>

</html>