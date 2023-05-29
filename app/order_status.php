<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ORDER STATUS</title>
        <?php include 'header.php';?>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/order_status.css">
    </head>
<body>

<?php include 'navigation.php';?>

<div class="content">

    <?php

        if(isset($_SESSION['customerID'])) {

            $user_info = $conn->prepare("SELECT * FROM `customer` WHERE customerID = ?");
            $user_info->execute([$_SESSION['customerID']]);
            $fetch_user_info = $user_info->fetch(PDO::FETCH_ASSOC);


            if(!isset($_GET["order_id"])) {
                $order_info = $conn->prepare("SELECT * FROM `order` WHERE customerID = ?");
                $order_info->execute([$_SESSION['customerID']]);
            } else {
                $order_info = $conn->prepare("SELECT * FROM `order` WHERE customerID = ? AND orderID = ?");
                $order_info->execute([$_SESSION['customerID'], $_GET["order_id"]]);
            }

            if($order_info->rowCount() > 0){        

                while ($fetch_info = $order_info->fetch(PDO::FETCH_ASSOC)) { 

                    $promo_value = 0;
                    $promo_name = "";

                    if($fetch_info['promoCode'] != "") {

                        global $conn;
                        $promo = $conn->prepare("SELECT * FROM `promos` WHERE promoCode = ?");
                        $promo->execute([$fetch_info['promoCode']]);

                        if($promo->rowCount() > 0) {
                            $fetch_promo = $promo->fetch(PDO::FETCH_ASSOC);
                            $promo_value = $fetch_promo['rewards'];
                            $promo_name =  $fetch_promo['promoName'];
                        }
                    }


    ?>

    <div class="container-fluid">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 order">
                    <div class="card mb-4">
                        <div class="card-body">
                            <table class="table table-borderless">

                                <thead>
                                    <div class="d-flex justify-content-between align-items-center py-3">
                                        <span class="h5 mb-0"> Order #: <?= $fetch_info['orderID']; ?> 
                                        <span class="'h5 mb-0' <?= $fetch_info['orderStatus'] == 'ONGOING' ? 'ongoing' : 'completed' ?>">[<?= $fetch_info['orderStatus'] ?>]</span> </span>
                                    </div>
                                </thead>

                                <tbody>

                                    <?php 

                                        $item_info = $conn->prepare("SELECT * FROM `orderitem` WHERE orderID = ?");
                                        $item_info->execute([$fetch_info['orderID']]);

                                        while ($fetch_item = $item_info->fetch(PDO::FETCH_ASSOC)) {

                                            $product = $conn->prepare("SELECT * FROM `product` WHERE productID = ?");
                                            $product->execute([$fetch_item['productID']]);

                                             while ($fetch_product = $product->fetch(PDO::FETCH_ASSOC)) {

                                    ?>

                                    <tr>
                                        <td class="border">
                                            <div class="d-flex mb-2">
                                                <div class="flex-shrink-0">
                                                    <?php
                                                        echo'<img  src="data:image/png;base64,' .base64_encode($fetch_product['productImage']).'" alt="" class="img-fluid"/>';
                                                    ?>
                                                </div>
                                                <div class="order-name">
                                                    <h6><a href="#" class="text-reset"> <?= $fetch_product['productName'] ?></a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border"><?= $fetch_item['orderItemQty'] ?></td>
                                        <td class="text-end border"> $<?= sprintf("%.2f", $fetch_item['orderItemQty'] * $fetch_product['productPrice']) ?></td>
                                    </tr>


                                    <?php 

                                            }
                                        }

                                    ?>

                                </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Subtotal</td>
                                            <td class="text-end"> $<?= $promo_value != 0 ? sprintf("%.2f", $fetch_info['orderAmount'] + $promo_value) : sprintf("%.2f", $fetch_info['orderAmount']) ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Order Status</td>
                                            <td class="text-end"><?= $fetch_info['orderStatus'] == "ONGOING" ? 'On the way' : 'Completed' ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Promo code <?= $promo_name != "" ? '[Code:'.$promo_name.']' : ""?> </td>
                                            <td class="text-danger text-end">-$<?= sprintf("%.2f", $promo_value) ?></td>
                                        </tr>
                                        <tr class="fw-bold total">
                                            <td colspan="2">TOTAL</td>
                                            <td class="text-end">$<?= sprintf("%.2f", $fetch_info['orderAmount']) ?></td>
                                        </tr>
                                    </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="h6">Payment Method</h3>
                                    Total: <?= sprintf("%.2f", $fetch_info['orderAmount']) ?> <span class="badge <?= $fetch_info['paymentStatus'] == 'PAID' ? 'bg-success' : 'bg-warning' ?> rounded-pill"><?= $fetch_info['paymentStatus'] ?></span></p>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="h6"><?= $fetch_info['paymentType'] == "COD" ? "Cash On Delivery" : $fetch_info['paymentType'] ?></h3>
                                    <address>
                                    <strong><?= $fetch_user_info['custFname'] . " " . $fetch_user_info['custLname'] ?></strong><br>
                                    <?= $fetch_user_info['custAddress'] ?><br>
                                    <abbr title="Phone">P:</abbr> <?= $fetch_user_info['custContactNum'] ?>
                                    </address>
                                </div>
                            </div>
                         </div>
                    </div>

                    <?php 
                        if($fetch_info['orderStatus'] == "ONGOING" && $fetch_info['paymentType'] != "COD") {
                    ?>

                    <div class="mb-4 order_button">
                        <div class="justify-content-between align-items-center py-3">
                            <input id="order_id" type="hidden" name="order_id" value="<?= $fetch_info['orderID'] ?>">
                            <span id="receive" class="h5 mb-0 btn btn btn-outline-success">Order Received?</span>
                        </div>
                    </div>

                    <?php 
                         }
                    ?>

                </div>
            </div>
        </div>
    </div>

    <?php
                }
            } else {
                echo '<div class="container-fluid" style="height:600px; margin-left:1em">';
                    echo '<div class="container">';
                        echo '<p> No orders found! </p>';
                    echo '</div>';
                echo '</div>';
            }
        }
    ?>

</div>

<?php include 'footer.php';?>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/script.js"></script>

</body>
</html>