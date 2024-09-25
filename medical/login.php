<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'medical_login_system');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user data from database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store user information in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            echo "Login successful! Welcome " . $user['username'];
            // Redirect to a protected page or dashboard
            header('Location: dashboard.php');
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with this email!";
    }
}
?>
