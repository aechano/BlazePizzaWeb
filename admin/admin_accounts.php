<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Blaze Pizza - Admin Accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php' ?>

<section class="accounts">

   <h1 class="heading">admin accounts</h1>

   <div class="box-container">

   <div class="box">
      <p>add new admin</p>
      <a href="admin_register.php" class="option-btn">register admin</a>
   </div>

   <div class="box">
      <p> user id : <span>user id here</span> </p>
      <p> username : <span>username here</span> </p>
      <div class="flex-btn">
         <a href="admin_accounts.php" onclick="return confirm('delete this account?')" class="delete-btn">delete</a>

      </div>
   </div>

   </div>

</section>



<script src="../js/admin_script.js"></script>

</body>
</html>