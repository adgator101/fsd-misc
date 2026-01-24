<?php
session_start();

require 'session.php';
require 'db.php';

$user_email = '';

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: dashboard.php');
    exit;
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
    if ($user) {
        $user_email = $user['email'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>

    <h1>Welcome to my site</h1>
    <?php if ($user_email): ?>
        <p>Logged In User : <?php echo htmlspecialchars($user_email); ?></p>
        <form method="get" action="dashboard.php">
            <button type="submit" name="logout" value="1">Logout</button>
        </form>
    <?php else: ?>
        <a href="login.php"><button>Login</button></a>
    <?php endif; ?>

</body>

</html>