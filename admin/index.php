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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banbros Inventory System</title>

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
        width: 1200px;
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
    .custom-btn {
    color: white;
    transition: background-color 0.3s ease; /* Smooth transition */
    }

    .custom-btn:hover {
    background-color:#4f7ad1; /* Color on hover */ /* Text color on hover */
    }
    
    h3, h5{
        text-align: center;
    }

    .footer {
        position: sticky;
        left: 0;
        bottom: -60px;
        width: 100%;
        background-color: red;
        color: white;
        text-align: center;
    }
</style>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css">
</head>

<body>
<nav class="navbar navbar" style="background-color: #338FBB;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header-dark">
      <a class="navbar-brand" href="index.php"><img src="https://www.banbros.ph/assets/img/logowhite.png" style="width: 100px;" alt="Inventory System"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php if($_SESSION['role'] == 'admin'){ ?>
        <!-- <li class="active"><a href="#">Dashboard <span class="sr-only">(current)</span></a></li> -->
        <li><a href="#add" data-toggle="modal" class="btn custom-btn"><span class="fa fa-plus" style="color:white;" ></span> Add New</a></li>
        <?php } ?>
        <?php if($_SESSION['role'] == 'admin'){ ?>
        <li><a href="archive_data.php" class="btn custom-btn"><span class="fa fa-archive" style="color:white;"></span> Archive</a></li>
        <?php } ?>
        <li><a href="export_excelfile.php?export" data-toggle="modal" class="btn custom-btn"><span class="fa fa-file-excel" style="color:white;"></span> Export</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="btn custom-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><span class="glyphicon glyphicon-user" style="color:#073595;"></span> <?=$user['name'];?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><span class="fa fa-sign-out" style="color:#073595;"></span> Log Out</a></li>
            <!-- <li><a href="#"><span class="fa fa-user" style="color:#073595;"></span> Profile</a></li> -->
            <li role="separator" class="divider"></li>
            <li><a href="change_password.php"><span class="fa fa-key" style="color:#073595;"></span> Change Password</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="panel panel">
    <div class="panel-heading" style="color:white;background:#99C7DD;padding:1px"><h3>Banbros Property List</h3></div>
    <?php
        // Start of PHP code
        if(isset($_SESSION['admin']) && $_SESSION['role'] == 'admin'){
            // Admin can manage the list
            // Display the list with edit and delete options
            $display_edit_delete = true;
        }else{
            // User can only view the list
            // Display the list without edit and delete options
            $display_edit_delete = false;
        }
        // End of PHP code
    ?>
        <div class="panel-body">
            <div class="container">
                <?php
                    if(isset($_SESSION['success'])){
                        echo "<div style='background:green; color:#fff; padding:3px; border-radius:25px; font-size:15px; text-align:center;'>".$_SESSION['success']."</div>";
                        unset($_SESSION['success']);
                    }
                    if(isset($_SESSION['error'])){
                        echo "<div style='background:red; color:#fff; padding:3px; border-radius:25px; font-size:15px; text-align:center;'>".$_SESSION['error']."</div>";
                        unset($_SESSION['error']);
                    }
                ?>
            </div> 
                <table class="table table-bordered" id="example" width="100%">
                    <thead>
                        <tr>
                            <th>Company Code</th>
                            <th>Assigned to / Device</th>
                            <th>Location</th>
                            <th>Model Description</th>
                            <th>Serial Number</th>
                            <th>Added at</th>
                            <?php if($_SESSION['role'] == 'admin'){ ?>
                            <th style="text-align:right">Action</th>
                            <?php } ?>
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
                                <td><?=$row['company_code']?></td>
                                <td><?=$row['assigned_to']?></td>
                                <td><?=$row['location_n']?></td>
                                <td><?=$row['model_description']?></td>
                                <td><?=$row['serial_number']?></td>
                                <td><?=$row['added_at']?></td>
                                <?php if($_SESSION['role'] == 'admin'){ ?>
                                <td align="right">
                                    <a href="edit.php?edit=<?=$row['ID']; ?>" class="btn btn-success"><span class="fa fa-edit"></span></a>
                                    <a href="delete.php?delete=<?=$row['ID']; ?>" class="btn btn-danger"><span class="fa fa-trash"></span></a>
                                    <a href="archive.php?archive=<?=$row['ID']; ?>" class="btn btn-danger"><span class="fa fa-archive"></span></a>
                                    <a href="#" class="btn btn-danger"><span class="fa fa-print"></span></a>
                                </td>
                                <?php } ?>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
<br><br>
<div class="footer">
    <div class="panel-heading" style="color:white;background:#338FBB;"><h5>Made by: <a href="https://github.com/raldish" style="color:#e399a5;"><i class="fa fa-github" style="font-size:35px;color:white"></i>Jayrald Pelegrino</a></h5></div></div>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>
            new DataTable('#example', {
                fixedHeader: true,
                responsive: true
            });
            </script>
        <?php
        include "modal_addnew.php";
        ?>
</body>
</html>
