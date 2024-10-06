<?php
    include "connection.php";

    if(isset($_POST['submit'])){
        $id = $_POST['ID'];
        $company_code = $_POST['company_code'];
        $assigned_to = $_POST['assigned_to'];
        $location_n = $_POST['location_n'];
        $model_description = $_POST['model_description'];
        $serial_number = $_POST['serial_number'];

        $sql ="UPDATE client SET company_code='$company_code', assigned_to='$assigned_to', location_n='$location_n', model_description='$model_description', serial_number='$serial_number' WHERE ID='$id'";
        
        if($conn->query($sql)){
            $_SESSION['success'] = "Record has been updated successfully";
        }else
            $_SESSION['error'] = "Something went wrong while updating record";
        }
    header('location: index.php');
?>