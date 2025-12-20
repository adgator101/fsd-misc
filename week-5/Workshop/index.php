<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portfolio Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .welcome {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .links-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 30px 0;
        }
        .button-group {
            display: flex;
            gap: 20px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button a {
            color: white;
            text-decoration: none;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    require '../header.php';
    ?>
    
    <div class="welcome">
        <h2>Welcome to Student Portfolio Manager</h2>
        <p>This application helps you manage student information and portfolio files efficiently.</p>
        <p>Use the links below to add student information, upload portfolio files, or view existing student records.</p>
    </div>

    <div class="links-container">
        <h3>Available Actions:</h3>
        <div class="button-group">
            <button>
                <a href="add_student.php">Add Student Info</a>
            </button>
            <button>
                <a href="upload.php">Upload Portfolio File</a>
            </button>
            <button>
                <a href="students.php">View Students</a>
            </button>
        </div>
    </div>
    
    <?php
    require '../footer.php';
    ?>
</body>

</html>