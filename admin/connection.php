<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "crud_db");

    if(!$conn){
        die("Error: Failed to connect to database!");
    }
?>