<?php
include 'connection.php';
if(isset($_POST['btn_submit'])){

        $name = $_POST['username'];
        $password = $_POST['pass'];

        // Procedure calling
        $query = "CALL CheckLogin('$name', '$password', @result)";

        // Execute the query
        mysqli_query($link, $query);

        // Retrieve the result from the stored procedure
        $result = mysqli_query($link, "SELECT @result AS result");
        $row = mysqli_fetch_assoc($result);
        $count = $row['result'];

        if($count>0){
            header("location:http://localhost/DataBase_Project/index.php");
            exit();
            }
            else{
                header("location:http://localhost/DataBase_Project/404page.html");
                exit();
            }
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="x-icon" href="img/logos/cake_logo.png">
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>DLS Bakers</title>
</head>

<body>
    <div id="container">
        <div id="left-container">
            <section>
                <div>
                    <img src="img/logos/cake_logo.png" alt="Logo" width="300px" height="150px" style="padding-left: 60px;">
                </div>
            </section>
            <hr>

            <p>Cookies must be enabled in your browser?</p>
        </div>

        <div id="container2">
            <h2 class="login-heading">Login</h2>

            <form method="post">

                <div class="login-user-box">
                    <label>Username</label><br>
                    <input type="text" name="username" required=""><br>
                </div>

                <div class="login-user-box">
                    <label>Password</label><br>
                    <input type="password" name="pass" required=""><br>
                </div>

                <button name="btn_submit"><a href="index.php">Login</a></button>
            </form>
        </div>
    </div>

    <script src="javascript.js"></script>
</body>

</html>