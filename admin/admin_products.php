<?php

include '../app/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $type = $_POST['type'];
   $type = filter_var($type, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, 
   FILTER_SANITIZE_STRING);
   $qty = $_POST['qty'];
   $qty = filter_var($qty, 
   FILTER_SANITIZE_STRING);
   $desc = $_POST['desc'];
   $desc = filter_var($desc, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_images/'.$image;

   $select_product = $conn->prepare("SELECT * FROM `product` WHERE productName = ?");
   $select_product->execute([$name]);

   if($select_product->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert_product = $conn->prepare("INSERT INTO `product`(productName, productType, productQty, productPrice, productDesc, image) VALUES(?,?,?,?,?,?)");
         $insert_product->execute([$name, $type, $qty, $price, $desc, $image]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'new product added!';
      }
   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT image FROM `product` WHERE productID = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_images/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `product` WHERE productID = ?");
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
   <title>Blaze Pizza - Products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php' ?>

<section class="add-products">

   <h1 class="heading">add product</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name">
      <input type="text" class="box" required maxlength="100" placeholder="enter product type" name="type">
      <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product quantity" onkeypress="if(this.value.length == 10)return false;" name="qty">
      <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10)return false;" name="price">
      <input type="text" class="box" required maxlength="1000" placeholder="enter product description" name="desc">
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="add product" class="btn" name="add_product">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">products added</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `product`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <div class="price">$<span><?= $fetch_products['productPrice']; ?></span>/-</div>
      <img src="uploaded_images/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['productName']; ?></div>
      <div class="flex-btn">
         <a href="admin_product_update.php?update=<?= $fetch_products['productID']; ?>" class="option-btn">update</a>
         <a href="admin_products.php?delete=<?= $fetch_products['productID']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>
   
   </div>

</section>



<script type="text/javascript" src="../js/admin_script.js"></script>

</body>
</html>