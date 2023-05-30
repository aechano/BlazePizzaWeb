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
   $update_payment = $conn->prepare("UPDATE `order` SET paymentStatus = ? WHERE orderID = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `order` WHERE orderID = ?");
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
<?php
      $select_orders = $conn->prepare("SELECT * FROM `order`");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> Order Amount : <span><?= $fetch_orders['orderAmount']; ?></span> </p>
      <p> Order Status : <span><?= $fetch_orders['orderStatus']; ?></span> </p>
      <p> Payment Type : <span><?= $fetch_orders['paymentType']; ?></span> </p>
      <p> Payment Status : <span><?= $fetch_orders['paymentStatus']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['orderID']; ?>">
         <select name="payment_status" class="select">
            <option selected disabled><?= $fetch_orders['paymentStatus']; ?></option>
            <option value="pending">PENDING</option>
            <option value="completed">COMPLETED</option>
         </select>
        <div class="flex-btn">
         <input type="submit" value="update" class="option-btn" name="update_payment">
         <a href="admin_orders.php" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
        </div>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
   ?>

</div>

</section>



<script src="../js/admin_script.js"></script>

</body>
</html>