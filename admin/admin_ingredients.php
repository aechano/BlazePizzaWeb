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
      <input type="text" class="box" required maxlength="100" placeholder="enter ingredient name" name="name">
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="add ingredient" class="btn" name="add_product">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">ingredients added</h1>

   <div class="box-container">

   <div class="box">
      <img src="" alt="image here">
      <div class="name">name here</div>
      <div class="flex-btn">
         <a href="admin_ingredients_update.php" class="option-btn">update</a>
         <a href="admin_ingredients.php" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>

   
   </div>

</section>



<script src="js/admin_script.js"></script>

</body>
</html>