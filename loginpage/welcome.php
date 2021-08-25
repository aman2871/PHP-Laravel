<?php
// starting the session and checking is the session exist or not i.e if the user has logged in or not
session_start();
if (!isset($_SESSION['loggedin'])  || $_SESSION['loggedin'] != true) {
    // if not then the user will be again sent to the login page
    header("location:login.php");
}
?>

<?php
// Include _dbconnect file
require 'partials/_dbconnect.php';

// Define variables and initialize with empty values
$image = "";
$image_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate image 
    $input_image = $_POST["image"];
    if (empty($input_image)) {
        $image_err_err = "Please select an image.";
    } else {
        $image = $_FILES($_POST["image"]);
        $allowed =  array('jpeg', 'jpg', "png", "gif", "bmp", "JPEG", "JPG", "PNG", "GIF", "BMP");
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        if (!in_array($ext, $allowed)) {
            $imageError = "jpeg only";
        }
    }

    // Check input errors before inserting in database
    if (empty($image_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO images('id','img') VALUES ('$uid','$input_image');";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_image);

            // Set parameters
            $param_image = $image;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: welcome.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Welcome - <?php echo $_SESSION['username'] ?></title>
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
    <div class="container">
        <?php require 'partials/_navbar.php';
        require 'partials/_dbconnect.php';
        ?>
        <h1>Welcome- <?php echo $_SESSION['username'] ?></h1>
        <h4> Welcome to iSecure this is site where you can create a user Id for yourself and also can login with that user Id anytime you want now you can see and upload images also.

            <div class="img-box">
                <form action="">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SrNo</th>
                                <th scope="col">Image</th>

                            </tr>
                        </thead>
                        <?php

                        $uid = $_SESSION['id'];

                        require 'partials/_dbconnect.php';
                        $sql = "SELECT images.img FROM user INNER JOIN images ON user.id=images.id WHERE user.id='$uid';";
                        $result = mysqli_query($conn, $sql);
                        $srno = 0;
                        while ($row = mysqli_fetch_array($result)) {
                            $srno = $srno + 1;
                        ?>
                            <tr>
                                <td><?php echo $srno; ?></td>
                                <td><?php echo '<img src="data:image;base64,' . base64_encode($row['img']) . '" alt="Image" style="width:15%;height:15%">'; ?></td>
                                <td></td>
                            </tr>
                        <?php

                        }
                        ?>
                    </table>
                </form>
                <?php

                ?>
            </div>

            <br><br>
            <input type="file" name="fileupload" accept="image/x-png,image/gif,image/jpeg" />
            <input type="submit" value="Upload Image" name="image">
            <p>
                If you want to <b>Logout</b> you can click on <a href="/Login_page/logout.php">This Link</a> or just click on Logout.
            </p>
        </h4>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
</body>

</html>