<?php
// Include the database connection file
include "connection.php";

// Check if the user is logged in
if (!isset($_SESSION['admin'])) {
    header("location:index.php");
    exit;
}

// Check if the form is submitted
if (isset($_POST['change_password'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the old password is correct
    $sql = "SELECT * FROM user WHERE ID = '".$_SESSION['admin']."'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    if ($old_password == $row['password']) {
        // Check if the new password and confirm password match
        if ($new_password == $confirm_password) {
            // Update the password
            $sql = "UPDATE user SET password = '".$new_password."' WHERE ID = '".$_SESSION['admin']."'";
            $conn->query($sql);

            // Display a success message
            $success_message = "<div style='background:green; border-radius:25px; color:#fff; font-size:15px; text-align:center;'>Password changed successfully!</div>";
        } else {
            // Display an error message
            $error_message = "<div style='background:red; border-radius:25px; color:#fff; font-size:15px; text-align:center;'>New password and confirm password do not match!</div>";
        }
    } else {
        // Display an error message
        $error_message = "<div style='background:red; border-radius:25px; color:#fff; font-size:15px; text-align:center;'>Old password is incorrect!</div>";
    }
}

?>

<html>
<head>
<title>Change Password</title>
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
            width: 600px;
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

        #table{
            border-collapse:collapse;
            padding: 5px;
            font-size: 10pt; 
        }

        tr td{
            padding: 5px;
            font-size: 10pt;
        }
        
        #submit{
            padding: 10px;
            background:rgba(106, 176, 76, 1.0);
            color: #fff;
            border-radius: 3px;
            border: none;
            cursor: pointer;
            width: 275%;
        }
                
        #submit:hover{
            background:rgba(0, 148, 50, 1.0)
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

        h3{
            text-align: center;
        }
    </style>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
<br>
<br>
<div class="panel-heading" style="color:white;background:#99C7DD;padding:10px"><h3>Change Password</h3></div>
<br><br>
<!-- Display success or error message -->
<?php if (isset($success_message)) { ?>
    <div class="alert">
        <?php echo $success_message; ?>
    </div>
        <script>
            setTimeout(function() {
            window.location.href = 'index.php';
            }, 2000); // redirect to index.php after 2 seconds
        </script>
<?php } elseif (isset($error_message)) { ?>
    <div class="alert">
        <?php echo $error_message; ?>
    </div>
<?php } ?>
    <div id="divheader">
            <form action="" method="post">
            <a href="index.php"  class="btn btn-primary">Back</a>
                <table width="100%">
                        <tr>
                            <td>Old Password</td>
                            <td><input type="password" class="form-control" id="old_password" name="old_password" required></td>
                        </tr>
                        <tr>
                            <td>New Password</td>
                            <td><input type="password" class="form-control" id="new_password" name="new_password" required></td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td><input type="password" class="form-control" id="confirm_password" name="confirm_password" required></td>
                        </tr>
                        <tr>
                            <td><button type="submit" id="submit" name="change_password">Change Password</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>