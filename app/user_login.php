<?php

include 'config.php';

session_start();

if(isset($_POST['login'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `customer` WHERE custEmail = ? AND custPassword = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['customerID'] = $row['customerID'];
      header('location:index.php');
   }else{
      header('location:login.php');
   }

}

?>