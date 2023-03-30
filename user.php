<?php

$conn = new mysqli('localhost','root','','userauthentication');
if(!$conn){
    die("Database Connection Failed");
}

$empmsg_firstname = '';
$empmsg_lastname = '';
$empmsg_email = '';
$empmsg_password = '';
$empmsg_resetpassword = '';

if (isset($_POST['submit'])) {
    $user_first_name = $_POST['user_first_name'];
    $user_last_name = $_POST['user_last_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_reset_password = $_POST['user_reset_password'];

    $md5_user_password = md5($user_password);

    if(empty($user_first_name)){
        $empmsg_firstname = "Fill up this field";
    }

    if(empty($user_last_name)){
        $empmsg_lastname = "Fill up this field";
    }

    if(empty($user_email)){
        $empmsg_email = "Fill up this field";
    }

    if(empty($user_password)){
        $empmsg_password = "Fill up this field";
    }

    if(empty($user_reset_password)){
        $empmsg_resetpassword = "Fill up this field";
    }

    if( !empty($user_first_name) && !empty($user_last_name) && !empty($user_email) && !empty($user_password) && !empty($user_reset_password) ){
      if( $user_password === $user_reset_password ){
        $sql = "INSERT INTO users(user_first_name, user_last_name, user_email, user_password) VALUE('$user_first_name','$user_last_name','$user_email','$md5_user_password')";

        if( $conn->query($sql) == true ){
            header('location:login.php?usercreated');
            //echo "Registration Successfully";
      }else{
            echo "Password not matched";
      }
    }

    }
    

}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <title>User Authentication</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="container my-4 p-4 shadow">
        <div class="row">
            
            <div class="col-4">
            </div>
            <div class="login col-4">
            <h1 style="text-align: center; color:blue">Registration Form</h1>
                <form class="form" action="user.php" method="POST">
                    <div class="mt-4">
                        <label class="form-lable">First Name</label>
                        <input type="text" class="form-control" name="user_first_name" value="<?php if(isset($_POST['submit'])){ echo $user_first_name ;}?>" />
                        <?php if(isset($_POST['submit'])) { echo "<span class='text-danger'>" . $empmsg_firstname . "</span>"; }?>
                    </div>
                    <div class="mt-4">
                        <label class="form-lable">Last Name</label>
                        <input type="text" class="form-control" name="user_last_name" value="<?php if(isset($_POST['submit'])){ echo $user_last_name ;}?>" />
                        <?php if(isset($_POST['submit'])) { echo "<span class='text-danger'>" . $empmsg_lastname  . "</span>"; }?>
                    </div>
                    <div class="mt-4">
                        <label class="form-lable">Email</label>
                        <input type="text" class="form-control" name="user_email" value="<?php if(isset($_POST['submit'])){ echo $user_email ;}?>" />
                        <?php if(isset($_POST['submit'])) { echo "<span class='text-danger'>" .  $empmsg_email . "</span>"; }?>
                    </div>
                    <div class="mt-4">
                        <label class="form-lable">Password</label>
                        <input type="password" class="form-control" name="user_password" value="<?php if(isset($_POST['submit'])){ echo $user_password ;}?>" />
                        <?php if(isset($_POST['submit'])) { echo "<span class='text-danger'>" . $empmsg_password . "</span>"; }?>
                    </div>
                    <div class="mt-4">
                        <label class="form-lable">Reset Password</label>
                        <input type="password" class="form-control" name="user_reset_password" value="<?php if(isset($_POST['submit'])){ echo $user_reset_password ;}?>" />
                        <?php if(isset($_POST['submit'])) { echo "<span class='text-danger'>" . $empmsg_resetpassword . "</span>"; }?>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success" name="submit">Submit</button>
                    </div>
                </form>
                <div class="mt-2">
                    <h5>Already have an account? <a href="login.php">Login</a></h5>
                </div>
            </div>
            <div class="col-4">
            </div>
        </div>
    </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>