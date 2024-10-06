<?php
    include "connection.php";

    $id= $_GET['delete'];

    $sql ="DELETE FROM client WHERE ID='$id'"; 

        if($conn->query($sql)){
            $_SESSION['success'] = "Record has been deleted successfully";
        }else{
            $_SESSION['error'] = "Something went wrong while deleting record";
        }
    header("location: index.php");
?>