
<?php

  include 'config.php';
  if(!isset($_SESSION)) { 
      session_start(); 
  } 

  if(isset($_GET['id'])){
    $product_id = $_GET['id'];

  }else{
    $product_id = '';
  };

  if(isset($_POST['order_now'])) {
    if(isset($_SESSION['customerID'])) {
      $url = "../app/payment.php?id=".$_POST['prod_id']."&quantity=".$_POST['quantity']."&type=".$_POST['order_type'];
      header("Location: $url");
      exit();
    } else {
      $has_error = true;
      $message = 'Please register or login!';
    }
  }

  if(isset($_POST['add_to_cart'])) {
    if(isset($_SESSION['customerID'])) {

      $product = $conn->prepare("SELECT * FROM `orderitemcart` WHERE productID = ? AND customerID = ?");
      $product->execute([$_POST['prod_id'], $_SESSION['customerID']]);

      if($product->rowCount() == 0) {
        $add_to_cart = $conn->prepare("INSERT INTO `orderitemcart`(productID, customerID, OICartQty) VALUES(?,?,?)");
        $add_to_cart->execute([$_POST['prod_id'], $_SESSION['customerID'], $_POST['quantity']]);
      } else {
        $details = $product->fetch(PDO::FETCH_ASSOC);
        $sum = $details['OICartQty'] + $_POST['quantity'];
        $add_to_cart = $conn->prepare("UPDATE `orderitemcart` SET OICartQty = ? WHERE productID = ? AND customerID = ?");
        $add_to_cart->execute([$sum, $_POST['prod_id'], $_SESSION['customerID']]);
      }

      $has_error = false;
      $message = 'Added to cart!';

    } else {
      $has_error = true;
      $message = 'Please register or login!';
    }
  }

?>

<!DOCTYPE html>
<html>

  <head>
    <title>Blaze Pizza</title>
    <?php include 'header.php';?>
    <link rel="stylesheet" href="../css/fixed_order.css"> 
  </head>

	<body>
    <?php include 'navigation.php';?>

    <div class="content">
      <div class="container">

        <?php
          if(isset($message) && $message != "") {
              if($has_error) {
                echo '<div id="info" class="error">';
              } else {
                echo '<div id="info" class="success">';
              }
              echo '<p>'.$message.'</p>';
              echo '</div>';
          }

          $select_product = $conn->prepare("SELECT * FROM `product` WHERE productID = ?");
            $select_product->execute([$product_id]);
            if($select_product->rowCount() > 0){
              $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);
            } else {
              echo '<div class="error">';
              echo '<p>No product selected!</p>';
              echo '</div>';
              return;
            }

        ?>

        <div class="order-section">

          <div class="infosec">
            <div class="prdTitle">
              <p> <?php echo $fetch_product['productName'] ?> </p>
            </div>
            <div class="prdesc">
              <p> <?php echo $fetch_product['productDesc'] ?></p>
            </div>
            <br><br>

            <form method="post">

              <input type="hidden" name="prod_id" value="<?php echo $product_id ?>">
              <input type="hidden" name="order_type" value="0">

              <div class="special-instruction textfirst6">QUANTITY</div>

              <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-default btn-subtract" type="button">-</button>
                </span>
                <input type="text" class="form-control no-padding text-center item-quantity" value="1" name="quantity">
                <span class="input-group-btn">
                    <button class="btn btn-default btn-add" type="button">+</button>
                </span>
              </div>

              <div class="lower-layout">
                  <button type="submit" name="order_now" class="order-now-add-to-cart">ORDER NOW</button>
                  <button type="submit" name="add_to_cart" class="order-now-add-to-cart">ADD TO CART</button>
              </div>

            </form>

          </div>
          
          <div class="order-image" style="background-image: url(); ">
            <?php
              if (isset($fetch_product['productImage'])) {
                echo'<img class="image1" src="data:image/png;base64,'.base64_encode($fetch_product['productImage']).'"/>';
              } 
            ?>
          </div>
        </div>
      </div>
    </div>

    <?php include 'footer.php';?>

    <script type="text/javascript" src="../js/fixed_order.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
	</body>
</html>