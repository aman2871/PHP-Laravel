<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
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

        .container form span {
            color: red;
            background-color: black;
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

    </head>

    <body>
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errAlert = false;
            $showError = false;
            include 'partials/_dbconnect.php';
            // get the input from the user and store it into the following variables
            $username = $_POST['username'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $data = $_POST;
            $field = false;
            $field_err = $field_space_err = false;
            $field_len_err = false;


            if (empty(trim($_POST["username"])) || empty(trim($_POST["password"])) || empty(trim($_POST["cpassword"]))) {
                $field_err = true;
                $field = true;
            } else if ((strrpos($_POST["username"], ' ') !== false) || (strrpos($_POST["password"], ' ') !== false) || (strrpos($_POST["cpassword"], ' ') !== false)) {
                $field_space_err = true;
            } 
            // this is to check if the length of username and password is greater than 5
            elseif ((strlen($username) < 5) || (strlen($password) < 5) || (strlen($cpassword) < 5)) {
                $field_len_err = "Field length must be greater than 5 characters";
            } else {
                // check weather username exists or not
                $existSql = "SELECT `username`, `password` FROM `user` WHERE `username`='$username'";
                $result = mysqli_query($conn, $existSql);
                $numRowExist = mysqli_num_rows($result);
                if ($numRowExist > 0) {
                    $showError = "This username already exists!";
                }
                // if do not exist then let the user signup to the site 
                else {
                    // if both password and confirm password match then the user will be signed up
                    if (($password == $cpassword)) {
                        // here md5 is used to encrypt the password
                        $pass = md5($cpassword);
                        $sql = "INSERT INTO `user`(`username`, `password`) VALUES ('$username','$pass');";
                        $result = mysqli_query($conn, $sql);
                        $errAlert = true;
                    }
                    // else throw this error
                    else {
                        $showError = "Password Do Not Match!";
                    }
                }
            }
        }

        ?>

        <div class="container">
            <?php
            require 'partials/_navbar.php';
            // if signup was successful then echo this
            if ($errAlert) {
                echo "Success! You are now registered to iSecure! <br>";
                echo "Now you can login..";
            }
            // if the signup was unsuccessfull then echo this
            if ($showError) {
                echo $showError;
            } else if ($field) {
                echo "Please fill all required fields!";
            } else if ($field_err || $field_space_err) {
                echo "Username required or please remove the white spaces";
            }

            ?>
            <!-- this is the simple signup form -->
            <h1 class="text-center mt-5">SignUp To Our Website</h1>

            <form class="text-center" action="/Login_page/signup.php" method="POST">
                <label for="username">Enter Username: </label>
                <input class="text-center mt-3"  type="text" name="username" id="username" placeholder="Enter Username"><span><?php echo $field_len_err ?></span>
                <br>
                <label for="password">Enter Password: </label>
                <input class="text-center mt-3" type="password" name="password" id="password" placeholder="Enter Password"><span><?php echo $field_len_err ?></span>
                <br>
                <label for="cpassword">Re-enter Password: </label>
                <input class="text-center mt-3"  type="password" name="cpassword" id="cpassword" placeholder="Re-enter Password"><span><?php echo $field_len_err ?></span>
                <br>
                <input class="text-center mt-3" type="submit" value="Signup">
                <input class="text-center mt-3" type="reset" value="Reset">
                <a class="btn" href="/Login_page/login.php">Login</a>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

    </html>


</body>

</html>