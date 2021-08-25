<?php

if (isset($_GET["SrNo"]) && !empty(trim($_GET["SrNo"]))) {

    require_once "config.php";

    $SrNo = $_GET["SrNo"];
    $sql = "SELECT * FROM notes WHERE SrNo=?";
    if ($stmt = mysqli_prepare($link, $sql)) {

        mysqli_stmt_bind_param($stmt, "i", $param_SrNo);


        $param_SrNo = trim($_GET["SrNo"]);


        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $title = $row["title"];
                $description = $row["description"];
                $tstamp=$row["tstamp"];
            } else {

                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }


    mysqli_stmt_close($stmt);


    mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Notes</title>
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
                    <h1 class="mt-5 mb-3">View Notes</h1>
                    <div class="form-group">
                        <label>Title</label>
                        <p><b><?php echo $row["title"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p><b><?php echo $row["description"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Date & Time</label>
                        <p><b><?php echo $row["tstamp"]; ?></b></p>
                    </div>

                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>