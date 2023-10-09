<?php
include 'connectdb.php';

//DELETE-USER
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM `users` WHERE `id` = '$id'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        echo "<script>window.location.href='home.php';</script>";
        exit;
    } else {
        die("Connection Failed:" . mysqli_connect_error());
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <title>Anthony Dopeno | CRUD</title>
</head>

<body>

    <div class="container my-5">

        <center>
            <h1>CRUD PROJECT</h1>
            <h5><i>CREATE | UPDATE | DELETE</i></h5>
        </center>

        <button class="btn btn-dark"><a href="adduser.php" class="text-light">Add User</a></button>

        <table class="table table-striped table-dark my-2">
            <thead>
                <tr>
                    <th scope="col">User #</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Password (Encrypt)</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM `users`";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo '
                        <tr>
                            <th scope="row">' . $data['id'] . '</th>
                            <td>' . $data['name'] . '</td>
                            <td>' . $data['email'] . '</td>
                            <td>' . $data['mobile'] . '</td>
                            <td title="Hashed Password">' . $data['password'] . '</td>
                            <td>
                            <button class="btn btn-dark" title="Update User"><a href="update.php?updateid='.$data['id'].'"><i class="fa fa-address-book" aria-hidden="true"></i></a></button>
                            <button class="btn btn-dark" title="Delete User"><a href="home.php?deleteid='.$data['id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a></button>
                            </td>
                        </tr>
                        ';
                    }
                }
                ?>
            </tbody>
        </table>

    </div>
</body>

</html>