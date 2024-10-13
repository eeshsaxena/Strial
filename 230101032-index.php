<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="230101032-styles.css">
    <title>Welcome to Visiting Card App</title>
</head>
<body>
    <h1>Welcome to the Visiting Card Design App</h1>
    <?php if (isset($_SESSION['username'])): ?>
        <p>Hello, <?php echo $_SESSION['username']; ?>! <a href="230101032-design_card.php">Design your card</a></p>
        <a href="230101032-logout.php">Logout</a>
    <?php else: ?>
        <p><a href="230101032-register.php">Register</a> | <a href="230101032-login.php">Login</a></p>
    <?php endif; ?>
</body>
</html>