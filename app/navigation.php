<?php

include 'config.php';

if(!isset($_SESSION)) { 
  session_start(); 
} 

if(isset($_SESSION['customerID'])){
   $customer_id = $_SESSION['customerID'];
}else{
   $customer_id = '';
};

if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header('location:index.php');
 }
 
?>

<header class="header">
    <div class="container">

        <a class="link" href="../app/index.php">
            <img src="../assets/logos/blazepizza.png" alt="Blaze Pizza" class="header_logo">
        </a>

        <nav class="header_navbar">
            <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'menu.php' ? ' active' : '');?>" href="../app/menu.php">MENU</a>
            <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'promos.php' ? ' active' : '');?>" href="../app/promos.php">PROMOS</a>
            <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'about_us.php' ? ' active' : '');?>" href="../app/about_us.php">ABOUT US</a>
            <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'contact_us.php' ? ' active' : '');?>" href="../app/contact_us.php">CONTACT US</a>
        </nav>

        <div class="submenu-wrap">
            <div class="submenu">
                <div class="user-info">
                    <?php
                        $select_user = $conn->prepare("SELECT * FROM `customer` WHERE customerID = ?");
                        $select_user->execute([$customer_id]);
                        if($select_user->rowCount() > 0){
                            while($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)){
                               echo '<p class="greetings">Hello, <span>'.$fetch_user['custFname'].'</span></p>';
                            }
                         }
                    ?>
                </div>
                <hr>

                <a href="../app/account_settings.php" class="sub-menu-link">
                    <p>Account Settings</p></a>

                <a href="#" class="sub-menu-link">
                    <p>Orders</p></a>

                <a href="#" class="sub-menu-link">
                    <p>Privacy Policy</p></a>

                <a href="index.php?logout" class="sub-menu-link">
                    <p>Log out</p></a>
            </div>
        </div>

        <div class="main">
            <div id="menu-icon" class="fas fa-bars"></div>

            <?php
                $select_user = $conn->prepare("SELECT * FROM `customer` WHERE customerID = ?");
                $select_user->execute([$customer_id]);
                if($select_user->rowCount() > 0){
                    while($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)){
                        echo'<div id="user" class="fas fa-user"  onclick=""></div>';
                    }
                }else{
                    echo'
                    <a href="../app/login.php">
                        <div id="not_user" class="fas fa-user"></div>
                    </a>';
                }
            ?>
            <div id="search" class="fas fa-search"></div>
            <div id="shopping" class="fas fa-shopping-cart"></div>
        </div>
    </div>

    <?php 

        if(!strpos($_SERVER['REQUEST_URI'], "payment.php")) {

    ?>   

    <div class="shopping-cart">

        <section>

            <div id="close-cart"> <span class="fas fa-arrow-right"></span></div>

                <?php

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

                <div class="<?= 'box box'.$i ?>">
                   <!--  <a href="#" class="fas fa-times"></a>
                    <?php
                        echo'<img src="data:image/png;base64,' .base64_encode($fetch_details['productImage']).'" alt=""/>';
                    ?>
                    <div class="read">
                        <p> <?= $fetch_details['productName']; ?> <span>($<?= $fetch_details['productPrice']; ?>)</span></p>
                        <form action="" method="post">
                        <input type="number" class="qty" name="qty" min="1" value="<?= $fetch_orders['OICartQty']; ?>" max="100">
                        <button type="submit" class="fas fa-edit" name="update_qty"></button>
                        </form>
                    </div> -->

                     <div id="<?= $i ?>" class="remove_products fas fa-times-circle"></div>

                    <div style="position: relative;">
                        <div class="loading" id="<?= 'loading'.$i; ?>" style="display:none;">
                            <img src="../assets/gif/spinner.gif">
                        </div>
                        <?php
                            echo'<img src="data:image/png;base64,' .base64_encode($fetch_details['productImage']).'" alt=""/>';
                        ?>
                    </div>
                     
                     <div class="read">
                        <div>
                            <p> Product: <?= $fetch_details['productName']; ?> </p>
                            <p> Price: $<?= $fetch_details['productPrice']; ?> </p>
                        </div>
                        <div>
                            <form id="<?= 'form'.$i; ?>" method="post">
                                <input type="number" id="<?= $i; ?>" class="qty" name="quantity" min="1" value="<?= $fetch_orders['OICartQty']; ?>" max="100">
                                <input type="hidden" name="id" value="<?php echo $fetch_orders['productID'] ?>">
                                <input type="hidden" name="order_type" value="1">
                            </form>
                        </div>
                     </div>

                </div>

                <?php
                                }
                            }
                        }else{
                            $isEmpty = true;
                        }
                    }

                    if(!isset($isEmpty)) {
                        echo '<a id="order_button" href="../app/payment.php?type=1" class="butn">order now</a>';
                    } else {
                         echo '<div id="empty" class="butn">Empty</div>';
                    }

                ?>

        </section>
             
    </div>

    <?php      

        }

    ?>

</header>

<div class="loading1" style="display:none;"></div>