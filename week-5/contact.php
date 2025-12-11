<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
</head>

<body>
    <h2>Contact Us</h2>
    <form method="post" action="">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" required></textarea><br><br>
        <input type="submit" value="Send">
    </form>

    <table>
        <th>
            <tr>
                <td>Name</td>
                <td>Email</td>
                <td>Message</td>
            </tr>
        </th>

        <tbody>
            <?php
            $logFile = fopen("contact_log.txt", "r");
            while (!feof($logFile)) {
                $line = fgets($logFile);
                $lineArray = explode(",", $line);

                echo "
                    <tr>
                        <td>" . htmlspecialchars($lineArray[0]) . "</td>
                        <td>" . htmlspecialchars($lineArray[1]) . "</td>
                        <td>" . htmlspecialchars($lineArray[2]) . "</td>
                    </tr>
                ";
            }
            ?>
        </tbody>
    </table>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars(trim($_POST["name"]));
        $email = htmlspecialchars(trim($_POST["email"]));
        $message = htmlspecialchars(trim($_POST["message"]));
        echo "<p>Thank you, $name! Your message has been received.</p>";
        $formattedString = "Name: $name,Email: $email,Message: $message,Timestamp: $currentTimestamp";
        logMessage($formattedString);
    }
    function logMessage($message)
    {
        $currentTimestamp = date("Y-m-d H:i:s");
        $messageWithTimestamp = $message . ", Timestamp: " . $currentTimestamp;
        $logFile = fopen("contact_log.txt", "a");
        fwrite($logFile, $messageWithTimestamp . "\n");
        fclose($logFile);
    }
    ?>
</body>

</html>