<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body style="background:#eee">
<br><br><br><br>
    <div class="container">
        <div class="col-md-6 offset-3"></div>
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="card-title">
                        <h4 class="text-white">LOGIN</h4>
                    </div>
                </div>
                <form action="login.php" method="POST">
                    <table class="table table-borderless">
                        <tr>
                            <!-- <td>USERNAME</td> -->
                            <td><input type="text" placeholder="Enter Username" class="form-control" name="username" required></td>
                        </tr>
                        <tr>
                            <!-- <td>PASSWORD</td> --> 
                            <td><input type="password" placeholder="Enter Password" class="form-control" name="password" required></td>
                        </tr>
                        <tr>
                            <!-- <td></td> -->
                            <td><button type="submit" class="btn btn-primary btn-block" name="login">SUBMIT</button></td>
                        </tr>
                    </table>
                </form>
                </div>
                <br>
                <?php
                    if(isset($_SESSION['error'])){
                        echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
                        unset($_SESSION['error']);
                    }
                ?>
        </div>
    </div>

</body>
</html>