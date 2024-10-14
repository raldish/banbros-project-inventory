

<!-- Modal window to display archived data -->
<div id="archiveModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Archived Data</h4>
      </div>
    </div>
  </div>
</div>


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
    <title>Inventory System</title>

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
        position: absolute;
        left: 0;
        bottom: -279px;
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
        <!-- <li class="active"><a href="#">Dashboard <span class="sr-only">(current)</span></a></li> -->
        <li><a href="index.php" class="btn custom-btn"><span class="fa fa-home" style="color:white;" ></span> Dashboard</a></li>
        <li><a href="export_archivefile.php?export" data-toggle="modal" class="btn custom-btn"><span class="fa fa-file-excel" style="color:white;"></span> Export</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="btn custom-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><span class="glyphicon glyphicon-user" style="color:#073595;"></span> <?=$user['name'];?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><span class="fa fa-sign-out" style="color:#073595;"></span> Log Out</a></li>
            <li><a href="#"><span class="fa fa-user" style="color:#073595;"></span> Profile</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#"><span class="fa fa-key" style="color:#073595;"></span> Change Password</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="panel panel">
    <div class="panel-heading" style="color:white;background:#fe8181;padding:1px"><h3>Archived Data</h3></div>
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
            <div class="modal-body">
                <table class="table table-bordered" id="example" width="100%">
                    <thead>
                        <tr>
                        <!-- <th>ID</th> -->
                        <th>Company Code</th>
                        <th>Assigned To</th>
                        <th>Location</th>
                        <th>Model Description</th>
                        <th>Serial Number</th>
                        <th>Added at</th>
                        <?php if($_SESSION['role'] == 'admin'){ ?>
                        <th style="text-align:right">Action</th>
                        <?php } ?>
                    </thead>
                    <tbody>
                        <?php
                        // Include your database connection file

                        // Query to retrieve archived data from the database
                        $query = "SELECT * FROM tbl_archive";

                        // Execute the query
                        $result = mysqli_query($conn, $query);

                        // Check if the query was successful
                        if ($result) {
                            // Check if there are any rows in the result
                            if (mysqli_num_rows($result) > 0) {
                            // Loop through each row and display the data
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                // echo "<td>" . $row['ID'] . "</td>";
                                echo "<td>" . $row['company_code'] . "</td>";
                                echo "<td>" . $row['assigned_to'] . "</td>";
                                echo "<td>" . $row['location_n'] . "</td>";
                                echo "<td>" . $row['model_description'] . "</td>";
                                echo "<td>" . $row['serial_number'] . "</td>";
                                echo "<td>" . $row['added_at'] . "</td>";
                                if($display_edit_delete){
                                    echo "<td align='right'>";
                                    echo "<a href='restore.php?restore=" . $row['ID'] . "' class='btn btn-success'><span class='fa fa-undo'></span></a>";
                                    echo " ";
                                    echo "<a href='delete_permanent.php?delete=" . $row['ID'] . "' class='btn btn-danger'><span class='fa fa-trash'></span></a>";
                                    echo "</td>";
                                }
                                echo "</tr>";
                            }
                            } else {
                            echo "<tr><td colspan='7'>No archived data found.</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Error retrieving archived data: " . mysqli_error($conn) . "</td></tr>";
                        }
                        ?>
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
</body>
</html>