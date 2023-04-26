<?php
session_start();
$conn = new mysqli('localhost','root','','userauthentication');
if(!$conn){
    die("Database Connection Failed");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$select = mysqli_query($conn, $sql) or die('query failed');
if($select->num_rows > 0){
  $fetch = mysqli_fetch_assoc($select);
}

if(isset($_POST['update_profile'])){
   $fields = [];
   $errorMessages = [];
   $successMessage = '';
 
   $selectSql = "SELECT * FROM users WHERE user_id = '$user_id'";
   $selectResult = mysqli_query($conn, $selectSql);
   if (mysqli_num_rows($selectResult) > 0) {
     $fetch = mysqli_fetch_assoc($selectResult);
   }
 
   $updateName = mysqli_real_escape_string($conn, $_POST['update_name']);
   $updateEmail = mysqli_real_escape_string($conn, $_POST['update_email']);
   $oldPassword = mysqli_real_escape_string($conn, $_POST['old_password']);
   $newPassword = mysqli_real_escape_string($conn, $_POST['new_password']);
   $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);
   $updateImage = $_FILES['update_image'];
 
   if (empty($updateName)) {
     $errorMessages[] = 'Name is required.';
   }
   elseif ($updateName == $fetch['user_name']) {
   }
   else {
     $fields['user_name'] = $updateName;
   }
 
   if (empty($updateEmail)) {
     $errorMessages[] = 'Email is required.';
   }
   elseif ($updateEmail == $fetch['user_email']) {
   }
   else {
     $fields['user_email'] = $updateEmail;
   }
 
   if (empty($oldPassword)) {
     $errorMessages[] = 'Old password is required.';
   }
   elseif ($fetch['user_password'] != md5($oldPassword)) {
     $errorMessages[] = 'Old password does not match.';
   }
   elseif (empty($newPassword)) {
     $errorMessages[] = 'New password is required.';
   }
   elseif (empty($confirmPassword)) {
     $errorMessages[] = 'Confirm password is required.';
   }
   elseif ($newPassword != $confirmPassword) {
     $errorMessages[] = 'New password and comfirm password do not match.';
   }
   else {
     $fields['user_password'] = md5($newPassword);
   }
 
   if (empty($updateImage)) {
     $errorMessages[] = 'Image is required.';
   }
   elseif ($updateImage['error'] == 4) {
   }
   elseif ($updateImage['size'] > 2000000) {
     $errorMessages[] = 'Image is too large.';
   }
   else {
     $updateImagePath = 'uploaded_img/' . $updateImage['name'];
     move_uploaded_file($updateImage['tmp_name'], $updateImagePath);
     $fields['user_image'] = $updateImagePath;
   }
 
   if (!empty($fields) && empty($errorMessages)) {
     $updateSql = "UPDATE `users` SET ";
     foreach($fields as $key => $value) {
       $updateSql .= "$key = '$value'";
 
       if ($key != array_key_last($fields)) {
         $updateSql .= ", ";
       }
     }
     $updateSql .= " WHERE user_id = $user_id";
 
     mysqli_query($conn, $updateSql);
     if (mysqli_affected_rows($conn)) {
       $successMessage = 'Updated successfully.';
     }
   }
 }
 
 $selectSql = "SELECT * FROM users WHERE user_id = '$user_id'";
 $selectResult = mysqli_query($conn, $selectSql);
 if (mysqli_num_rows($selectResult) > 0) {
   $fetch = mysqli_fetch_assoc($selectResult);
   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>update profile</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css" />

</head>

<body>

    <div class="update-profile">

        <?php
      $select = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

        <form action="" method="post" enctype="multipart/form-data">
            <?php
         if($fetch['user_image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="'.$fetch['user_image'].'">';
         }
         
         if (isset($errorMessages)) {
            foreach($errorMessages as $errorMessage){
               echo '<div class="message">' . $errorMessage . '</div>';
            }
         }

         if (isset($successMessage)) {
           echo '<div class="message">' . $successMessage . '</div>';
         }
      ?>
            <div class="flex">
                <div class="inputBox">
                    <span>username :</span>
                    <input type="text" name="update_name" value="<?php echo $fetch['user_name']; ?>" class="box" />
                    <span>your email :</span>
                    <input type="email" name="update_email" value="<?php echo $fetch['user_email']; ?>" class="box" />
                    <span>update your pic :</span>
                    <input type="file" name="update_image" value="<?php echo $image; ?>"
                        accept="image/jpg, image/jpeg, image/png" class="box" />
                </div>
                <div class="inputBox">
                    <span>old password :</span>
                    <input type="password" name="old_password" placeholder="enter old password" class="box" />
                    <span>new password :</span>
                    <input type="password" name="new_password" placeholder="enter new password" class="box" />
                    <span>confirm password :</span>
                    <input type="password" name="confirm_password" placeholder="confirm new password" class="box" />
                </div>
            </div>
            <input type="submit" value="update profile" name="update_profile" class="btn" />
            <a href="home.php" class="delete-btn">go back</a>
        </form>

    </div>

</body>

</html>
