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
<h1>User Dashboard</h1>
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
            <div class="mt-3"><a href="./product/add.php?pdid=<?php echo $id?>" class="btn btn-success">Add your Product</a></div>
            <div class="mt-3"><a href="./delete.php?delid=<?php echo $id?>" class="btn btn-danger">Delete Your Account</a></div>
            <div class="mt-3"><a href="./edit.php?edid=<?php echo $id?>" class="btn btn-primary">Edit your profile</a></div>
        </div>
    </div>
</div>
<div class="main container mt-5">
    <div class="row">
    <?php 
    $sel_p ="SELECT * FROM `user_pd` WHERE `user_id` = '$id'";
    $query = mysqli_query($con, $sel_p);
    if(mysqli_num_rows($query) > 0){
        $pd = mysqli_fetch_all($query, MYSQLI_ASSOC);
        foreach ($pd as $item) {

            ?>
            <div style="height: 500px;width: 300px;">
                <h4><?php echo $item['product_name']?></h4>
                <h6><?php echo $item['created_at']?></h6>
                <a href="./product/delpd.php?de=<?php echo $item['id']?> " class="btn btn-danger">Delete</a>
                <a href="./product/edpd.php?ed=<?php echo $item['id']?> " class="btn btn-primary">Edit</a>
            </div>
            



            <?php
        }

    }
    ?>
    </div>
</div>

    
</body>
</html>