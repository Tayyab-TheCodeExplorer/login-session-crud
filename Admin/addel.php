<?php 
include("../db_con/db.php");

if (isset($_GET["del"])){
$id = $_GET["del"];

$sel = "SELECT * FROM `user_tb` WHERE `id` = '$id' ";
$res = mysqli_query($con ,$sel);
$row = mysqli_fetch_assoc($res);
$image = $row["image"];
unlink(".$image");

$del = "DELETE FROM `user_tb` WHERE `id` = '$id'";
$result = mysqli_query($con,$del);
if ($result){
    
    
    header("location: admindash.php");
}

}