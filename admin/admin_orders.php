<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Blaze Pizza - Orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php' ?>

<section class="orders">

<h1 class="heading">placed orders</h1>

<div class="box-container">
   <div class="box">
      <p> PLACED ON : <span>placed on</span> </p>
      <p> NAME : <span>name here</span> </p>
      <p> NUMBER : <span>contact number here</span> </p>
      <p> ADDRESS : <span>address here</span> </p>
      <p> TOTAL PRODUCTS : <span>total products here</span> </p>
      <p> TOTAL PRICE : <span>total price here</span> </p>
      <p> PAYMENT METHOD : <span>payment method here</span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="payment_status" class="select">
            <option selected disabled>payment status here</option>
            <option value="pending">PENDING</option>
            <option value="completed">COMPLETED</option>
         </select>
        <div class="flex-btn">
         <input type="submit" value="update" class="option-btn" name="update_payment">
         <a href="admin_orders.php" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
        </div>
      </form>
   </div>

</div>

</section>



<script src="../js/admin_script.js"></script>

</body>
</html>