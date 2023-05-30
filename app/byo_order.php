
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

    var_dump($_POST);

    $_POST['dough'] = isset($_POST['dough']) ? $_POST['dough'] : "";
    $_POST['sauce'] = isset($_POST['sauce']) ? $_POST['sauce'] : "";  
    $_POST['cheese'] = isset($_POST['cheese']) ? $_POST['cheese'] : ""; 
    $_POST['meat'] = isset($_POST['meat']) ? $_POST['meat'] : "";
    $_POST['veggies'] = isset($_POST['veggies']) ? $_POST['veggies'] : "";
    $_POST['finishes'] = isset($_POST['finishes']) ? $_POST['finishes'] : "";

    if($_POST['dough'] == "" && $_POST['sauce'] == "" && $_POST['cheese'] == "" && $_POST['meat'] == "" && $_POST['veggies'] == "" && $_POST['finishes'] == "") {
      $has_error = true;
      $message = 'Please select ingredients!';
    } else {
      $add_to_cart = $conn->prepare("INSERT INTO `orderitemcart`(productID, customerID, OICartQty) VALUES(?,?,?)");
      $add_to_cart->execute([$_POST['prod_id'], $_SESSION['customerID'], $_POST['quantity']]);

      $add_to_cart = $conn->prepare("INSERT INTO `orderingredientscart`(`itemID`, `OICDough`, `OICSauce`, `OICCheese`, `OICMeat`, `OICVeggies`, `OICFinishes`) VALUES (?,?,?,?,?,?,?)");
      $add_to_cart->execute([$conn->lastInsertId(), $_POST['dough'], $_POST['sauce'], $_POST['cheese'], $_POST['meat'], $_POST['veggies'], $_POST['finishes']]);

      $has_error = false;
      $message = 'Added to cart!';
    
    }

    $_POST = array();

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

              <form method="post">

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
                              $fetch_ingredients = $count_ingredients->fetch(PDO::FETCH_ASSOC);
                      ?>
                      <input type="radio" id="<?= 'dough'. $i?>" name="dough" value="<?= $fetch_ingredients['ingredientsName'];?>">
                      <label for="<?= 'dough'. $i?>"><?= $fetch_ingredients['ingredientsName'];?></label><br>
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
                    <input type="radio" id="<?= 'sauce'. $i?>" name="sauce" value="<?= $fetch_ingredients['ingredientsName'];?>">
                    <label for="<?= 'sauce'. $i?>"><?= $fetch_ingredients['ingredientsName'];?></label><br>
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
                    <input type="radio" id="<?= 'cheese'. $i?>" name="cheese" value="<?= $fetch_ingredients['ingredientsName'];?>">
                    <label for="<?= 'cheese'. $i?>"><?= $fetch_ingredients['ingredientsName'];?></label><br>
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
                      <input type="radio" id="<?= 'meat'. $i?>" name="meat" value="<?= $fetch_ingredients['ingredientsName'];?>">
                      <label for="<?= 'meat'. $i?>"><?= $fetch_ingredients['ingredientsName'];?></label><br>
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
                      <input type="radio" id="<?= 'veggies'. $i?>" name="veggies" value="<?= $fetch_ingredients['ingredientsName'];?>">
                      <label for="<?= 'veggies'. $i?>"><?= $fetch_ingredients['ingredientsName'];?></label><br>
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
                      <input type="radio" id="<?= 'finishes'. $i?>" name="finishes" value="<?= $fetch_ingredients['ingredientsName'];?>">
                      <label for="<?= 'finishes'. $i?>"><?= $fetch_ingredients['ingredientsName'];?></label><br>
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
                    <!-- <button type="submit" name="order_now" class="order-now-add-to-cart">ORDER NOW</button> -->
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
                    $imagePath = '../admin/uploaded_images/' . $fetch_product['image'];
                    echo'<img class="image1" src="' . $imagePath . '" alt="">';
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