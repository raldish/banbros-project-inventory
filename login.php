<?php
// session_start();
    include "admin/connection.php";

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE username = '$username'";
        $query = $conn->query($sql);
        
        if($query->num_rows > 0){
            $row = $query->fetch_assoc();
        
            if($password==$row['password']){
                $_SESSION['admin']= $row['ID'];
                $_SESSION['role'] = $row['role']; // Store the user's role in the session
                header("location:admin/index.php");
            }else {
                $_SESSION['error'] = "Username or password is incorrect. Please try again.";
                header("location:index.php");
            }
        }else {
            $_SESSION['error'] = "Username and password is incorrect. Please try again.";
            header("location:index.php");
        }
    } 
?>