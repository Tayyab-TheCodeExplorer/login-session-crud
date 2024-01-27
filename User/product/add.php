<?php 
$con = mysqli_connect("localhost","root","","logsen_db") or die("server did not respond");

$product_error = "";
$success = "";

if ( isset( $_POST["submit"] ) ) {
    $id = $_POST["user_id"];
    $product_name = $_POST['product_name'];
    print_r($_POST);
    if (empty($product_name)) {
        $product_error = 'Please input your product';
    }else {
        $sql = "INSERT INTO `user_pd`(`user_id`, `product_name`) VALUES ('$id','$product_name')";
        $result = mysqli_query($con,$sql);
        if ($result) {
            
            $success ="Product Added";
            header("location: ../userdash.php");
        
        }

    }
}

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
<h1>
        Add Your Product </h1>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <?php 
            if (isset($_GET['pdid'])){
                $id = $_GET['pdid'];

            
            
            ?>
            <input type="hidden" value="<?php echo $id?>" name="user_id">
            <?php }?>
            <div class="mb-3">
                <label class="form-label" for="product_name">Product Name</label>
                <input type="text" class="form-control" name="product_name" placeholder="Enter Your product name !">
                <p name="product_error">
                    <?php echo $product_error ?>
                </p>
            </div>
            <div class="mb-3">
                <input type="submit" class="form-control btn btn-primary m-auto" name="submit" value="Add Up">

            </div>

            <p name="success">
                <?php echo $success ?>
            </p>
        </div>
        </form>
        <div class="mb-5">
            <h3>Back to <a href="../userdash.php"> HOME</a> </h3>
    </div>
</body>
</html>