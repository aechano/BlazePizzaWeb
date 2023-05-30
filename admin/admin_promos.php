<?php

include '../app/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_promo'])){

   $code = $_POST['code'];
   $code = filter_var($code, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $type = $_POST['type'];
   $type = filter_var($type, FILTER_SANITIZE_STRING);
   $min_price = $_POST['min_price'];
   $min_price = filter_var($min_price, 
   FILTER_SANITIZE_STRING);
   $rewards = $_POST['rewards'];
   $rewards = filter_var($rewards, 
   FILTER_SANITIZE_STRING);
   $availability = $_POST['availability'];
   $availability = filter_var($availability, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_images/'.$image;

   $desc = $_POST['desc'];
   $desc = filter_var($desc, FILTER_SANITIZE_STRING);

   $select_product = $conn->prepare("SELECT * FROM `promos` WHERE promoName = ?");
   $select_product->execute([$name]);

   if($select_product->rowCount() > 0){
      $message[] = 'promo name already exist!';
   }else{
      if($image_size > 100000000){
         $message[] = 'image size is too large!';
      }else{
         $insert_product = $conn->prepare("INSERT INTO `promos`(promoCode, promoName, promoType, minPrice, rewards, availability, promoImage, description) VALUES(?,?,?,?,?,?,?,?)");
         $insert_product->execute([$code, $name, $type, $min_price, $rewards, $availability, $image, $desc]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'new promo added!';
      }
   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT promoImage FROM `promos` WHERE promoCode = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_images/'.$fetch_delete_image['promoImage']);
   $delete_product = $conn->prepare("DELETE FROM `promos` WHERE promoCode = ?");
   $delete_product->execute([$delete_id]);
  /* $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:admin_products.php'); */
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Blaze Pizza - Promos</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php' ?>

<section class="add-products">

   <h1 class="heading">add promos</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="text" class="box" required maxlength="100" placeholder="enter promo code" name="code">
      <input type="text" class="box" required maxlength="100" placeholder="enter promo name" name="name">
      <input type="text" class="box" required maxlength="100" placeholder="enter promo type" name="type">
      <input type="number" min="0" class="box" required max="9999999999" placeholder="enter minimum price" onkeypress="if(this.value.length == 10)return false;" name="min_price">
      <input type="number" min="0" class="box" required max="9999999999" placeholder="enter discount" onkeypress="if(this.value.length == 10)return false;" name="rewards">
      <input type="number" min="0" class="box" required max="9999999999" placeholder="enter number of availability" onkeypress="if(this.value.length == 10)return false;" name="availability">
      <input type="text" class="box" required maxlength="1000" placeholder="enter promo description" name="desc">
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="add promo" class="btn" name="add_promo">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">promos added</h1>

   <div class="box-container">
   <?php
      $select_promo = $conn->prepare("SELECT * FROM `promos`");
      $select_promo->execute();
      if($select_promo->rowCount() > 0){
         while($fetch_promo = $select_promo->fetch(PDO::FETCH_ASSOC)){ 
   ?>

   <div class="box">
      <img src="uploaded_images/<?= $fetch_promo['promoImage']; ?>" alt="">
      <div class="name"><?= $fetch_promo['promoName']; ?></div>
      <div class="name"><?= $fetch_promo['promoCode']; ?></div>
      <div class="flex-btn">
         <a href="admin_promos_update.php?update=<?= $fetch_promo['promoCode']; ?>" class="option-btn">update</a>
         <a href="admin_promos.php?delete=<?= $fetch_promo['promoCode']; ?>" class="delete-btn" onclick="return confirm('delete this promo?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no promo added yet!</p>';
      }
   ?>

   </div>

</section>

<script type="text/javascript" src="../js/admin_script.js"></script>

</body>
</html>