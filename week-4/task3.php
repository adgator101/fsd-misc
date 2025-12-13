<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Multiplication Table Generator</title>
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

        input[type="number"] {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #aaa;
            width: 100px;
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

        table {
            margin-top: 16px;
            border-collapse: collapse;
            width: 100%;
        }

        td {
            padding: 8px;
            border: 1px solid #aaa;
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Multiplication Table Generator</h2>
    <form method="post" action="">
        <label for="number">Enter a number:</label>
        <input type="number" id="number" name="number" required min="1">
        <button type="submit">Generate Table</button>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["number"])): ?>
        <?php $number = intval($_POST["number"]); ?>
        <h3>Multiplication Table for <?php echo $number; ?></h3>
        <table border='1' cellpadding='8' style='margin:auto;'>
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <tr>
                    <td><?php echo $number . " × " . $i; ?></td>
                    <td><?php echo $number * $i; ?></td>
                </tr>
            <?php endfor; ?>
        </table>
    <?php endif; ?>
</body>

</html>