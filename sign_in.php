
<?php 

include("./db_con/db.php");




$email_error = "";
$password_error = "";
$success = "";

if (isset($_POST["signin"])) 
    {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        if(empty($email)){
            $email_error = "Please enter your email";
        } elseif(empty($pass)){
            $password_error = "Please enter your Password";
        } else{
          $sql = "SELECT * FROM `user_tb` WHERE `email` = '$email' and `password` = '$pass'";
          $result = mysqli_query($con,$sql);
          if ($result){
          if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);

            session_start();
                $_SESSION["user_name"] = $row['user_name'];
                $_SESSION["user_email"] = $row['email'];
                $_SESSION["user_image"] = $row['image'];
                $_SESSION["user_Contact"] = $row['contact'];

                if($row['user_type'] == 0){
                  header("location: ./User/userdash.php");
                  
                } else{
                  header("location: ./Admin/admindash.php");
                }


            } else{
              $success = "Invalid email or password";
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
    <title>Bootstrap demo</title>
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
        Sign In Form
    </h1>
<div class="container">
  <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

<div class="mb-3">
    <label class="form-label" for="email">Email</label>
    <input type="email" class="form-control" name="email" placeholder="Enter Your email !">
    <p name = "email_error">
        <?php echo $email_error?>
    </p>
</div>
<div class="mb-3">
    <label class="form-label" for="password">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Enter Your Password !">
    <p name = "password_error">
        <?php echo $password_error?>
    </p>
</div>
<div class="mb-3">
    <input type="submit" class="form-control btn btn-primary m-auto" name="signin" value="Sign In">
    <p name = "success">
        <?php echo $success?>
    </p>
</div>

</form>
<div class="mb-5">
  <h3><a href="./sign_up.php">Register</a> from new account</h3>
    
</div>
</div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>