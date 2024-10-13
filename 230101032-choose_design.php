<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: 230101032-login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="230101032-styles.css">
    <title>Choose Card Design</title>
</head>
<body>
    <h2>Choose a design for your visiting card:</h2>
    <form action="230101032-preview_card.php" method="GET">
        <div class="designs">
            <div>
                <input type="radio" id="design1" name="design" value="1" required>
                <label for="design1"><img src="230101032-format1.png" alt="Design 1"></label>
            </div>
            <div>
                <input type="radio" id="design2" name="design" value="2" required>
                <label for="design2"><img src="230101032-format2.png" alt="Design 2"></label>
            </div>
            <div>
                <input type="radio" id="design3" name="design" value="3" required>
                <label for="design3"><img src="230101032-format3.png" alt="Design 3"></label>
            </div>
            <div>
                <input type="radio" id="design4" name="design" value="4" required>
                <label for="design4"><img src="230101032-format4.png" alt="Design 4"></label>
            </div>
        </div>
        
        <label for="bgcolor">Choose Background Color:</label>
        <input type="color" id="bgcolor" name="bgcolor" value="#ffffff">

        <label for="textcolor">Choose Text Color:</label>
        <input type="color" id="textcolor" name="textcolor" value="#000000">

        <button type="submit">Preview Card</button>
    </form>
    <style>
        .designs {
            display: flex;
            justify-content: space-around;
        }
        img {
            width: 100px; 
            height: auto;
            border: 2px solid #ccc;
            margin: 10px;
        }
    </style>
</body>
</html>