<?php

include("../db_con/db.php");
// $con = mysqli_connect("localhost","root","","logsen_db") or die("server did not respond");




$name_error = "";
$email_error = "";
$password_error = "";
$contact_error = "";
$img_error = "";
$success = "";

if (isset($_POST["update"])) {

    $id = $_POST["id"];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $contact = $_POST['contact'];



    if (empty($name)) {
        $name_error = "Please enter your name";
    } elseif (empty($email)) {
        $email_error = "Please enter your email";
    } elseif (empty($pass)) {
        $password_error = "Please enter your Password";
    } elseif (empty($contact)) {
        $contact_error = "Please enter your contact";
    } elseif ($_FILES["img"]['error'] != 0) {
        $img_error = "please enter your image";
    } else {
        $img_name = $_FILES['img']['name'];
        $tmp_name = $_FILES['img']['tmp_name'];
        $es = explode('.', $img_name);
        $ext = strtolower(end($es));

        $allowed_ext = ["jpg", "jpeg", "png", "gif", "bmp", "tiff", "webp", "svg", "ico", "heic", "heif", "raw", "cr2", "nef", "arw", "dng", "raf", "rw2", "orw", "sr2", "svgz"];

        if (in_array($ext, $allowed_ext)) {
            $new_name = $img_name . microtime() . rand(2, 555555) . $ext;
            echo $new_name ;
            $move = "./Assets/Images/" . $new_name;

            if (move_uploaded_file($tmp_name, ".".$move)) {
                
                
                $sele = "SELECT * FROM `user_tb` WHERE `id` = '$id' ";
                $resu = mysqli_query($con ,$sele);
                $arr = mysqli_fetch_assoc($resu);
                $im = $arr["image"];
                unlink(".$im");


                $sql = "UPDATE `user_tb` SET `user_name`='$name',`email`='$email',`password`='$pass',`Contact`='$contact',`image`='$move' WHERE `id` = '$id'";
                $result = mysqli_query($con, $sql);
                if ($result){


                $success = "Update successfull";
                session_start();
                $_SESSION["user_name"] = $name;
                $_SESSION["user_email"] = $email;
                $_SESSION["user_image"] = $move;
                $_SESSION["user_Contact"] = $contact;

                header("location: admindash.php");
                }
            }
        }

    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign up</title>
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
    <h1>
        Register Your Account </h1>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
<?php 
if (isset($_GET['edid'])){
    $id = $_GET['edid'];
}
$sel = "SELECT * FROM `user_tb` WHERE `id` = '$id'";
$re = mysqli_query($con, $sel);
$ro = mysqli_fetch_assoc($re);
?>
<input type="hidden" name="id" value="<?php echo $ro['id']?>">
            <div class="mb-3">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control" name="name" value ="<?php echo $ro['user_name']?>" placeholder="Enter Your name !">
                <p name="name_error">
                    <?php echo $name_error ?>
                </p>
            </div>
            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control" name="email" value ="<?php echo $ro['email']?>" placeholder="Enter Your email !">
                <p name="email_error">
                    <?php echo $email_error ?>
                </p>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter Your Password !">
                <p name="password_error">
                    <?php echo $password_error ?>
                </p>
            </div>
            <div class="mb-3">
                <label class="form-label" for="img">Image</label>
                <input type="file" class="form-control" name="img" placeholder="Enter Your image !">
                <p name="img_error">
                    <?php echo $img_error ?>
                </p>
            </div>
            <div class="mb-3">
                <label class="form-label" for="contact">Contact</label>
                <input type="number" class="form-control" name="contact" value ="<?php echo $ro['Contact']?>" placeholder="Enter Your contact !">
                <p name="contact_error">
                    <?php echo $contact_error ?>
                </p>
            </div>
            <div class="mb-3">
                <input type="submit" class="form-control btn btn-primary m-auto" name="update" value="Update">

            </div>

        </form>
        <div class="mb-5">
            <h3>Have an account <a href="./sign_in.php">Already</a> </h3>
            <p name="success">
                <?php echo $success ?>
            </p>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>