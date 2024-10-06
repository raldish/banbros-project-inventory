<?php

    $host ="localhost";
    $user ="root";
    $password ="";

    try{
        $conn = new PDO("mysql:host=$host;dbname=crud_db", $user, $password);
    } catch (\Throwable $th) {
        echo "<br>" .$th->getMessage();
    }

    if(isset($_GET['export'])){
        $output = "";
        $output .="
            <table border='1';'>
            <tr>
                <th>ID</th>
                <th stlye='color:#1385d4;'>Company Code</th>
                <th>Assigned To</th>
                <th>Location</th>
                <th>Model Description</th>
                <th>Serial Number</th>
            </tr>
        ";

        $sql =" SELECT * FROM client";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $key=>$value){
            $output .='
                <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value['company_code'].'</td>
                    <td>'.$value['assigned_to'].'</td>
                    <td>'.$value['location_n'].'</td>
                    <td>'.$value['model_description'].'</td>
                    <td>'.$value['serial_number'].'</td>
                </tr>
            ';
    }

    $output .='</table>';
    $filename = "exported_record-".date('Y-m-d').".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$filename");

    echo $output;
}

?>