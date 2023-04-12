<?php

session_start();

if(!empty($_SESSION['login'])){
  echo $_SESSION['login'];
}else{
  header('location:login.php');
}

?>

<h3><a href="logout.php">Logout</a></h3>