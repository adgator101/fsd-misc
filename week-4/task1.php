<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Info</title>
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

        p {
            font-size: 1.2em;
        }
    </style>
</head>

<body>
    <h2>Info</h2>
    <p><strong>Your name:</strong>
        <?php $name = "Aaditya Thapa";
        echo htmlspecialchars($name); ?>
    </p>
    <p><strong>Today's date:</strong> <?php echo htmlspecialchars(date("l, F j, Y")); ?></p>
    <p><strong>It is currently:</strong>
        <?php
        $hour = date("G");
        if ($hour < 12) {
            echo "morning";
        } elseif ($hour < 18) {
            echo "afternoon";
        } else {
            echo "evening";
        }
        ?></p>
</body>

</html>