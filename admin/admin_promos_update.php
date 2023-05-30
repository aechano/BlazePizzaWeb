<?php

include '../app/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_promo'])){

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

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_images/'.$image;

   $desc = $_POST['desc'];
   $desc = filter_var($desc, FILTER_SANITIZE_STRING);

   $update_promo = $conn->prepare("UPDATE `promos` SET promoCode = ?, promoName = ?, promoType = ?, minPrice = ?, rewards = ?, availability = ?, description = ? WHERE promoCode = ?");
   $update_promo->execute([$code, $name, $type, $min_price, $rewards, $availability, $desc, $code]);


   $message[] = 'promo updated successfully!';

   if(!empty($image)){
      if($image_size > 50000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `promos` SET promoImage = ? WHERE promoCode = ?");
         $update_image->execute([$image, $code]);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('uploaded_images/'.$old_image);
         $message[] = 'image updated successfully!';
      }
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Blaze Pizza - Update Promos</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php' ?>

<section class="update-product">

   <h1 class="heading">update promo</h1>
   <?php
      $update_id = $_GET['update'];
      $select_promos = $conn->prepare("SELECT * FROM `promos` WHERE promoCode = ?");
      $select_promos->execute([$update_id]);
      if($select_promos->rowCount() > 0){
         while($fetch_promos = $select_promos->fetch(PDO::FETCH_ASSOC)){ 
   ?>

   <form action="" enctype="multipart/form-data" method="post">
   <input type="hidden" name="code" value="<?= $fetch_promos['promoCode']; ?>">

      <input type="hidden" name="old_image" value="<?= $fetch_promos['promoImage']; ?>">

      <img src="uploaded_images/<?= $fetch_promos['promoImage']; ?>" alt="">

      <input type="text" class="box" required maxlength="100" placeholder="enter promo name" name="name" value="<?= $fetch_promos['promoName']; ?>">

      <input type="text" class="box" required maxlength="100" placeholder="enter promo type" name="type" value="<?= $fetch_promos['promoType']; ?>">

      <input type="number" min="0" class="box" required max="9999999999" placeholder="enter minimum price" onkeypress="if(this.value.length == 10)return false;" name="min_price" value="<?= $fetch_promos['minPrice']; ?>">

      <input type="number" min="0" class="box" required max="9999999999" placeholder="enter discount" onkeypress="if(this.value.length == 10)return false;" name="rewards" value="<?= $fetch_promos['rewards']; ?>">

      <input type="number" min="0" class="box" required max="9999999999" placeholder="enter number of availability" onkeypress="if(this.value.length == 10)return false;" name="availability" value="<?= $fetch_promos['availability']; ?>">

      <input type="text" class="box" required maxlength="1000" placeholder="enter promo description" name="desc" value="<?= $fetch_promos['description']; ?>">

      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      
      <div class="flex-btn">
         <input type="submit" value="update promo" class="btn" name="update_promo">
         <a href="admin_promos.php" class="option-btn">go back</a>
      </div>
   </form>

   <?php
         }
      }else{
         echo '<p class="empty">no promo found!</p>';
      }
   ?>


</section>




<script src="../js/admin_script.js"></script>

</body>
</html>