<?php
session_start(); 
$conn = new mysqli('localhost','root','','userauthentication');
if(!$conn){
    die("Database Connection Failed");
}

$empty_email = '';
$empty_password = '';

if(isset($_POST['user_submit'])){
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $md5_user_password = md5($user_password);

    if(empty($user_email)){
        $empty_email = "Fill up this field";
    }

    if(empty($user_password)){
        $empty_password = "Fill up this field";
    }

    if(!empty($user_email) && !empty($user_password)){
        $sql = "SELECT * FROM users WHERE user_email = '$user_email' AND user_password = '$md5_user_password'";

        $query = $conn->query($sql);

        if( $query->num_rows > 0 ){
            $_SESSION['login'] = 'login successfull';
            header('location:index.php');
        }else{
            echo "information not matched";
            echo $sql;
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
                <h1 style="text-align: center; color:blue">Login</h1>
                <?php if (isset($_GET['usercreated'])) {
                    echo "user Created Successfully";
                } ?>
                <form class="form" action="login.php" method="POST">
                    <div class="mt-4">
                        <label class="form-lable">Email</label>
                        <input type="text" class="form-control" name="user_email" value="<?php if(isset($_POST['user_submit'])){ echo $user_email ;}?>" />
                        <?php if(isset($_POST['user_submit'])) { echo "<span class='text-danger'>" . $empty_email . "</span>"; }?>
                    </div>
                    <div class="mt-4">
                        <label class="form-lable">Password</label>
                        <input type="password" class="form-control" name="user_password" />
                        <?php if(isset($_POST['user_submit'])) { echo "<span class='text-danger'>" . $empty_password . "</span>"; }?>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success" name="user_submit">Login</button>
                    </div>
                </form>
                <div class="mt-2">
                    <h5>Don't have an account? <a href="user.php">Register</a></h5>
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