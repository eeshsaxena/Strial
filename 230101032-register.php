<?php
include '230101032-db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $db = getDBConnection();

    // Check if username already exists
    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bindValue(1, $username);
    $result = $stmt->execute();

    if ($result->fetchArray(SQLITE3_ASSOC)) {
        echo "Username already taken. Please choose another one.";
    } else {
        // Proceed with registration
        $stmt = $db->prepare("INSERT INTO users (username, name, password, email) VALUES (?, ?, ?, ?)");
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $name);
        $stmt->bindValue(3, password_hash($password, PASSWORD_DEFAULT)); // Hashing the password
        $stmt->bindValue(4, $email);
        
        if ($stmt->execute()) {
            header("Location: 230101032-index.php");
            exit();
        } else {
            echo "Registration failed.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="230101032-styles.css">
    <title>Register</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Register</button>
    </form>
    <a href="230101032-login.php">Already have an account? Login here</a>
</body>
</html>