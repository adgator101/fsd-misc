<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students - Portfolio Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #007bff;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .skill-tag {
            display: inline-block;
            background-color: #e7f3ff;
            padding: 3px 8px;
            margin: 2px;
            border-radius: 3px;
            font-size: 0.9em;
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

        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
        }
    </style>
</head>

<body>
    <?php
    require '../header.php';
    ?>

    <h2>Student Records</h2>
    <a href="index.php" class="back-link">← Back to Home</a>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Skills</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $filename = "students.txt";

                // Check if file exists
                if (!file_exists($filename)) {
                    echo '<tr><td colspan="3" class="no-data">No student records found. Add students to get started.</td></tr>';
                } else {
                    $logFile = fopen($filename, "r");

                    if (!$logFile) {
                        throw new Exception("Unable to open file");
                    }

                    $hasData = false;

                    while (!feof($logFile)) {
                        $line = fgets($logFile);

                        // Skip empty lines
                        if (trim($line) === '') {
                            continue;
                        }

                        // Split by pipe delimiter
                        $lineArray = explode("|", $line);

                        if (count($lineArray) >= 3) {
                            $hasData = true;
                            $name = trim($lineArray[0]);
                            $email = trim($lineArray[1]);
                            $skillsString = trim($lineArray[2]);

                            // Convert skills string to array
                            $skillsArray = array_map('trim', explode(',', $skillsString));

                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($name) . '</td>';
                            echo '<td>' . htmlspecialchars($email) . '</td>';
                            echo '<td>';

                            // Display skills as tags
                            foreach ($skillsArray as $skill) {
                                if (!empty($skill)) {
                                    echo '<span class="skill-tag">' . htmlspecialchars($skill) . '</span>';
                                }
                            }

                            echo '</td>';
                            echo '</tr>';
                        }
                    }

                    fclose($logFile);

                    if (!$hasData) {
                        echo '<tr><td colspan="3" class="no-data">No student records found. Add students to get started.</td></tr>';
                    }
                }
            } catch (Exception $e) {
                echo '<tr><td colspan="3" class="no-data" style="color: red;">Error: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
            }
            ?>
        </tbody>
    </table>

    <?php
    require '../footer.php';
    ?>
</body>

</html>