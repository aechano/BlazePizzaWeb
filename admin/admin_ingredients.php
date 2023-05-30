<?php

include '../app/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_ingredient'])){

   $categ = $_POST['categ'];
   $categ = filter_var($categ, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $qty = $_POST['qty'];
   $qty = filter_var($qty, 
   FILTER_SANITIZE_STRING);
   
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_images/'.$image;

   $select_ingredients = $conn->prepare("SELECT * FROM `ingredients` WHERE ingredientsName = ?");
   $select_ingredients->execute([$name]);

   if($select_ingredients->rowCount() > 0){
      $message[] = 'ingredient name already exist!';
   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert_ingredients = $conn->prepare("INSERT INTO `ingredients`(ingredientsCategory, ingredientsName, ingredientsQty, ingImage) VALUES(?,?,?,?)");
         $insert_ingredients->execute([$categ, $name, $qty, $image]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'new ingredient added!';
      }
   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT ingImage FROM `ingredients` WHERE ingredientsID = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_images/'.$fetch_delete_image['ingImage']);
   $delete_product = $conn->prepare("DELETE FROM `ingredients` WHERE ingredientsID = ?");
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
   <title>Blaze Pizza - Ingredients</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php' ?>

<section class="add-products">

   <h1 class="heading">add ingredients</h1>

   <form action="" method="post" enctype="multipart/form-data">
   <input type="text" class="box" required maxlength="100" placeholder="enter ingredient category" name="categ">
      <input type="text" class="box" required maxlength="100" placeholder="enter ingredient name" name="name">
      <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product quantity" onkeypress="if(this.value.length == 10)return false;" name="qty">
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="add ingredient" class="btn" name="add_product">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">ingredients added</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `ingredients`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>

   <div class="box">
   <img src="uploaded_images/<?= $fetch_products['ingImage']; ?>" alt="">
   <div class="name"><?= $fetch_products['ingredientsName']; ?></div>
      <div class="flex-btn">
         <a href="admin_ingredients_update.php?update=<?= $fetch_products['ingredientsID']; ?>" class="option-btn">update</a>
         <a href="admin_ingredients.php?delete=<?= $fetch_products['ingredientsID']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>

   <?php
         }
      }else{
         echo '<p class="empty">no ingredient added yet!</p>';
      }
   ?>

   
   </div>

</section>



<script type="text/javascript" src="../js/admin_script.js"></script>

</body>
</html>