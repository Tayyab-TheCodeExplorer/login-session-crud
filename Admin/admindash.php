<?php 
include("../db_con/db.php");


session_start();
$email =  $_SESSION['user_email'];
$sql = "SELECT * FROM `user_tb` WHERE `email` = '$email' ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$id = $row['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Dashboard </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</head>

<body>
<h1>Admin Dashboard</h1>
<div class="container-fluid mt-5">
<div class="row">
        <div class="col-5 mt-auto" >
            <h2><?php echo $row['user_name'];?></h2>
            <p><?php echo $row['email'];?></p>
        </div>
        <div class="col-5">
            <img src=".<?php echo $row['image'];?>" alt="invalid image"  class="rounded-circle" height="200px">
        </div>
        <div class="col-2 mt-auto">
            <div class="mt-3"><a href="#" class="btn btn-success">Add your Product</a></div>
            <div class="mt-3"><a href="./adedit.php?edid=<?php echo $id?>" class="btn btn-primary">Edit your profile</a></div>
        </div>
    </div>
</div>

<div class="container">
    <table class=" table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>User email</th>
                <th>Image</th>
                <!-- <th>Product</th> -->
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $qu = "SELECT * FROM `user_tb` WHERE `user_type` = '0'";
            $res = mysqli_query($con, $qu);
            $fe = mysqli_fetch_all($res, MYSQLI_ASSOC);
            foreach ($fe as $itme) {
                ?>
            <tr>
                <td><?php echo $itme['id']?></td>
                <td><?php echo $itme['user_name']?></td>
                <td><?php echo $itme['email']?></td>
                <td><img src=".<?php echo $itme['image']?>" height="50px" width="50px" alt="error"></td>
                <!-- <td><a href="<?php # echo $itme['id']?>"  class="btn btn-success">Show product</a></td> -->
                <td><a class="btn btn-danger" href="./addel.php?del=<?php echo $itme['id']?>"> Delete</a></td>
            </tr>
                <?php 
            }
?>
        </tbody>
    </table>
</div>


    
</body>
</html>