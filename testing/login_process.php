<?php
session_start();
require_once 'db_connection.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password (use password_hash when registering)
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Retrieve user data from the database based on the provided email
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the provided password against the hashed password in the database
        if (password_verify($password, $row['password'])) {
            // Password is correct; create a session for the user
            $_SESSION['user_id'] = $row['id'];
            header("Location: dashboard.php"); // Redirect to a dashboard or protected page
            exit();
        } else {
            echo "Invalid password. <a href='login.php'>Try again</a>";
        }
    } else {
        echo "User not found. <a href='login.php'>Try again</a>";
    }
} else {
    echo "Invalid request.";
}
?>
