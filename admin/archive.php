<?php
    require_once ('connection.php');

    $id = $_REQUEST['id'];

    $query = "INSERT INTO tbl_archive (ID, company_code, assigned_to, location_n, model_description, serial_number) 
    SELECT id, company_code, assigned_to, location_n, model_description, serial_number FROM client WHERE id = $id";

    if(mysqli_query($conn, $query)){
        $query = "DELETE FROM client WHERE id = $id";
        if(mysqli_query($conn, $query)){
            echo "<script>window.location.href = 'index&success=1';</script>";
        }
        else{
            echo "<script>window.location.href = 'index&error=1';</script>";
        }
    }

    else{
        echo "<script>window.location.href = 'index&error=1'</script>";
    }
?>