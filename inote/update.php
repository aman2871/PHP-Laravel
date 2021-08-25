<?php
// echo mysqli_stmt_execute($stmt);
// exit;
// echo "UPDATE `notes` SET `title`=?, `description`=? WHERE SrNo=?;";
// exit;
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$title = $description = "";
$title_err = $description_err = "";

// Processing form data when form is submitted
if (isset($_POST["SrNo"]) && !empty($_POST["SrNo"])) {
    // Get hidden input value
    $SrNo = $_POST["SrNo"];

    // Validate title
    $input_title = trim($_POST["title"]);
    if (empty($input_title)) {
        $title_err = "Please enter a note title";
    } elseif (!filter_var($input_title, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $title_err = "Please enter a valid title.";
    } else {
        $title = $input_title;
    }

    // Validate description
    $input_description = trim($_POST["description"]);
    if (empty($input_description)) {
        $description_err = "Please enter the Note description.";
    } else {
        $description = $input_description;
    }

    if (empty($title_err) && empty($description_err)) {

        $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`SrNo` = '$SrNo';";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_title, $param_description, $param_SrNo);

            // Set parameters
            $param_title = $title;
            $param_description = $description;
            $param_SrNo = $SrNo;


            if (mysqli_stmt_execute($stmt)) {

                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }


        mysqli_stmt_close($stmt);
    }


    mysqli_close($link);
} else {

    if (isset($_GET["SrNo"]) && !empty(trim($_GET["SrNo"]))) {

        $SrNo =  trim($_GET["SrNo"]);


        $sql = "SELECT * FROM notes WHERE SrNo=?;";
        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "i", $param_SrNo);


            $param_SrNo = $SrNo;


            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);


                    $title = $row["title"];
                    $description = $row["description"];
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

        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Notes</title>
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
                    <h2 class="mt-5">Update Notes</h2>
                    <p>Please edit the note & click on submit to update Note.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control <?php echo (!empty($title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $title; ?>">
                            <span class="invalid-feedback"><?php echo $title_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err; ?></span>
                        </div>

                        <input type="hidden" name="SrNo" value="<?php echo $SrNo; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>