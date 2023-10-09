<?php
include 'connectdb.php';
$id=$_GET['updateid'];
$sql = "SELECT * FROM `users` WHERE id=$id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $mobile = $_POST['mobile'];
   $password = $_POST['password'];

   //check-password-if-empty
   if ($password == ''){
      $newPassword = $data['password'];
   } else {
      $newPassword = $_POST['password'];
   }

   $hashed_password = password_hash($newPassword,PASSWORD_DEFAULT);
   $sql = "update `users` set id=$id, name='$name', email='$email',mobile='$mobile', password='$hashed_password' where id=$id";
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Anthony Dopeno | Update</title>
</head>

<body>

    <div class="container my-5">
        <center><h1>Update Information</h1></center>
        <form method="POST">
        <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" placeholder="Enter full name" name="name" value="<?php echo htmlspecialchars($data['name'])?>">
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" placeholder="Enter email" name="email" value="<?php echo $data['email'];?>">
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="text" class="form-control" placeholder="Enter mobile number" name="mobile" value="<?php echo $data['mobile'];?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" placeholder="New Password" name="password">
            </div>
            <button type="submit" name="submit" class="btn btn-dark">Update</button>
        </form>

    </div>
</body>

</html>