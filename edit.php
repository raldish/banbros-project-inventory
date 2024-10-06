<?php
    include "connection.php";

    $id = $_GET['edit'];

    $sql = "SELECT * FROM client WHERE ID = $id";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
?>

<html>
    <head>
        <title>ADD ITEMS</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        </style>
    </head>
    
<body>
<div id="divheader">
<form action="update.php" method="post">
            <table width="100%">
                <tr>
                    <td>ID Number</td>
                    <td><input type="text" value="<?=$row['ID']; ?>" name="ID" required readonly></td>
                </tr>
                <tr>
                <tr>
                    <td>Company Code</td>
                    <td><input type="text" value="<?=$row['company_code']; ?>" name="company_code" required></td>
                </tr>
                <tr>
                    <td>Assigned To</td>
                    <td><input type="text" value="<?=$row['assigned_to']; ?>" name="assigned_to" required></td>
                </tr>
                <tr>
                    <td><label for="location_n">Location</label></td>
                    <td>
                    <select name="location_n">
                    <option value="#">Select Department</option>
                    <option value="accounting" <?= ($row['location_n'] == 'accounting') ? 'selected' : '' ?>>Accounting</option>
                    <option value="marketing" <?= ($row['location_n'] == 'marketing') ? 'selected' : '' ?>>Marketing</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td>Model Description</td>
                    <td><input type="text" value="<?=$row['model_description']; ?>" name="model_description" required></td>
                </tr>
                <tr>
                    <td>Serial Number</td>
                    <td><input type="text" value="<?=$row['serial_number']; ?>" name="serial_number" required></td>
                </tr>
                <tr>
                    <td><button type="submit" id="submit" name="submit"><span class="fa fa-edit"></span>UPDATE</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>