<?php
    include "connection.php";

    if(isset($_POST['submit'])){
        $company_code = $_POST['company_code'];
        $assigned_to = $_POST['assigned_to'];
        $location_n = $_POST['location_n'];
        $model_description = $_POST['model_description'];
        $serial_number = $_POST['serial_number'];

        $sql = "SELECT * FROM client WHERE assigned_to = '$assigned_to'";
        $query = $conn->query($sql);

        if($query->num_rows > 0){
            $_SESSION['error'] = "Record already exists";
        }else{
            $sql = "INSERT INTO client (company_code, assigned_to, location_n, model_description, serial_number) 
            VALUES ('$company_code', '$assigned_to', '$location_n', '$model_description', '$serial_number')";
            if($conn->query($sql)){
                $_SESSION['success'] = "Record has been inserted successfully";
            }else{
                $_SESSION['error'] = "Something went wrong while inserting record";
            }
        }
    }
        
    header('location: index.php');
?>

