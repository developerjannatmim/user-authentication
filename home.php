<?php 
session_start();
$conn = new mysqli('localhost','root','','userauthentication');
if(!$conn){
    die("Database Connection Failed");
}
$user_id = $_SESSION['user_id'];

if (isset($_SESSION['user_email']) && isset($_SESSION['user_password'])) {

 ?>
<!DOCTYPE html>
<html>

<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="profile">
            <?php
         $select = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['user_image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="'.$fetch['user_image'].'">';
         }
      ?>
            <h3>Hello, <?php echo $_SESSION['user_name']; ?></h3>
            <a href="update_profile.php" class="btn">update profile</a>
            <a class="delete-btn" href="logout.php">logout</a>
            <p>new <a href="login.php">login</a> or <a href="user.php">register</a></p>
        </div>
    </div>


</body>

</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?><?php 
session_start();
$conn = new mysqli('localhost','root','','userauthentication');
if(!$conn){
    die("Database Connection Failed");
}
$user_id = $_SESSION['user_id'];

if (isset($_SESSION['user_email']) && isset($_SESSION['user_password'])) {

 ?>
<!DOCTYPE html>
<html>

<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="profile">
            <?php
         $select = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['user_image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['user_image'].'">';
         }
      ?>
            <h3>Hello, <?php echo $_SESSION['user_name']; ?></h3>
            <a href="update_profile.php" class="btn">update profile</a>
            <a class="delete-btn" href="logout.php">logout</a>
            <p>new <a href="login.php">login</a> or <a href="user.php">register</a></p>
        </div>
    </div>


</body>

</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?><?php 
session_start();
$conn = new mysqli('localhost','root','','userauthentication');
if(!$conn){
    die("Database Connection Failed");
}
$user_id = $_SESSION['user_id'];

if (isset($_SESSION['user_email']) && isset($_SESSION['user_password'])) {

 ?>
<!DOCTYPE html>
<html>

<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="profile">
            <?php
         $select = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['user_image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['user_image'].'">';
         }
      ?>
            <h3>Hello, <?php echo $_SESSION['user_name']; ?></h3>
            <a href="update_profile.php" class="btn">update profile</a>
            <a class="delete-btn" href="logout.php">logout</a>
            <p>new <a href="login.php">login</a> or <a href="user.php">register</a></p>
        </div>
    </div>


</body>

</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>
