<?php
    // session_start();
    include ("connection.php");

    if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
        header("location:../index.php");
    }

    $sql = "SELECT * FROM user WHERE ID = '".$_SESSION['admin']."'";
    $query = $conn->query($sql);
    $user = $query->fetch_assoc();
?>

<style>
    body{
        background-attachment: fixed;
        background-color: #eee;
        font-family:arial;
    }
    /* p{
        font-size: 10pt;
    } */
    #divheader{
        margin:auto;
        width: 1000px;
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
        background: #e4eaf6;
    }
    tr td{
        padding: 5px;
        font-size: 10px;
    }
    /* td{
        padding: 5px;
        font-size: 10px;
    } */
    #submit{
        padding: 10px;
        background:#2b9e4f;
        color: #fff;
        border-radius: 11px;
        border: none;
        cursor: pointer;
        width: 100%;
    }
    #submit:hover{
        background:#27ae80;
    }
    #delete{
        padding: 8px;
        background: #d63031;
        color: #fff;
        border-radius: 3px;
        border:none;
        cursor: pointer;
        /* width: 100%; */
    }
    #delete:hover{
        background: #EA2027;
    }
    #export{
        padding: 8px;
        background: #a9adb5;
        color: #fff;
        border-radius: 3px;
        border:none;
        cursor: pointer;
        text-decoration: none;
        width: 100%;
    }
    #export:hover{
        background: green;
    }
    
    /* h1{
        text-align: center;
        background: #2222b1;
        border-radius: 20x;
    } */
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
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css">
</head>

<body>
    <!-------LOGOUT--------->
    WELCOME Admin: <?=$user['name'];?> | <a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Log Out</a>
    <div id="divheader">

        <form action="insert.php" method="post">
            <table width="100%" class="table border">
                <tr>
                    <th align="left" style="text-align: center;">BANBROS PROPERTIES INVENTORY SYSTEM</th>
                </tr>
                <tr>
                    <td>Company Code<input type="text" name="company_code" placeholder="Company Code" required></td>
                </tr>
                <tr>
                    <td>Assigned To<input type="text" name="assigned_to" placeholder="Name of the assignee" required></td>
                </tr>
                <tr>
                    <td>
                    <label for="location_n">Location</label>
                    <select name="location_n">
                    <option value="#">Select Department</option>
                    <option value="accounting">Accounting</option>
                    <option value="marketing">Marketing</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>Model Description<input type="text" name="model_description" placeholder="Model Description" required></td>
                </tr>
                <tr>
                    <td>Serial Number<input type="text" name="serial_number" placeholder="NXE*********" required></td>
                </tr>
                <tr>
                    <td><button type="submit" id="submit" class="submit" name="submit"><span class="fa fa-save"></span> SUBMIT</button></td>
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
        </div> 
        <br>
        <div id="divheader">
            <!-- <table width="100%">
                <tr>
                    <th align ="left"><p>SEARCH HERE</p></th>
                </tr>
                <tr>
                    <th><input type="text" name="search" id="search" placeholder="Search Record Here"></th>
                </tr>
            </table> -->

                <table class="table table-bordered table-stripped" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Company Code</th>
                            <th>Assigned To</th>
                            <th>Location</th>
                            <th>Model Description</th>
                            <th>Serial Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM client ORDER BY company_code ASC";
                            $query= $conn->query($sql); 
                            $count =1;
                            while($row = $query->fetch_assoc()){
                        ?>
                            <tr>
                                <td><?=$count++;?></td>
                                <td><?=$row['company_code']?></td>
                                <td><?=$row['assigned_to']?></td>
                                <td><?=$row['location_n']?></td>
                                <td><?=$row['model_description']?></td>
                                <td><?=$row['serial_number']?></td>
                                <td align="right">
                                    <a href="edit.php?edit=<?=$row['ID']; ?>" class="btn btn-success"><span class="fa fa-edit"></span></a>
                                    <a href="delete.php?delete=<?=$row['ID']; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>

        <!-- <form action="deleteAll.php" method="post">
            <table width="100%" border="0">
                <tr>
                    <th align="left"><h1>LIST OF RECORDS</h1></th>
                    <th align="right">
                        <a id="export" href="export_excelfile.php?export" style="width:100px;height:30px 30px"><span class="fa fa-file-excel"></span> EXPORT TO EXCEL FILE</a>
                        <button style="width:100px;height:30px 30px" type="submit" name="deleteAll" id="delete"><span class="fa fa-trash"></span> DELETE</button>
                    </th>
                </tr>
                <tr>
                <th colspan="3"><div id="result"></div></th>
                </tr>
            </table>
        </form> -->

        <!-- <script>
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
        </script> -->
    </div>
            <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
            <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
            <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
            <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.dataTables.js"></script>
            <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
            <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>
            <script>
                new DataTable('#example', {
                    fixedHeader: true,
                    responsive: true
                });
            </script>
    </body>
</html>