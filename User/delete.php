<?php 

include("../db_con/db.php");


if (isset($_GET['delid'])){
    $id = $_GET['delid'];

    $sel = "SELECT * FROM `user_tb` WHERE `id` = '$id' ";
    $res = mysqli_query($con ,$sel);
    $row = mysqli_fetch_assoc($res);
    $image = $row["image"];
    unlink(".$image");

    $sql = "DELETE FROM `user_tb` WHERE `id` = '$id'";
    $result = mysqli_query($con ,$sql);
    if ($result){


        session_destroy();
        header("location: ../sign_up.php");

    }
}

