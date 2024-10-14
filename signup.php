<?php
// Connect to database
include "admin/connection.php";

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $confirm_password = $_POST["confirm_password"];

    // Check if passwords match
    if ($password != $confirm_password) {
        $_SESSION["error"] = "Passwords do not match";
        header("Location: index.php");
        exit;
    }

    // Check if username is taken
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION["error"] = "Username is already taken";
        header("Location: index.php");
        exit;
    }

    // // Hash password
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into database
    $query = "INSERT INTO user (username, password, name) VALUES ('$username', '$password', '$name')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // User successfully inserted into database
        $_SESSION['success'] = "You have successfully signed up!";
        header("Location: index.php");
        exit;
    } else {
        // Error inserting user into database
        $_SESSION['error'] = "Error inserting user into database";
        header("Location: index.php");
        exit;
    }

    // // Close connection
    // mysqli_close($conn);
}
?>