<?php
session_start();
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
                header("location:admin/index.php");
            }
        }else {
            $_SESSION['error'] = "Incorrect password";
            header("location:index.php");
        }
    } else {
        $_SESSION['error'] = "Incorrect username or password";
        header("location:index.php");
    }
?>