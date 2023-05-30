<?php

include '../app/config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){

   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `order` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:admin_orders.php');
}

?>


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