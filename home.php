<?php 
session_start();

if (isset($_SESSION['user_email']) && isset($_SESSION['user_password'])) {

 ?>
<!DOCTYPE html>
<html>

<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <h1 class="main">Hello, <?php echo $_SESSION['user_name']; ?></h1>

    <a class="one" href="logout.php">Logout</a>

</body>

</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>