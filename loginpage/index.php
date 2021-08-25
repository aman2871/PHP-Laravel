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
        <?php require 'partials/_navbar.php' ?>
        <h1>welcome</h1>
        <div class="img-box">
            <form action="">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SrNo</th>

                            <th scope="col">Username</th>
                            <th scope="col">Image</th>

                        </tr>
                    </thead>
                    <?php
                    require 'partials/_dbconnect.php';
                    $sql = "SELECT user.username , images.img FROM user INNER JOIN images on user.id=images.id;";
                    $result = mysqli_query($conn, $sql);
                    $srno = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        $srno = $srno + 1;
                    ?>
                        <tr>
                            <td><?php echo $srno ;?></td>
                            <td><?php echo $row['username'];?></td>
                            <td><?php echo '<img src="data:image;base64,' . base64_encode($row['img']) . '" alt="Image" style="width:150px;height:150px">'; ?></td>
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

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
</body>

</html>