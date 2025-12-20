<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Portfolio - Portfolio Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .upload-container {
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

        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
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

        .info {
            background-color: #e7f3ff;
            padding: 10px;
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

    <h2>Upload Portfolio File</h2>
    <a href="index.php" class="back-link">← Back to Home</a>

    <div class="info">
        <strong>Requirements:</strong>
        <ul>
            <li>Accepted formats: PDF, JPG, PNG</li>
            <li>Maximum file size: 2MB</li>
            <li>Files will be renamed automatically for security</li>
        </ul>
    </div>

    <div class="upload-container">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Choose Portfolio File:</label>
                <input type="file" name="file" id="file"
                    accept=".pdf,.jpg,.jpeg,.png,application/pdf,image/jpeg,image/png" required>
            </div>

            <button type="submit">Upload File</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            // Debug: Show what's in $_FILES
            if (empty($_FILES)) {
                throw new Exception("No file data received. Check that form has enctype='multipart/form-data'");
            }

            // Check if file was uploaded
            if (!isset($_FILES["file"])) {
                throw new Exception("File field not found. Available fields: " . implode(", ", array_keys($_FILES)));
            }

            if ($_FILES["file"]["error"] === UPLOAD_ERR_NO_FILE) {
                throw new Exception("Please select a file to upload");
            }

            // Use custom upload function with error handling
            $result = uploadPortfolioFile($_FILES["file"]);

            echo '<div class="success">';
            echo '<strong>Success!</strong><br>';
            echo htmlspecialchars($result);
            echo '</div>';
        } catch (Exception $e) {
            echo '<div class="error">';
            echo '<strong>Upload Failed:</strong><br>';
            echo htmlspecialchars($e->getMessage());
            echo '</div>';
        }
    }
    ?>

    <?php
    require '../footer.php';
    ?>
</body>

</html>