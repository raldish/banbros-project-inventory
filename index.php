<?php
    session_start();
?>

<?php
if(isset($_SESSION['error'])){
    echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}

if(isset($_SESSION['success'])){
    echo "<div style='background:green; color:#fff; padding:3px; border-radius:25px; font-size:15px; text-align:center;'>".$_SESSION['success']."</div>";
    unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Banbros Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<style>
    .container{
        padding: 20px;
    }
</style>

<body style="background:#eee">
<br><br><br><br>
    <div class="container">
        <div class="col-md-6 offset-3"></div>
            <div class="card" style="width: 30rem; margin:auto; float:none;">
                <div class="card-header bg-primary d-flex justify-content-center">
                    <div class="card-title">
                    <br>
                    <a class="navbar-brand" href="#"><img src="https://www.banbros.ph/assets/img/logo.png" style="width: 210px;" alt="Inventory System"></a>
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
                            <td><button type="submit" class="btn btn-primary btn-block" name="login">Login</button></td>
                        </tr>
                        <tr>
                            <td>Don't have an account? <a href="signup.php" data-toggle="modal" data-target="#signupModal">Sign up</a></td>
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

    <!-- Signup Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Sign up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="signup.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name of the user</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>