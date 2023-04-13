<?php

$conn = new mysqli('localhost', 'root', '', 'userauthentication');
if (!$conn) {
    die("Database Connection Failed");
}

$empmsg_firstname = '';
$empmsg_lastname = '';
$empmsg_name = '';
$empmsg_email = '';
$empmsg_password = '';
$empmsg_resetpassword = '';
$empmsg_image = '';

if (isset($_POST['submit'])) {

    $user_first_name = mysqli_real_escape_string($conn, $_POST['user_first_name']);
    $user_last_name = mysqli_real_escape_string($conn, $_POST['user_last_name']);
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
    $user_confirm_password = mysqli_real_escape_string($conn, $_POST['user_reset_password']);
    $md5_user_password = md5($user_password);

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    if (empty($user_first_name)) {
        $empmsg_firstname = "Fill up this field";
    }

    if (empty($user_last_name)) {
        $empmsg_lastname = "Fill up this field";
    }

    if (empty($user_name)) {
        $empmsg_name = "Fill up this field";
    }

    if (empty($user_email)) {
        $empmsg_email = "Fill up this field";
    }

    if (empty($user_password)) {
        $empmsg_password = "Fill up this field";
    }

    if (empty($user_confirm_password)) {
        $empmsg_resetpassword = "Fill up this field";
    }

    if (empty($image)) {
        $empmsg_image = "Fill up this field";
    }

    $query = "SELECT * from users WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $query);
    $present = mysqli_num_rows($result);
    if ($present > 0) {
       $messages = "Email Already Exists";    
    } else {

        if (!empty($user_first_name) && !empty($user_last_name) && !empty($user_name) && !empty($user_email) && !empty($user_password) && !empty($user_confirm_password) && !empty($image)) {
            if ($user_password === $user_confirm_password) {
                $sql = "INSERT INTO users(user_first_name, user_last_name, user_name, user_email, user_password, user_image) VALUE('$user_first_name','$user_last_name','$user_name','$user_email','$md5_user_password','$image')";

                if ($conn->query($sql) == true) {
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message = 'registered successfully!';
                    header('location:login.php?usercreated');
                    //echo "Registration Successfully";
                } else {
                    $message = 'registeration failed!';
                }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <title>User Authentication</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>

    <div class="form-container my-4 p-4 shadow">
        <form class="form" action="" method="POST" enctype="multipart/form-data">
            <h3>Registration Form</h3>
            <h5 style="color: red;"><?php if (isset($_POST['submit'])) {echo $messages ; }?></h5>
            <label class=" form-lable">First Name</label>
            <input type="text" class="box" name="user_first_name"
                value="<?php if (isset($_POST['submit'])) {echo $user_first_name;} ?>" />
            <?php if (isset($_POST['submit'])) {
                echo "<span class='text-danger'>" . $empmsg_firstname . "</span>";
            } ?>
            <label class="form-lable one">Last Name</label>
            <input type="text" class="box" name="user_last_name" value="<?php if (isset($_POST['submit'])) {
                                                                            echo $user_last_name;
                                                                        } ?>" />
            <?php if (isset($_POST['submit'])) {
                echo "<span class='text-danger'>" . $empmsg_lastname  . "</span>";
            } ?>
            <label class="form-lable">User Name</label>
            <input type="text" class="box" name="user_name" value="<?php if (isset($_POST['submit'])) {
                                                                        echo $user_name;
                                                                    } ?>" />
            <?php if (isset($_POST['submit'])) {
                echo "<span class='text-danger'>" . $empmsg_name  . "</span>";
            } ?>
            <label class="form-lable">Email</label>
            <input type="text" class="box" name="user_email" value="<?php if (isset($_POST['submit'])) {
                                                                        echo $user_email;
                                                                    } ?>" />
            <?php if (isset($_POST['submit'])) {
                echo "<span class='text-danger'>" .  $empmsg_email . "</span>";
            } ?>
            <label class="form-lable">Password</label>
            <input type="password" class="box" name="user_password" value="<?php if (isset($_POST['submit'])) {
                                                                                echo $user_password;
                                                                            } ?>" />
            <?php if (isset($_POST['submit'])) {
                echo "<span class='text-danger'>" . $empmsg_password . "</span>";
            } ?>
            <label class="form-lable">Comfirm Password</label>
            <input type="password" class="box" name="user_reset_password" value="<?php if (isset($_POST['submit'])) {
                                                                                        echo $user_confirm_password;
                                                                                    } ?>" />
            <?php if (isset($_POST['submit'])) {
                echo "<span class='text-danger'>" . $empmsg_resetpassword . "</span>";
            } ?>

            <label class="form-lable">Upload Image</label>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png" value="<?php if (isset($_POST['submit'])) {
                                                                                                                echo $image;
                                                                                                            } ?>" />
            <?php if (isset($_POST['submit'])) {
                echo "<span class='text-danger'>" . $empmsg_image . "</span>";
            } ?>

            <input type="submit" name="submit" value="register now" class="btn">
            <p>already have an account? <a href="login.php">login now</a></p>
        </form>
    </div>





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
