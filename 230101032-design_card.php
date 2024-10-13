<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: 230101032-login.php");
    exit();
}

include '230101032-db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $organization = $_POST['organization'];
    $logo = $_FILES['logo']['name'];
    move_uploaded_file($_FILES['logo']['tmp_name'], "images/$logo");

    $db = getDBConnection();
    $stmt = $db->prepare("INSERT INTO cards (username, name, designation, email, mobile, organization, logo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindValue(1, $_SESSION['username']);
    $stmt->bindValue(2, $name);
    $stmt->bindValue(3, $designation);
    $stmt->bindValue(4, $email);
    $stmt->bindValue(5, $mobile);
    $stmt->bindValue(6, $organization);
    $stmt->bindValue(7, $logo);
    $stmt->execute();

    header("Location: 230101032-choose_design.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="230101032-styles.css">
    <title>Design Your Card</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="text" name="designation" placeholder="Designation" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="mobile" placeholder="Mobile Number" required>
        <input type="text" name="organization" placeholder="Organization" required>
        <input type="file" name="logo" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>