<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
        <form action="login.php" method="POST">
            <table>
                <tr>
                    <td>USERNAME</td>
                    <td><input type="text" name="username" required></td>
                </tr>
                <tr>
                    <td>PASSWORD</td>
                    <td><input type="password" name="password" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="login">SUBMIT</button></td>
                </tr>
            </table>
        </form>
        <?php
            if(isset($_SESSION['error'])){
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
        ?>
    </body>
</html>