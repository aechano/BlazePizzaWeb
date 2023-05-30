<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>


<header class="header">

<section class="flex">
   <a href="admin_homepage.php" class="logo">Blaze<span>Pizza</span></a>

   <nav class="navbar">
      <a href="admin_homepage.php">home</a>
      <a href="admin_products.php">products</a>
      <a href="admin_ingredients.php">ingredients</a>
      <a href="admin_orders.php">orders</a>
      <a href="admin_promos.php">promos</a>
      <a href="emails.php">email</a>
      <a href="ewallet_users.php">ewallet</a>
      <a href="user_accounts.php">users</a>
      <a href="admin_accounts.php">admins</a>
   </nav>

   <div class="icons">
      <div id="menu-btn" class="fas fa-bars"></div>
      <div id="user-btn" class="fas fa-user"></div>
   </div>

   <div class="profile">
   <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="admin_profile_update.php" class="btn">update profile</a>
      <a href="admin_login.php" class="delete-btn">logout</a>
      <div class="flex-btn">
         <a href="admin_login.php" class="option-btn">login</a>
         <a href="admin_register.php" class="option-btn">register</a>
      </div>
   </div>
</section>

</header>