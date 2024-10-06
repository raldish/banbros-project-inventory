<?php
    // session_start();
    include ("connection.php");
?>

<style>
    body{
        background-attachment: fixed;
        background-color: #eee;
        font-family:arial;
    }
    p{
        font-size: 10pt;
    }
    #divheader{
        margin:auto;
        width: 650px;
        border-radius: 3px;
        padding: 10px;
        background: #fff;
        font-size: 10px;
    }
    input[type=text]{
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        -webkit-transition: 0.5s;
        transition: 0.5s;
        outline: none;
        border-radius: 3px;
    }
    input[type=text]:focus{
        border: 1px solid green;
        border-radius: 3px;
    }
    .table{
        border-collapse:collapse;
        padding: 5px;
        font-size: 10pt;
    }
    tr{
        padding: 5px;
        font-size: 10px;
    }
    td{
        padding: 5px;
        font-size: 10px;
    }
    #submit{
        padding: 10px;
        background:#2b9e4f;
        color: #fff;
        border-radius: 11px;
        border: none;
        cursor: pointer;
        width: 312%;
    }
    #submit:hover{
        background:#27ae80;
    }
    #delete{
        padding: 10px;
        background: #d63031;
        color: #fff;
        border-radius: 3px;
        border:none;
        cursor: pointer;
        width: 100%;
    }
    #delete:hover{
        background: #EA2027;
    }
    #export{
        padding: 10px;
        background: #a9adb5;
        color: #fff;
        border-radius: 3px;
        border:none;
        cursor: pointer;
        width: 100%;
    }
    #export:hover{
        background: #6181ec;
    }
    
    h1{
        text-align: center;
        background: #2222b1;
        border-radius: 20x;
        color: #fff;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invventory System</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="divheader">
        <form action="insert.php" method="post">
            <table width="100%">
                <tr>
                    <h1>Banbros Properties Inventory System</h1>
                </tr>
                <tr>
                    <td>Company Code</td>
                    <td><input type="text" name="company_code" required></td>
                </tr>
                <tr>
                    <td>Assigned To</td>
                    <td><input type="text" name="assigned_to" required></td>
                </tr>
                <tr>
                    <td><label for="location_n">Location</label></td>
                    <td>
                    <select name="location_n">
                    <option value="#">Select Department</option>
                    <option value="accounting">Accounting</option>
                    <option value="marketing">Marketing</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>Model Description</td>
                    <td><input type="text" name="model_description" required></td>
                </tr>
                <tr>
                    <td>Serial Number</td>
                    <td><input type="text" name="serial_number" required></td>
                </tr>
                <tr>
                    <td><button type="submit" id="submit" name="submit"><i class="fa fa-save"></i> SUBMIT</button></td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_SESSION['success'])){
                echo "<div style='background:green; color:#fff; padding:3px; border-radius:25px; font-size:20px; text-align:center;'>".$_SESSION['success']."</div>";
                unset($_SESSION['success']);
            }
            if(isset($_SESSION['error'])){
                echo "<div style='background:red; color:#fff; padding:3px; border-radius:25px; font-size:20px; text-align:center;'>".$_SESSION['error']."</div>";
                unset($_SESSION['error']);
            }
        ?>
        <br>
        <p>SEARCH HERE</p>
        <input type="text" name="search" id="search" placeholder="Search Record Here">
        <form action="deleteAll.php" method="post">
            <h1>LIST OF RECORDS</h1>
            <button style="width:100px;height:30px 30px" type="submit" name="deleteAll" id="delete"><span class="fa fa-trash"></span> DELETE</button> <a href="export_excelfile.php?export" style="width:100px;height:30px 30px" id="export">EXPORT TO EXCEL FILE</a>
            <br>   
            <br> 
        <div id="result"></div>
        </form>
        <script>
            $(document).ready(function(){
                load_data();
                function load_data(query){
                    $.ajax({
                        url:"search.php",
                        method:"POST",
                        data:{query:query},
                        success:function(data){
                            $('#result').html(data);
                        }
                    });
                }

                $('#search').keyup(function(){
                    var search = $(this).val();
                    if(search !=''){
                        load_data(search);
                    }else{
                        load_data();
                    }
                }); 
            });
        </script>
    </div>
</body>
</html>