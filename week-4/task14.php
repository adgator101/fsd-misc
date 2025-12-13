<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Convert Array to JSON</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; background: #f9f9f9; padding: 24px; border-radius: 8px; border: 1px solid #ccc; }
        h2 { color: #007bff; }
        .json-output { background: #2d2d2d; color: #f8f8f2; padding: 16px; border-radius: 4px; font-family: 'Courier New', monospace; overflow-x: auto; }
        .array-display { background: #fff; padding: 12px; border-radius: 4px; margin-bottom: 16px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h2>Convert Array to JSON (But Do Not Save It)</h2>
    
    <?php
    $data = [
        "username" => "student123",
        "role" => "learner",
        "active" => true
    ];
    
    $jsonString = json_encode($data, JSON_PRETTY_PRINT);
    ?>
    
    <h3>Original Array:</h3>
    <div class="array-display">
        <pre><?php print_r($data); ?></pre>
    </div>

    <h3>Converted to JSON:</h3>
    <div class="json-output">
        <pre><?php echo htmlspecialchars($jsonString); ?></pre>
    </div>
</body>
</html>
