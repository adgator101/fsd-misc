<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reverse a String</title>
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

        input[type="text"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #aaa;
            width: 200px;
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

        .result {
            margin-top: 16px;
            font-size: 1.2em;
        }
    </style>
</head>

<body>
    <h2>Reverse a String Without Built-in Functions</h2>
    <form method="post" action="">
        <label for="word">Enter a word:</label>
        <input type="text" id="word" name="word" required>
        <button type="submit">Reverse</button>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["word"])): ?>
        <?php $input = $_POST["word"];
        $reversed_string = "";
        for ($i = strlen($input) - 1; $i >= 0; $i--) {
            $reversed_string .= $input[$i];
        } ?>
        <div class="result"><strong>Reversed:</strong> <?php echo htmlspecialchars($reversed_string); ?></div>
    <?php endif; ?>
</body>

</html>