
<?php

session_start();

if(isset($_SESSION['productID'])){
   $product_id = $_SESSION['productID'];
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
  </head>

	<body>
    <?php include 'navigation.php';?>
    <div class="content">
      <div class="container">
        <div class="order-section">
            <div class="choose-ing">
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
                
                <div class="special-instruction">
                  <div class="textfirst6"> SPECIAL INSTRUCTIONS</div>
                </div>

                <section>
                  <div class="form-outline">
                      <textarea class="form-control" cols="38" rows="20"></textarea>
                  </div>
                </section> <br> 

                <div class="special-instruction textfirst6">QUANTITY</div>

                <div class="input-group">
                  <span class="input-group-btn">
                      <button class="btn btn-default btn-subtract" type="button">-</button>
                  </span>
                  <input type="text" class="form-control no-padding text-center item-quantity" value="1">
                  <span class="input-group-btn">
                      <button class="btn btn-default btn-add" type="button">+</button>
                  </span>
                </div>
                <div class="lower-layout">
                  <a href="../app/payment.php">
                    <button type="button" class="order-now-add-to-cart">ORDER NOW</button>
                  </a>
                  <a href="#">
                    <button type="button" class="order-now-add-to-cart">ADD TO CART</button>
                  </a>
                </div>
            </div>

            <div class="order-image">
              <?php
                $select_product = $conn->prepare("SELECT * FROM `product` WHERE productID = ?");
                $select_product->execute([$product_id]);
                if($select_product->rowCount() > 0){
                    while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
                      echo'<img class="image1" src="data:image/png;base64,'.base64_encode($fetch_product['productImage']).'"/>';
                    }
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