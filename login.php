<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'userauthentication');
if (!$conn) {
    die("Database Connection Failed");
}

$empty_email = '';
$empty_password = '';

if (isset($_POST['user_submit'])) {
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);
    $md5_user_password = md5($user_password);

    if (empty($user_email)) {
        $empty_email = "Fill up this field";
    }

    if (empty($user_password)) {
        $empty_password = "Fill up this field";
    }

    if (!empty($user_email) && !empty($user_password)) {
        $sql = "SELECT * FROM users WHERE user_email = '$user_email' AND user_password = '$md5_user_password'";

        $query = $conn->query($sql);

        if (mysqli_num_rows($query) === 1) {
            $row = mysqli_fetch_assoc($query);
            if ($row['user_email'] === $user_email && $row['user_password'] === $md5_user_password) {
                $_SESSION['user_email'] = $row['user_email'];
                $_SESSION['user_password'] = $row['user_password'];
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];
                header("Location: home.php");
                exit();
            } else {
                header("Location: index.php?error=Incorect User name or password");
                exit();
            }
        } else {
            header("Location: index.php?error=Incorect User name or password");
            exit();
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
            <h3>Login Now</h3>
            <h6 style="color: green;"><?php if (isset($_GET['usercreated'])) {
                echo "user Created Successfully";
            } ?></h6>
            <label class="form-lable">Email</label>
            <input type="text" class="box" name="user_email"
                value="<?php if (isset($_POST['user_submit'])){echo $user_email;} ?>" />
            <?php if (isset($_POST['user_submit'])){
                echo "<span class='text-danger'>" . $empty_email . "</span>";
            } ?>
            <label class="form-lable one">Password</label>
            <input type="password" class="box" name="user_password" />
            <?php if (isset($_POST['user_submit'])) {
                echo "<span class='text-danger'>" . $empty_password . "</span>";
            } ?>
            <button class="btn btn-success" name="user_submit">Login</button>
            <p>don't have an account? <a href="user.php">regiser now</a></p>
        </form>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>