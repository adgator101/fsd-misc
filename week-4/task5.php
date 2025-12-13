<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Count the Number of Vowels</title>
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
            width: 300px;
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
    <h2>Count the Number of Vowels</h2>
    <form method="post" action="">
        <label for="sentence">Enter a sentence:</label>
        <input type="text" id="sentence" name="sentence" required>
        <button type="submit">Count Vowels</button>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sentence"])): ?>
        <?php $sentence = $_POST["sentence"];
        $vowels = ['a', 'e', 'i', 'o', 'u'];
        $vowel_count = 0;
        $lower = strtolower($sentence);
        for ($i = 0; $i < strlen($lower); $i++) {
            if (in_array($lower[$i], $vowels)) {
                $vowel_count++;
            }
        } ?>
        <div class="result"><strong>Number of vowels:</strong> <?php echo $vowel_count; ?></div>
    <?php endif; ?>
</body>

</html>