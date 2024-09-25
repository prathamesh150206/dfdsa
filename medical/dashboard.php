<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html'); // Redirect to login if not authenticated
    exit();
}

echo "Welcome to your dashboard, " . $_SESSION['username'];
?>

<a href="logout.php">Logout</a>
