<?php
    require_once ("connection.php");

    $return ='';
    if(isset($_POST['query'])){
        $search = mysqli_real_escape_string($conn, $_POST['query']);
        $query ="SELECT * FROM client
        WHERE ID LIKE '%".$search."%'
        OR serial_number LIKE '%".$search."%'
        OR company_code LIKE '%".$search."%'
        OR assigned_to LIKE '%".$search."%'
        OR location_n LIKE '%".$search."%'
        OR model_description LIKE '%".$search."%'
        OR added_at LIKE '%".$search."%'
        ";
    }else{
        $query ="SELECT * FROM client";
    }

    $result =mysqli_query($conn, $query);

    if(mysqli_num_rows($result)>0){
        $return .='
            <table border="1" width="100%" id="table">
            <tr style="background:gray;color:#fff;font-size:10pt">
                <th align="left">ID</th>
                <th align="left">Company Code</th>
                <th align="left">Assigned To</th>
                <th align="left">Location</th>
                <th align="left">Model Description</th>
                <th align="left">Serial Number</th>
                <th align="left">Added_at</th>
                <th align="right">Action</th>
                <th width="20">All<input type="checkbox" id="checkAll"></th>
            </tr>';

            while($row = mysqli_fetch_array($result)){
                $return .='
                <tr>
                    <td>'.$row['ID'].'</td>
                    <td>'.$row['company_code'].'</td>
                    <td>'.$row['assigned_to'].'</td>
                    <td>'.$row['location_n'].'</td>
                    <td>'.$row['model_description'].'</td>
                    <td>'.$row['serial_number'].'</td>
                    <td>'.$row['added_at'].'</td>
                    <td align="right">
                        <a href="edit.php?edit='.$row['ID'].'"><span class="fa fa-edit></span></a>
                        <a href="delete.php?delete='.$row['ID'].'"><span class="fa fa-trash></span></a>
                    </td>
                    <td align="right"><input type="checkbox" name="check[]" value="'.$row['ID'].'"></td>
                </tr>
                ';
            }
            '</table>';
            echo $return;
    }else{ 
        echo '<div style="text-align: center;">
        <span style="background:red; color:#fff; padding:3px; border-radius:25px; font-size:20px;">Record Not Found</span>
        </div>';
    }
?>

<script>
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked',this.checked);
    });
</script>