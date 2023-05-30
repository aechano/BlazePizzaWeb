<?php

include '../app/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_ingredients'])){

   $pid = $_POST['pid'];
   $categ = $_POST['categ'];
   $categ = filter_var($categ, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $qty = $_POST['qty'];
   $qty = filter_var($qty, 
   FILTER_SANITIZE_STRING);

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_images/'.$image;

   $update_ingredients = $conn->prepare("UPDATE `ingredients` SET ingredientsCategory = ?, ingredientsName = ?, ingredientsQty = ? WHERE ingredientsID = ?");
   $update_ingredients->execute([$categ, $name, $qty, $pid]);

   $message[] = 'ingredient updated successfully!';

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `ingredients` SET ingImage = ? WHERE ingredientsID = ?");
         $update_image->execute([$image, $pid]);
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
   <title>Blaze Pizza - Update Ingredients</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php' ?>

<section class="update-product">

   <h1 class="heading">update ingredient</h1>
   <?php
      $update_id = $_GET['update'];
      $select_ingredients = $conn->prepare("SELECT * FROM `ingredients` WHERE ingredientsID = ?");
      $select_ingredients->execute([$update_id]);
      if($select_ingredients->rowCount() > 0){
         while($fetch_ingredients = $select_ingredients->fetch(PDO::FETCH_ASSOC)){ 
   ?>

<form action="" enctype="multipart/form-data" method="post">
   <input type="hidden" name="pid" value="<?= $fetch_ingredients['ingredientsID']; ?>">

      <input type="hidden" name="old_image" value="<?= $fetch_ingredients['ingImage']; ?>">

      <img src="uploaded_images/<?= $fetch_ingredients['ingImage']; ?>" alt="">

      <input type="text" class="box" required maxlength="100" placeholder="enter ingredient category" name="categ" value="<?= $fetch_ingredients['ingredientsCategory']; ?>">

      <input type="text" class="box" required maxlength="100" placeholder="enter ingredient name" name="name" value="<?= $fetch_ingredients['ingredientsName']; ?>">

      <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product quantity" onkeypress="if(this.value.length == 10) return false;" name="qty" value="<?= $fetch_ingredients['ingredientsQty']; ?>">


      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
      <div class="flex-btn">
         <input type="submit" value="update ingredient" class="btn" name="update_ingredients">
         <a href="admin_ingredients.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no ingredient found!</p>';
      }
   ?>


</section>




<script src="../js/admin_script.js"></script>

</body>
</html>