<?php
    include("connection.php");

    if(isset($_POST['deleteAll'])){
        $checkbox =$_POST['check'];

        for($i=0;$i<count($checkbox);$i++){
            $del_id = $checkbox[$i];

            $sql = "DELETE FROM client WHERE ID = '".$del_id."'";   
            if($conn->query($sql)){
                $_SESSION['success'] = "Record has been deleted successfully";
            }else
                $_SESSION['error'] = $conn->error;
        }
    }
    header("Location: index.php");
?>