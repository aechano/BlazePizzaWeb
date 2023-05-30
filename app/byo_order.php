
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

?>

<!DOCTYPE html>
<html>

  <head>
    <title>Blaze Pizza</title>
    <?php include 'header.php';?>
    <link rel="stylesheet" href="../css/byo_order.css">
    <<!-- link rel="stylesheet" href="../css/fixed_order.css">  -->
  </head>

	<body>
    <?php include 'navigation.php';?>

    <div class="content">
      <div class="container">

        <?php

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

            <div class="choose-ing">

              <div class="prdTitle">
              <p> <?php echo $fetch_product['productName'] ?> </p>
              </div>
             
              <form id="form">

                <div class="mm-dropdown">
                  <div class="textfirst"> Choose Your Dough </div>
                    <div class="ingredients-content">
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
                </div>  

                <br> 

                <div class="mm-dropdown">
                  <div class="textfirst">Choose Your Sauce</div>
                  <div class="ingredients-content">
                    <?php
                    $count_ingredients = $conn->prepare("SELECT * FROM `ingredients` WHERE ingredientsCategory = ?");
                    $count_ingredients->execute(['Sauce']);
                    $total_ingredients = $count_ingredients->rowCount();
                    if($total_ingredients > 0){
                      for($i=1;$i<=$total_ingredients;$i++){   
                          $fetch_ingredients = $count_ingredients->fetch(PDO::FETCH_ASSOC);
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
                </div>

                <br>

                <div class="mm-dropdown">
                  <div class="textfirst">Choose Your Cheese</div>
                  <div class="ingredients-content">
                    <?php
                    $count_ingredients = $conn->prepare("SELECT * FROM `ingredients` WHERE ingredientsCategory = ?");
                    $count_ingredients->execute(['Cheese']);
                    $total_ingredients = $count_ingredients->rowCount();
                    if($total_ingredients > 0){
                      for($i=1;$i<=$total_ingredients;$i++){   
                          $fetch_ingredients = $count_ingredients->fetch(PDO::FETCH_ASSOC);
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
                </div>

                <br>

                <div class="mm-dropdown">
                  <div class="textfirst">Choose Your Meat</div>
                  <div class="ingredients-content">
                   <?php
                    $count_ingredients = $conn->prepare("SELECT * FROM `ingredients` WHERE ingredientsCategory = ?");
                    $count_ingredients->execute(['Meat']);
                    $total_ingredients = $count_ingredients->rowCount();
                    if($total_ingredients > 0){
                      for($i=1;$i<=$total_ingredients;$i++){   
                          $fetch_ingredients = $count_ingredients->fetch(PDO::FETCH_ASSOC);
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
                </div>
               
                <br>
                
                <div class="mm-dropdown">
                  <div class="textfirst">Choose Your Veggies</div>
                  <div class="ingredients-content">
                   <?php
                    $count_ingredients = $conn->prepare("SELECT * FROM `ingredients` WHERE ingredientsCategory = ?");
                    $count_ingredients->execute(['Veggies']);
                    $total_ingredients = $count_ingredients->rowCount();
                    if($total_ingredients > 0){
                      for($i=1;$i<=$total_ingredients;$i++){   
                          $fetch_ingredients = $count_ingredients->fetch(PDO::FETCH_ASSOC);
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
                </div>

                <br>

                <div class="mm-dropdown">
                  <div class="textfirst">Choose Your Finishes</div>
                  <div class="ingredients-content">
                    <?php
                      $count_ingredients = $conn->prepare("SELECT * FROM `ingredients` WHERE ingredientsCategory = ?");
                      $count_ingredients->execute(['Finishes']);
                      $total_ingredients = $count_ingredients->rowCount();
                      if($total_ingredients > 0){
                        for($i=1;$i<=$total_ingredients;$i++){   
                            $fetch_ingredients = $count_ingredients->fetch(PDO::FETCH_ASSOC);
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
                </div>

                <br>
                <br>
              
                <div class="special-instruction textfirst6">QUANTITY</div>

                <input type="hidden" name="id" value="<?php echo $product_id ?>">

                <div class="input-group">
                  <span class="input-group-btn">
                      <button class="btn btn-default btn-subtract" type="button">-</button>
                  </span>
                  <input type="text" class="form-control no-padding text-center item-quantity" value="1" name="quantity">
                  <span class="input-group-btn">
                      <button class="btn btn-default btn-add" type="button">+</button>
                  </span>
                </div>
              </form>
               <div class="lower-layout">
                  <!-- <button id="order_now" class="order-now-add-to-cart">ORDER NOW</button> -->
                  <button id="add_to_cart" class="order-now-add-to-cart">ADD TO CART</button>
                </div>
            </div>

            <div class="order-image">
              <div class="order-image-content">
                <div id="message"></div>
                <?php
                  $select_product = $conn->prepare("SELECT * FROM `product` WHERE productID = ?");
                  $select_product->execute([$product_id]);
                  if($select_product->rowCount() > 0){
                      $fetch_product = $select_product->fetch(PDO::FETCH_ASSOC);
                  }
                  if (isset($fetch_product['image'])){
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
    </div>

    <?php include 'footer.php';?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/byo_order.js"></script>
    <script type="text/javascript" src="../js/script.js"></script>
	</body>
</html>