<?php
session_start(); // Start the session

// Destroy the session to log out the user
session_destroy();

// Redirect to the index page
header("Location: 230101032-index.php");
exit(); // Ensure no further code is executed
?>