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

                                    if(isset($_SESSION['customerID'])) {
                                        $user_info = $conn->prepare("SELECT * FROM `customer` WHERE customerID = ?");
                                        $user_info->execute([$_SESSION['customerID']]);

                                        if($user_info->rowCount() > 0){                          
                                             $fetch_info = $user_info->fetch(PDO::FETCH_ASSOC);                                 
   
                                ?>
     

                                <form action="#">

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
                                            <textarea class="address-textarea" cols="100" rows="10"></textarea>
                                        </div>
                                    </section>

                                    <div class="form-deets">
                                    <label for="card-number" class="label-default">Event Voucher</label>
                                    <input type="text" class="input-default">
                                    </div>
                                    
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

                                <div class="product-card">
                                    <div class="card">
                                        <div class="img-box">
                                           <?php
                                                echo'<img  src="data:image/png;base64,' .base64_encode($fetch_orders['productImage']).'" alt="Pesto Garlic Cheesy Bread" width="80px" class="product-img"/>';
                                            ?>
                                        </div>
                                        <div class="detail">
                                            <h4 class="product-name"><?= $fetch_orders['productName'];?></h4>
                                            <div class="wrapper">
                                                <div class="product-qty">
                                                    <button id="decrement">
                                                    <ion-icon name="remove-outline"></ion-icon>
                                                    </button>

                                                    <span id="quantity"><?= isset($_GET['quantity']) ?  $_GET['quantity'] :  1 ?></span>

                                                    <button id="increment">
                                                    <ion-icon name="add-outline"></ion-icon>
                                                    </button>
                                                </div>
                                                <div class="price">
                                                    $ <span id="price"><?= $fetch_orders['productPrice']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="product-close-btn">
                                            <ion-icon name="close-outline"></ion-icon>
                                        </button>
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

                                <div class="product-card">
                                    <div class="card">
                                        <div class="img-box">
                                           <?php
                                                echo'<img  src="data:image/png;base64,' .base64_encode($fetch_details['productImage']).'" alt="Pesto Garlic Cheesy Bread" width="80px" class="product-img"/>';
                                            ?>
                                        </div>
                                        <div class="detail">
                                            <h4 class="product-name"><?= $fetch_details['productName'];?></h4>
                                            <div class="wrapper">
                                                <div class="product-qty">
                                                    <button id="decrement">
                                                    <ion-icon name="remove-outline"></ion-icon>
                                                    </button>

                                                    <span id="quantity"><?= $fetch_orders['OICartQty']; ?></span>

                                                    <button id="increment">
                                                    <ion-icon name="add-outline"></ion-icon>
                                                    </button>
                                                </div>
                                                <div class="price">
                                                    $ <span id="price"><?= $fetch_details['productPrice']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="product-close-btn">
                                            <ion-icon name="close-outline"></ion-icon>
                                        </button>
                                    </div>
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
                                        <textarea class="address-textarea" cols="100" rows="10"></textarea>
                                    </div>
                                </section>
                                </div>

                                <div class="wrapper">

                                <div class="discount-token">
                                    <label for="discount-token" class="label-default">Payment Method</label>
                                    <div class="wrapper-flex">
                                        <select class="form-control">
                                            <option class="selection">Cash on Delivery</option>
                                            <option>Blaze Pizza E-wallet</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="discount-token">
                                    <label for="discount-token" class="label-default">Coupon Code</label>
                                    <div class="wrapper-flex">
                                        <input type="text" name="discount-token" id="discount-token" class="input-default">
                                        <button class="btn btn-outline">Apply</button>
                                    </div>
                                </div>

                                <div class="amount">

                                    <div class="subtotal">
                                        <span>Subtotal</span> <span>$ <span id="subtotal">2.05</span></span>
                                    </div>

                                    <div class="tax">
                                        <span>Tax</span> <span>$ <span id="tax">0.10</span></span>
                                    </div>

                                    <div class="shipping">
                                        <span>Shipping</span> <span>$ <span id="shipping">0.00</span></span>
                                    </div>

                                    <div class="total">
                                        <span><b>Total</b></span> <span><b>$</b> <span id="total"><b>2.15</b></span></span>
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