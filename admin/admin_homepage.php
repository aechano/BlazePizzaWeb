<?php

include '../app/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Blaze Pizza - Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
    <?php include 'admin_header.php' ?>

        <section class="dashboard">

        <h1 class="heading">dashboard</h1>

        <div class="box-container">

            <div class="box">
            <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `order` WHERE orderStatus = ?");
            $select_pendings->execute(['pending']);
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['orderAmount'];
               }
            }
         ?>
                <h3>$<?= $total_pendings; ?>/-</h3>
                <p>total pendings</p>
                <a href="admin_orders.php" class="btn">see orders</a>
            </div>

            <div class="box">
            <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `order` WHERE orderStatus = ?");
            $select_completes->execute(['paid']);
            if($select_completes->rowCount() > 0){
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['orderAmount'];
               }
            }
         ?>
                <h3>$<?= $total_completes; ?>/-</h3>
                <p>completed orders</p>
                <a href="admin_orders.php" class="btn">see orders</a>
            </div>

      <div class="box">
         <?php
            $select_products = $conn->prepare("SELECT * FROM `product`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount() 
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>products added</p>
         <a href="admin_products.php" class="btn">see products</a>
      </div>
      <div class="box">
         <?php
            $select_ingredients = $conn->prepare("SELECT * FROM `ingredients`");
            $select_ingredients->execute();
            $number_of_ingredients = $select_ingredients->rowCount()
         ?>

                <h3><?= $number_of_ingredients; ?></h3>
                <p>ingredients added</p>
                <a href="admin_ingredients.php" class="btn">see ingredients</a>
            </div>

            <div class="box">
         <?php
            $select_orders = $conn->prepare("SELECT * FROM `order`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
         ?>
         <h3><?= $number_of_orders; ?></h3>
         <p>orders placed</p>
         <a href="admin_orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
         <?php
            $select_promos = $conn->prepare("SELECT * FROM `promos`");
            $select_promos->execute();
            $number_of_promos = $select_promos->rowCount()
         ?>
         <h3><?= $number_of_promos; ?></h3>
         <p>promos added</p>
         <a href="admin_promos.php" class="btn">see promos</a>
      </div>

            <div class="box">
            <?php
            $select_email = $conn->prepare("SELECT custEmail FROM `customer`");
            $select_email->execute();
            $number_of_email = $select_email->rowCount()
         ?>
                <h3><?= $number_of_email;?></h3>
                <p>emails</p>
                <a href="emails.php" class="btn">see emails</a>
            </div>

            <div class="box">
                
                <h3>0</h3>
                <p>ewallet users</p>
                <a href="ewallet_users.php" class="btn">see ewallet</a>
            </div>

            <div class="box">
                <?php
                  $select_users = $conn->prepare("SELECT * FROM `customer`");
                  $select_users->execute();
                  $number_of_users = $select_users->rowCount()
               ?>
                <h3><?= $number_of_users;?></h3>
                <p>total users</p>
                <a href="user_accounts.php" class="btn">see users</a>
            </div>

            <div class="box">
            <?php
            $select_admin = $conn->prepare("SELECT * FROM `admin`");
            $select_admin->execute();
            $number_of_admin = $select_admin->rowCount()
         ?>
                <h3><?= $number_of_admin;?></h3>
                <p>total admins</p>
                <a href="admin_accounts.php" class="btn">see admins</a>
            </div>
            

        </div>

        </section>



<script type="text/javascript" src="../js/admin_script.js"></script>

</body>
</html>