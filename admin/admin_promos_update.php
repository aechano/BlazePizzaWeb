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

   <form action="" enctype="multipart/form-data" method="post">
      <input type="hidden" name="pid" value="id here"> 
      <input type="hidden" name="old_image" value="old image here">
      <img src="" alt="to be update na image here">
      <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name" value="to be update na pangalan ng promo here">
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
      <div class="flex-btn">
         <input type="submit" value="update promo" class="btn" name="update_product">
         <a href="admin_promos.php" class="option-btn">go back</a>
      </div>
   </form>


</section>




<script src="../js/admin_script.js"></script>

</body>
</html>