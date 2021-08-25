<?php

if (isset($_POST["SrNo"]) && !empty($_POST["SrNo"])) {

    require_once "config.php";

    $SrNo = $_GET["SrNo"];
    $sql = "DELETE FROM `notes` WHERE `notes`.`SrNo` = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $param_SrNo);


        $param_SrNo = trim($_REQUEST["SrNo"]);


        if (mysqli_stmt_execute($stmt)) {
            header("location: index.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }


    mysqli_stmt_close($stmt);


    mysqli_close($link);
} else {

    if (empty(trim($_GET["SrNo"]))) {

        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Note</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Note</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="SrNo" value="<?php echo trim($_GET['SrNo']); ?>" />
                            <p>Are you sure you want to delete the note?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>