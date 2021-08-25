<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <style>
        .container {
            background-color: grey;
            border: 2px solid black;
            border-radius: 5px;
            padding: 5px;
        }

        .container form {
            margin: 20px 20px;
            padding: 20px;
        }

        .container form input {
            padding: 10px;
            border-radius: 5px;
        }

        .container form input {
            padding: 10px;
            border-radius: 5px;
        }

        .btn {
            border: 2px solid black;
            background-color: white;
            padding: 8px;
            color: black;
            cursor: pointer;
        }
    </style>

</head>

<body>

    <!doctype html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Login</title>
    </head>

    <body>
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $login = false;
            $showError = false;
            include 'partials/_dbconnect.php';
            $username = $_POST['username'];
            $password = $_POST['password'];

            // md5 function is used to encrypt the entered password here it is used to decrypt the password so that the user can login
            $pass = md5($password);

            $sql = "SELECT `id`,`username`, `password` FROM `user` WHERE `username`='$username' AND `password`='$pass'";
            $result = mysqli_query($conn, $sql);

            // this num variable is created to store the number of rows the result is giving
            $userData = mysqli_fetch_array($result);



            // if $num is equal to 1 it means that the username exist and the session can start
            if ($userData) {
                $login = true;

                // here the session starts setting the loggedin as true
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $userData['username'];
                $_SESSION['id'] = $userData['id'];

                // if the input credentials are correct then user will go to the welcome page
                header("location:welcome.php");
            }
            // else this error will be echo
            else {
                $showError = "Invalid Credentials!";
            }
        }

        ?>

        <div class="container">
            <?php
            require 'partials/_navbar.php';
            // if login is successfull then this will echo
            if ($login) {
                echo "Success! You are logged in to iSecure!";
            }
            // if not then this will echo
            if ($showError) {
                echo $showError;
                echo "<br>";
                echo "If you are a new user then please SignUp!!";
            }


            ?>
            <h1 class="text-center mt-5">Login To iSecure</h1>

            <form class="text-center " action="/Login_page/login.php" method="POST">
                <label for="username">Enter Username: </label>
                <input class="text-center mt-3" maxlength="5" type="text" name="username" id="username" placeholder="Enter Username">
                <br>
                <label for="password">Enter Password: </label>
                <input class="text-center my-3" maxlength="5" type="password" name="password" id="password" placeholder="Enter Password">
                <br>
                <input class="text-center mt-3" type="submit" value="Login">
                <a class="btn" href="/Login_page/signup.php">SignUp</a>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

    </html>
</body>

</html>