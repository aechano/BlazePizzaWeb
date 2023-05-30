<?php

include '../app/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM ewallet WHERE eWalletID = ?");
   $delete_order->execute([$delete_id]);
   header('location:ewallet_users.php');
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Blaze Pizza - User Accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php' ?>

<section class="accounts">

   <h1 class="heading">user accounts</h1>

   <div class="box-container">
      
   <?php
      $select_accounts = $conn->prepare("SELECT * FROM ewallet");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>

<div class="box">
      <p> E-wallet ID : <span><?= $fetch_accounts['eWalletID']; ?></span> </p>
      <p> Customer ID : <span><?= $fetch_accounts['customerID']; ?></span> </p>
      <a href="ewallet_users.php?delete=<?= $fetch_accounts['eWalletID']; ?>" onclick="return confirm('delete this account?')" class="delete-btn">delete</a>
   </div>

   <?php
         }
      }else{
         echo '<p class="empty">no accounts available!</p>';
      }
   ?>


   </div>

</section>


<script src="../js/admin_script.js"></script>

</body>
</html> 