<?php 
$con = mysqli_connect("localhost","root","","logsen_db") or die("server did not respond");

if (isset($_GET["de"])){
    $id = $_GET["de"];
    echo $id;
    print_r($id);
    $sql = "DELETE FROM `user_pd` WHERE `id` = '$id'";
    $result = mysqli_query($con,$sql);
    if ($result){
        header("location: ../userdash.php");
    }
}