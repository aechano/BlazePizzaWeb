<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Blaze Pizza</title>
        <?php include 'header.php';?>
        <link rel="stylesheet" href="../css/payment.css">
    </head>

    <body>

        <?php include 'navigation.php';?>

        <div class="content">
            <div class="container">
                
                <main class="payment-container">

                    <div class="item-flex">
                        <section class="checkout">

                            <h2 class="section-heading">Payment Details</h2>

                            <div class="payment-form">


                                <?php

                                    $orderItems = [];
                                    if(isset($_SESSION['customerID'])) {
                                        $user_info = $conn->prepare("SELECT * FROM `customer` WHERE customerID = ?");
                                        $user_info->execute([$_SESSION['customerID']]);

                                        if($user_info->rowCount() > 0){                          
                                             $fetch_info = $user_info->fetch(PDO::FETCH_ASSOC);                                 
   
                                ?>
     

                                <form id="order_form" action="post">

                                    <div class="form-deets">
                                    <label for="cardholder-name" class="label-default">Name</label>
                                    <input type="text" value="<?php echo $fetch_info['custFname'], $fetch_info['custLname']?>" disabled="disabled" class="input-default">
                                    </div>

                                    <div class="form-deets">
                                    <label for="card-number" class="label-default">Phone Number</label>
                                    <input type="text" value="<?php echo $fetch_info['custContactNum']?>" disabled="disabled" class="input-default">
                                    </div>

                                    <div class="form-deets">
                                    <label for="card-email" class="label-default">Email Address</label>
                                    <input type="text" value="<?php echo $fetch_info['custEmail'] ?>" disabled="disabled" class="input-default">
                                    </div>

                                    <div class="form-deets">
                                    <label for="card-address" class="label-default">Address</label>
                                    <section>
                                        <div class="address-outline">
                                            <textarea id="address" class="address-textarea" disabled="disabled" rows="10"><?php echo $fetch_info['custAddress']; ?></textarea>
                                        </div>
                                    </section>

                                    <input id="order_type" name="order_type" type="hidden" value="<?= isset($_GET['type']) ? $_GET['type'] : ""?>">

                                    <!-- <label for="card-address" class="label-default">Stamps</label>
                                    <div class="stamps">
                                    </div> -->
                                </form>

                                <?php
                                        }
                                    }
                                ?>

                            </div>

                            <button class="btn btn-primary">
                                <b>Total:</b> $ <span id="payAmount">0.00</span>
                            </button>

                            <button id="submit" class="btn btn-primary">
                                <b>Proceed</b>
                                <span class="fas fa-arrow-right"></span>
                            </button>

                        </section>

                        <section class="cart">

                            <div class="cart-item-box">

                                <h2 class="section-heading">Order Summary</h2>



                                <?php

                                    $order_type = isset($_GET['type']) ? $_GET['type'] : "";
                                    if(isset($order_type) && $order_type == 0){
                                        //for single orders
                                        if (isset($_GET['id'])) {
                                            $select_orders = $conn->prepare("SELECT * FROM `product` WHERE productID = ?");
                                            $select_orders->execute([$_GET['id']]);

                                            if($select_orders->rowCount() > 0){                           
                                                for($i=0;$i<$select_orders->rowCount();$i++){   
                                                    $fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC);

                                ?>

                                <div class="<?= 'product-card product-card'.$i ?>">
                                    <div class="card">
                                        <div class="img-box">
                                           <?php
                                                $imagePath = '../admin/uploaded_images/' . $fetch_orders['image'];
                                                echo '<img src="' . $imagePath . '" alt="Pesto Garlic Cheesy Bread" width="80px" class="product-img">';
                                            ?>
                                        </div>
                                        <div class="detail">
                                            <h4 class="product-name"><?= $fetch_orders['productName'];?></h4>
                                            <div class="wrapper">
                                                <div class="product-qty">
                                                    <button id="decrement" name="<?= $i ?>">
                                                    <ion-icon name="remove-outline"></ion-icon>
                                                    </button>

                                                    <span id="quantity"><?= isset($_GET['quantity']) ?  $_GET['quantity'] :  0 ?></span>

                                                    <button id="increment" name="<?= $i ?>">
                                                    <ion-icon name="add-outline"></ion-icon>
                                                    </button>
                                                </div>
                                                <div class="price">
                                                    $ <span id="price"><?= $fetch_orders['productPrice']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="<?= 'payment_form'.$i; ?>" method="post">
                                            <input id="<?= 'id'.$i; ?>" type="hidden" name="id" value="<?= $fetch_orders['productID']; ?>">
                                            <input id="<?= 'quantity'.$i; ?>" type="hidden" name="quantity" value="<?= $_GET['quantity']; ?>">
                                            <input id="<?= 'order_type'.$i; ?>" type="hidden" name="order_type" value="<?= $_GET['type']; ?>">
                                        </form>
                                        <div id="<?= $i ?>" class="product-close-btn fas fa-times-circle"></div>
                                    </div>
                                </div>

                                <?php
                                                }
                                            }
                                        }
                                    }
                                ?>


                                <?php
                                    if(isset($order_type) && $order_type == 1) {
                                        if(isset($_SESSION['customerID'])) {
                                            $cart_items = $conn->prepare("SELECT * FROM `orderitemcart` WHERE customerID = ?");
                                            $cart_items->execute([$_SESSION['customerID']]);

                                            if($cart_items->rowCount() > 0){                           
                                                for($i=0;$i<$cart_items->rowCount();$i++){   
                                                    $fetch_orders = $cart_items->fetch(PDO::FETCH_ASSOC);

                                                    $details = $conn->prepare("SELECT * FROM `product` WHERE productID = ?");
                                                    $details->execute([$fetch_orders['productID']]);

                                                    if($details->rowCount() > 0) {
                                                        $fetch_details = $details->fetch(PDO::FETCH_ASSOC);
                                                        
                                ?>

                                <div class="<?= 'product-card product-card'.$i ?>">
                                    <div class="card">
                                        <div class="img-box">
                                            <div class="loading2" id="<?= 'loading'.$i; ?>" style="display:none;">
                                                <img src="../assets/gif/spinner.gif">
                                            </div>
                                           <?php
                                                $imagePath = '../admin/uploaded_images/' . $fetch_details['image'];
                                                echo'<img src="' . $imagePath . '" alt="Pesto Garlic Cheesy Bread" width="80px" class="product-img">';
                                            ?>
                                        </div>
                                        <div class="detail">
                                            <h4 class="product-name"><?= $fetch_details['productName'];?></h4>
                                            <div class="wrapper">
                                                <div class="product-qty">
                                                    <button id="decrement" name="<?= $i ?>">
                                                    <ion-icon name="remove-outline"></ion-icon>
                                                    </button>

                                                    <span id="quantity"><?= $fetch_orders['OICartQty']; ?></span>

                                                    <button id="increment" name="<?= $i ?>">
                                                    <ion-icon name="add-outline"></ion-icon>
                                                    </button>
                                                </div>
                                                <div class="price">
                                                    $<span id="price"> <?= $fetch_details['productPrice']; ?> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="<?= 'payment_form'.$i; ?>" method="post">
                                            <input id="<?= 'id'.$i; ?>" type="hidden" name="id" value="<?= $fetch_orders['productID']; ?>">
                                            <input id="<?= 'quantity'.$i; ?>" type="hidden" name="quantity" value="<?= $fetch_orders['OICartQty']; ?>">
                                            <input id="<?= 'order_type'.$i; ?>" type="hidden" name="order_type" value="<?= $_GET['type']; ?>">
                                        </form>
                                        <div id="<?= $i ?>" class="product-close-btn fas fa-times-circle">
                                        </div>
                                    </div>

                                    <?php 
                                        if($fetch_details['productName'] == 'Build Your Own') {
                                    ?>

                                    <div>
                                        <div class="slider">
                                          <div id="slider-inner">
                                            <ul>
                                                <?php 
                                                    $ingredients_itemcart = $conn->prepare("SELECT * FROM `orderingredientscart` WHERE OICartID = ?");
                                                    $ingredients_itemcart->execute([$fetch_orders['OICartID']]);

                                                    $isNotEmpty = 0;
                                                    if($ingredients_itemcart->rowCount() > 0) {
                                                        while($fetch_ingredients = $ingredients_itemcart->fetch(PDO::FETCH_ASSOC)) {

                                                            if($fetch_ingredients['OICDough'] != "") {
                                                                getIngredients($fetch_ingredients['OICDough']);
                                                                $isNotEmpty++;
                                                            }

                                                            if($fetch_ingredients['OICSauce'] != "") {
                                                                getIngredients($fetch_ingredients['OICSauce']);
                                                                $isNotEmpty++;
                                                            }

                                                            if($fetch_ingredients['OICCheese'] != "") {
                                                                getIngredients($fetch_ingredients['OICCheese']);
                                                                $isNotEmpty++;
                                                            }

                                                            if($fetch_ingredients['OICMeat'] != "") {
                                                               getIngredients($fetch_ingredients['OICMeat']);
                                                               $isNotEmpty++;
                                                            }

                                                            if($fetch_ingredients['OICVeggies'] != "") {
                                                                getIngredients($fetch_ingredients['OICVeggies']);
                                                                $isNotEmpty++;
                                                            }

                                                            if($fetch_ingredients['OICFinishes'] != "") {
                                                                getIngredients($fetch_ingredients['OICFinishes']);
                                                                $isNotEmpty++;
                                                            }

                                                        }

                                                        //generate empty placeholder
                                                        for($ii=0; $ii< 6 - $isNotEmpty; $ii++) {
                                                         echo '<li></li>';
                                                        }

                                                    }

                                                ?>

                                            </ul>
                                          </div>
                                        </div>
                                    </div>

                                    <?php 
                                        }
                                    ?>
                                </div>

                                <?php
                                                    }
                                                }
                                            }
                                        }
                                    }
                                ?>

                                <label for="card-address" class="label-default">Notes</label>
                                <section>
                                    <div class="address-outline">
                                        <textarea id="notes" class="address-textarea" cols="100" rows="10"></textarea>
                                    </div>
                                </section>
                                </div>

                                <div class="wrapper">

                                <div class="discount-token">
                                    <label for="discount-token" class="label-default">Payment Method</label>
                                    <div class="wrapper-flex">
                                        <select id="payment_option" class="form-control">
                                            <option value="COD" class="selection">Cash on Delivery</option>
                                            <option value="Blaze Pizza e-Wallet" class="selection">Blaze Pizza E-wallet</option>
                                        </select>
                                    </div>
                                </div>

                                <form id="promo">
                                    <div class="discount-token">
                                        <label for="discount-token" class="label-default">Promo Code</label>
                                        <div id="message"></div>
                                        <div class="wrapper-flex">
                                            <form id="promo">
                                                <input type="text" name="discount-token" id="discount-token" class="input-default" value="">
                                                <button id="promo_button" type="button" class="btn btn-outline">Apply</button>
                                                <button style="display: none" id="remove_promo" type="button" class="btn btn-outline">Remove</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="amount">

                                    <div class="subtotal">
                                        <span>Subtotal</span> <span>$ <span id="subtotal">2.05</span></span>
                                    </div>

                                    <div class="tax">
                                        <span>Tax:</span> <span>$ <span id="tax">0.10</span></span>
                                    </div>

                                    <div class="shipping">
                                        <span>Delivery Fee:</span> <span>$ <span id="shipping">0.00</span></span>
                                    </div>

                                    <div class="promo_code" style="display: none">
                                        <span>Discount:</span> <span>$ <span id="promo_code">0.00</span></span>
                                    </div>

                                </div>

                                <div class="amount">

                                    <div class="total">
                                        <span><b>Total:</b></span> <span><b>$</b> <span id="total"><b>2.15</b></span></span>
                                    </div>

                                </div>

                            </div>

                            </div>

                        </section>
                    </div>
                </main>
            </div>
        </div>

        <?php include 'footer.php';?>
        <!--
            - custom js link
        -->
        <script src="../js/script.js"></script>
        <script src="../js/track.js"></script>

        <!--
            - ionicon link
        -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    </body>

</html>