<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Calculator Using Switch Case</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; background: #f9f9f9; padding: 24px; border-radius: 8px; border: 1px solid #ccc; }
        h2 { color: #007bff; }
        form { margin-bottom: 24px; }
        input[type="number"], select { padding: 8px; border-radius: 4px; border: 1px solid #aaa; width: 100%; margin-bottom: 16px; }
        button { padding: 8px 16px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .result { background: #e6f7ff; padding: 16px; border-radius: 6px; margin-top: 16px; font-size: 1.2em; }
        .error { color: red; margin-bottom: 16px; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Simple Calculator Using Switch Case</h2>
    <form method="post" action="">
        <label for="num1">Number 1:</label>
        <input type="number" id="num1" name="num1" step="any" value="<?php if (isset($_POST['num1'])) echo htmlspecialchars($_POST['num1']); ?>" required>

        <label for="num2">Number 2:</label>
        <input type="number" id="num2" name="num2" step="any" value="<?php if (isset($_POST['num2'])) echo htmlspecialchars($_POST['num2']); ?>" required>

        <label for="operation">Operation:</label>
        <select id="operation" name="operation">
            <option value="add" <?php if (isset($_POST['operation']) && $_POST['operation'] == 'add') echo 'selected'; ?>>Add</option>
            <option value="subtract" <?php if (isset($_POST['operation']) && $_POST['operation'] == 'subtract') echo 'selected'; ?>>Subtract</option>
            <option value="multiply" <?php if (isset($_POST['operation']) && $_POST['operation'] == 'multiply') echo 'selected'; ?>>Multiply</option>
            <option value="divide" <?php if (isset($_POST['operation']) && $_POST['operation'] == 'divide') echo 'selected'; ?>>Divide</option>
        </select>

        <button type="submit">Calculate</button>
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php
        $num1 = floatval($_POST["num1"] ?? 0);
        $num2 = floatval($_POST["num2"] ?? 0);
        $operation = $_POST["operation"] ?? "";
        $result = 0;
        $error = "";
        
        switch ($operation) {
            case "add":
                $result = $num1 + $num2;
                $operator = "+";
                break;
            case "subtract":
                $result = $num1 - $num2;
                $operator = "-";
                break;
            case "multiply":
                $result = $num1 * $num2;
                $operator = "×";
                break;
            case "divide":
                if ($num2 == 0) {
                    $error = "Cannot divide by zero!";
                } else {
                    $result = $num1 / $num2;
                    $operator = "÷";
                }
                break;
            default:
                $error = "Invalid operation!";
        }
        
        if ($error) {
        ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php } else { ?>
            <div class="result">
                <strong>Result:</strong> <?php echo $num1 . " " . $operator . " " . $num2 . " = " . $result; ?>
            </div>
        <?php } ?>
    <?php endif; ?>
</body>
</html>
