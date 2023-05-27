
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
    <link rel="stylesheet" href="../css/byo_order.css">
  </head>

	<body>
    <?php include 'navigation.php';?>
    <div class="content">
      <div class="container">
        <div class="order-section">
            <div class="choose-ing">


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
              ?>

              <section>
                  <div class="mm-dropdown">
                    <div class="textfirst">
                      Choose Your Dough
                    </div>
                    <?php
                      $count_ingredients = $conn->prepare("SELECT * FROM `ingredients` WHERE ingredientsCategory = ?");
                      $count_ingredients->execute(['Dough']);
                      $total_ingredients = $count_ingredients->rowCount();
                      if($total_ingredients > 0){
                        for($i=1;$i<=$total_ingredients;$i++){   
                            $fetch_ingredients = $count_ingredients->fetch(PDO::FETCH_ASSOC)
                    ?>
                  
                    <ul>
                      <li class="input-option" data-value=<?=$i?>>
                          <?php
                            echo'<img src="data:image/png;base64,' .base64_encode($fetch_ingredients['ingredientsImage']).'"/>';
                          ?>
                          <span><?= $fetch_ingredients['ingredientsName'];?></span>
                      </li>                   
                    </ul>
                    <input type="hidden" class="option" name="namesubmit" value="" data-input="0" />

                    <?php
                              }
                          }else{
                              echo '<p class="empty">no available ingredients</p>';
                          }
                      ?>
                  </div>  
              </section>

              <br> 

              <section>
                <div class="mm-dropdown1">
                  <div class="textfirst1">Choose Your Sauce</div>
                  <?php
                    $count_ingredients = $conn->prepare("SELECT * FROM `ingredients` WHERE ingredientsCategory = ?");
                    $count_ingredients->execute(['Sauce']);
                    $total_ingredients = $count_ingredients->rowCount();
                    if($total_ingredients > 0){
                      for($i=1;$i<=$total_ingredients;$i++){   
                          $fetch_ingredients = $count_ingredients->fetch(PDO::FETCH_ASSOC)
                  ?>

                  <ul>
                    <li class="input-option" data-value=<?=$i?>>
                        <?php
                          echo'<img src="data:image/png;base64,' .base64_encode($fetch_ingredients['ingredientsImage']).'"/>';
                        ?>
                        <span><?= $fetch_ingredients['ingredientsName'];?></span>
                    </li>                   
                  </ul>
                  <input type="hidden" class="option" name="namesubmit" value="" />

                  <?php
                            }
                        }else{
                            echo '<p class="empty">no available ingredients</p>';
                        }
                  ?>
                </div>
              </section>

              <br>

              <section>
                <div class="mm-dropdown2">
                  <div class="textfirst2">Choose Your Cheese</div>
                  <?php
                    $count_ingredients = $conn->prepare("SELECT * FROM `ingredients` WHERE ingredientsCategory = ?");
                    $count_ingredients->execute(['Cheese']);
                    $total_ingredients = $count_ingredients->rowCount();
                    if($total_ingredients > 0){
                      for($i=1;$i<=$total_ingredients;$i++){   
                          $fetch_ingredients = $count_ingredients->fetch(PDO::FETCH_ASSOC)
                  ?>

                  <ul>
                    <li class="input-option" data-value=<?=$i?>>
                        <?php
                          echo'<img src="data:image/png;base64,' .base64_encode($fetch_ingredients['ingredientsImage']).'"/>';
                        ?>
                        <span><?= $fetch_ingredients['ingredientsName'];?></span>
                    </li>                   
                  </ul>
                  <input type="hidden" class="option" name="namesubmit" value="" />

                  <?php
                            }
                        }else{
                            echo '<p class="empty">no available ingredients</p>';
                        }
                  ?>
                </div>
              </section>

              <br>

              <section>
                <div class="mm-dropdown3">
                  <div class="textfirst3">Choose Your Meat</div>
                    <?php
                      $count_ingredients = $conn->prepare("SELECT * FROM `ingredients` WHERE ingredientsCategory = ?");
                      $count_ingredients->execute(['Meat']);
                      $total_ingredients = $count_ingredients->rowCount();
                      if($total_ingredients > 0){
                        for($i=1;$i<=$total_ingredients;$i++){   
                            $fetch_ingredients = $count_ingredients->fetch(PDO::FETCH_ASSOC)
                    ?>

                    <ul>
                      <li class="input-option" data-value=<?=$i?>>
                          <?php
                            echo'<img src="data:image/png;base64,' .base64_encode($fetch_ingredients['ingredientsImage']).'"/>';
                          ?>
                          <span><?= $fetch_ingredients['ingredientsName'];?></span>
                      </li>                   
                    </ul>
                    <input type="hidden" class="option" name="namesubmit" value="" />

                    <?php
                              }
                          }else{
                              echo '<p class="empty">no available ingredients</p>';
                          }
                    ?>
                </div>
              </section>

              <br>
              
              <section>
                <div class="mm-dropdown4">
                  <div class="textfirst4">Choose Your Veggies</div>
                    <?php
                      $count_ingredients = $conn->prepare("SELECT * FROM `ingredients` WHERE ingredientsCategory = ?");
                      $count_ingredients->execute(['Veggies']);
                      $total_ingredients = $count_ingredients->rowCount();
                      if($total_ingredients > 0){
                        for($i=1;$i<=$total_ingredients;$i++){   
                            $fetch_ingredients = $count_ingredients->fetch(PDO::FETCH_ASSOC)
                    ?>

                    <ul>
                      <li class="input-option" data-value=<?=$i?>>
                          <?php
                            echo'<img src="data:image/png;base64,' .base64_encode($fetch_ingredients['ingredientsImage']).'"/>';
                          ?>
                          <span><?= $fetch_ingredients['ingredientsName'];?></span>
                      </li>                   
                    </ul>
                    <input type="hidden" class="option" name="namesubmit" value="" />

                    <?php
                              }
                          }else{
                              echo '<p class="empty">no available ingredients</p>';
                          }
                    ?>
                </div>
              </section>

              <br>
              <section>
                <div class="mm-dropdown5">
                  <div class="textfirst5">Choose Your Finishes</div>
                    <?php
                      $count_ingredients = $conn->prepare("SELECT * FROM `ingredients` WHERE ingredientsCategory = ?");
                      $count_ingredients->execute(['Finishes']);
                      $total_ingredients = $count_ingredients->rowCount();
                      if($total_ingredients > 0){
                        for($i=1;$i<=$total_ingredients;$i++){   
                            $fetch_ingredients = $count_ingredients->fetch(PDO::FETCH_ASSOC)
                    ?>

                    <ul>
                      <li class="input-option" data-value=<?=$i?>>
                          <?php
                            echo'<img src="data:image/png;base64,' .base64_encode($fetch_ingredients['ingredientsImage']).'"/>';
                          ?>
                          <span><?= $fetch_ingredients['ingredientsName'];?></span>
                      </li>                   
                    </ul>
                    <input type="hidden" class="option" name="namesubmit" value="" />

                    <?php
                              }
                          }else{
                              echo '<p class="empty">no available ingredients</p>';
                          }
                    ?>
                </div>
              </section>

              <br>
              
              <div class="special-instruction textfirst6">QUANTITY</div>

              <form method="post">

                <input type="hidden" name="prod_id" value="<?php echo $product_id ?>">
                <input type="hidden" name="order_type" value="0">

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

            <div class="order-image">
              <?php
                $select_product = $conn->prepare("SELECT * FROM `product` WHERE productID = ?");
                $select_product->execute([$product_id]);
                if($select_product->rowCount() > 0){
                    $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);
                }
                if (isset($fetch_product['productImage'])){
                  echo'<img class="image1" src="data:image/png;base64,'.base64_encode($fetch_product['productImage']).'"/>';
                }else{
                  echo'<p class="empty">No image selected</p>';
                }
              ?>
              
            </div>

          </div>
        </div>
    </div>

    <?php include 'footer.php';?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/byo_order.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
	</body>
</html>