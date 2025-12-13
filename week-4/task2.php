
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Temperature Decision Program</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 40px auto;
            background: #f9f9f9;
            padding: 24px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        h2 {
            color: #007bff;
        }
        p {
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <h2>Temperature Decision Program</h2>
    <p><strong>Temperature:</strong> <?php $temp = 33; echo $temp; ?>°C</p>
    <p><strong>Decision:</strong> <?php
        if ($temp < 15) {
            echo "Cold";
        } elseif ($temp <= 30) {
            echo "Warm";
        } else {
            echo "Hot";
        }
    ?></p>
</body>
</html>
