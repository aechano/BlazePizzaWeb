<!DOCTYPE html>
<html>
    <head>
        <title>Blaze Pizza</title>
        <?php include 'header.php';?>
        <link rel="stylesheet" href="../css/menu.css">
    </head>
    <body class="menu-body">
        <?php include 'navigation.php';?>

        <div class="content">
            <div class="container">
                <div class="menu-all">
                    
                    <div class="menu-layout" >
                        <span class="menu-title">
                            <p class="menu1">Menu</p>
                        </span>
                        <div class="menu-category active" data-div="hotty">
                            <p class="menu">WHAT'S HOT</p>
                        </div>
                        <div class="menu-category" data-div="pizza">
                            <p class="menu">11-INCH PIZZAS</p>
                        </div>
                        <div class="menu-category" data-div="taketwo">
                            <p class="menu">TAKE TWO</p>
                        </div>
                        <div class="menu-category" data-div="lpizza">
                            <p class="menu">LARGE PIZZAS</p>
                        </div>
                        <div class="menu-category" data-div="digDeals">
                            <p class="menu">Digital Deals</p>
                        </div>
                        <div class="menu-category" data-div="cheesy">
                            <p class="menu">CHEESY BREAD & SALADS</p>
                        </div>
                        <div class="menu-category" data-div="desserts">
                            <p class="menu">DESSERTS</p>
                        </div>
                        <div class="menu-category" data-div="drinks">
                            <p class="menu">DRINKS, BEERS & WINE</p>
                        </div>
                    </div>

                    <div class="order-title">
                            <div class="order-header">
                                CHEF-INSPIRED
                            </div>
                            <div class="order-subheader">
                                ALWAYS DELICIOUS.<br>
                                TRY OUR LATEST FEATURED FAVORITES
                            </div>
                    </div>

                    <div class="menu-order">


                        <div class="order-wrap">
                            <div class="item hotty">                             
                                <?php
                                    $redirect = '';
                                    $categ = "What's Hot";
                                    $select_menu = $conn->prepare("SELECT * FROM `product` WHERE productType = ?");
                                    $select_menu->execute([$categ]);
                                    if($select_menu->rowCount() > 0){
                                        while($fetch_menu = $select_menu->fetch(PDO::FETCH_ASSOC)){      
                                            
                                            if ($fetch_orders['productName'] == 'Build Your Own'){
                                                $redirect = '../app/byo_order.php?id='.$fetch_menu['productID'];
                                            }else{
                                                $redirect = '../app/fixed_order.php?id='.$fetch_orders['productID'];
                                            }    
                                ?>
                                
                                <div class="menu-products" onclick="window.location.href = '<?= $redirect?>'">
                                    <div class="img">
                                        <?php
                                            echo'<img src="data:image/png;base64,' .base64_encode($fetch_menu['productImage']).'"/>';
                                        ?>
                                    </div>
                                    <div class="details">
                                    <p class="title"><span><?= $fetch_menu['productName'];?></span></p>
                                    <p class="description"><span><?= $fetch_menu['productDesc'];?></span></p>
                                    <p class="price">$<span><?= $fetch_menu['productPrice']; ?></span></p>
                                    </div>
                                </div>
                                <?php
                                        }
                                    }else{
                                        echo '<p class="empty">No Products Available</p>';
                                    }
                                ?>
                            </div>

                            <div class="item pizza">
                                <?php
                                    $redirect = '';
                                    $categ = "11-Inch Pizza";
                                    $select_menu = $conn->prepare("SELECT * FROM `product` WHERE productType = ?");
                                    $select_menu->execute([$categ]);
                                    if($select_menu->rowCount() > 0){
                                        while($fetch_menu = $select_menu->fetch(PDO::FETCH_ASSOC)){  
                                            
                                            if ($fetch_menu['productName'] == 'Build Your Own'){
                                                $redirect = '../app/byo_order.php?id='.$fetch_menu['productID'];
                                            }else{
                                                $redirect = '../app/fixed_order.php?id='.$fetch_menu['productID'];
                                            }            
                                ?>
                                
                                <div class="menu-products"  onclick="window.location.href = '<?= $redirect?>'">
                                    <div class="img">
                                        <?php
                                            echo'<img src="data:image/png;base64,' .base64_encode($fetch_menu['productImage']).'"/>';
                                        ?>
                                    </div>
                                    <div class="details">
                                    <p class="title"><span><?= $fetch_menu['productName'];?></span></p>
                                    <p class="description"><span><?= $fetch_menu['productDesc'];?></span></p>
                                    <p class="price">$<span><?= $fetch_menu['productPrice']; ?></span></p>
                                    </div>
                                </div>
                                <?php
                                        }
                                    }else{
                                        echo '<p class="empty">No Products Available</p>';
                                    }
                                ?>
                            </div>

                            <div class="item taketwo">
                                <?php
                                    $redirect = '';
                                    $categ = "Take Two";
                                    $select_menu = $conn->prepare("SELECT * FROM `product` WHERE productType = ?");
                                    $select_menu->execute([$categ]);
                                    if($select_menu->rowCount() > 0){
                                        while($fetch_menu = $select_menu->fetch(PDO::FETCH_ASSOC)){   
                                            if ($fetch_menu['productName'] == 'Build Your Own'){
                                                $redirect = '../app/byo_order.php?id='.$fetch_menu['productID'];
                                            }else{
                                                $redirect = '../app/fixed_order.php?id='.$fetch_menu['productID'];
                                            }          
                                ?>
                                
                                <div class="menu-products" onclick="window.location.href = '<?= $redirect?>'">
                                    <div class="img">
                                        <?php
                                            echo'<img src="data:image/png;base64,' .base64_encode($fetch_menu['productImage']).'"/>';
                                        ?>
                                    </div>
                                    <div class="details">
                                        <p class="title"><span><?= $fetch_menu['productName'];?></span></p>
                                        <p class="description"><span><?= $fetch_menu['productDesc'];?></span></p>
                                        <p class="price">$<span><?= $fetch_menu['productPrice']; ?></span></p>
                                    </div>
                                </div>
                                <?php
                                        }
                                    }else{
                                        echo '<p class="empty">No Products Available</p>';
                                    }
                                ?>
                            </div>

                            <div class="item lpizza">
                                <?php
                                    $redirect = '';
                                    $categ = "Large Pizza";
                                    $select_menu = $conn->prepare("SELECT * FROM `product` WHERE productType = ?");
                                    $select_menu->execute([$categ]);
                                    if($select_menu->rowCount() > 0){
                                        while($fetch_menu = $select_menu->fetch(PDO::FETCH_ASSOC)){    
                                            if ($fetch_menu['productName'] == 'Build Your Own'){
                                                $redirect = '../app/byo_order.php?id='.$fetch_menu['productID'];
                                            }else{
                                                $redirect = '../app/fixed_order.php?id='.$fetch_menu['productID'];
                                            }         
                                ?>
                                
                                <div class="menu-products" onclick="window.location.href = '<?= $redirect?>'">
                                    <div class="img">
                                        <?php
                                            echo'<img src="data:image/png;base64,' .base64_encode($fetch_menu['productImage']).'"/>';
                                        ?>
                                    </div>
                                    <div class="details">
                                    <p class="title"><span><?= $fetch_menu['productName'];?></span></p>
                                    <p class="description"><span><?= $fetch_menu['productDesc'];?></span></p>
                                    <p class="price">$<span><?= $fetch_menu['productPrice']; ?></span></p>
                                    </div>
                                </div>
                                <?php
                                        }
                                    }else{
                                        echo '<p class="empty">No Products Available</p>';
                                    }
                                ?>
                            </div>

                            <div class="item digDeals">
                                <?php
                                    $redirect = '';
                                    $categ = "Digital Deals";
                                    $select_menu = $conn->prepare("SELECT * FROM `product` WHERE productType = ?");
                                    $select_menu->execute([$categ]);
                                    if($select_menu->rowCount() > 0){
                                        while($fetch_menu = $select_menu->fetch(PDO::FETCH_ASSOC)){  
                                            if ($fetch_menu['productName'] == 'Build Your Own'){
                                                $redirect = '../app/byo_order.php?id='.$fetch_menu['productID'];
                                            }else{
                                                $redirect = '../app/fixed_order.php?id='.$fetch_menu['productID'];
                                            }           
                                ?>
                                
                                <div class="menu-products" onclick="window.location.href = '<?= $redirect?>'">
                                    <div class="img">
                                        <?php
                                            echo'<img src="data:image/png;base64,' .base64_encode($fetch_menu['productImage']).'"/>';
                                        ?>
                                    </div>
                                    <div class="details">
                                    <p class="title"><span><?= $fetch_menu['productName'];?></span></p>
                                    <p class="description"><span><?= $fetch_menu['productDesc'];?></span></p>
                                    <p class="price">$<span><?= $fetch_menu['productPrice']; ?></span></p>
                                    </div>
                                </div>
                                <?php
                                        }
                                    }else{
                                        echo '<p class="empty">No Products Available</p>';
                                    }
                                ?>
                            </div>

                            <div class="item cheesy">
                                <?php
                                    $redirect = '';    
                                    $categ = "Cheesy Breads and Salads";
                                    $select_menu = $conn->prepare("SELECT * FROM `product` WHERE productType = ?");
                                    $select_menu->execute([$categ]);
                                    if($select_menu->rowCount() > 0){
                                        while($fetch_menu = $select_menu->fetch(PDO::FETCH_ASSOC)){  
                                            if ($fetch_menu['productName'] == 'Build Your Own'){
                                                $redirect = '../app/byo_order.php?id='.$fetch_menu['productID'];
                                            }else{
                                                $redirect = '../app/fixed_order.php?id='.$fetch_menu['productID'];
                                            }           
                                ?>
                                
                                <div class="menu-products" onclick="window.location.href = '<?= $redirect?>'">
                                    <div class="img">
                                        <?php
                                            echo'<img src="data:image/png;base64,' .base64_encode($fetch_menu['productImage']).'"/>';
                                        ?>
                                    </div>
                                    <div class="details">
                                    <p class="title"><span><?= $fetch_menu['productName'];?></span></p>
                                    <p class="description"><span><?= $fetch_menu['productDesc'];?></span></p>
                                    <p class="price">$<span><?= $fetch_menu['productPrice']; ?></span></p>
                                    </div>
                                </div>
                                <?php
                                        }
                                    }else{
                                        echo '<p class="empty">No Products Available</p>';
                                    }
                                ?>
                            </div>

                            <div class="item desserts">
                                <?php
                                    $redirect = '';
                                    $categ = "Desserts";
                                    $select_menu = $conn->prepare("SELECT * FROM `product` WHERE productType = ?");
                                    $select_menu->execute([$categ]);
                                    if($select_menu->rowCount() > 0){
                                        while($fetch_menu = $select_menu->fetch(PDO::FETCH_ASSOC)){     
                                            if ($fetch_menu['productName'] == 'Build Your Own'){
                                                $redirect = '../app/byo_order.php?id='.$fetch_menu['productID'];
                                            }else{
                                                $redirect = '../app/fixed_order.php?id='.$fetch_menu['productID'];
                                            }        
                                ?>
                                
                                <div class="menu-products" onclick="window.location.href = '<?= $redirect?>'">
                                    <div class="img">
                                        <?php
                                            echo'<img src="data:image/png;base64,' .base64_encode($fetch_menu['productImage']).'"/>';
                                        ?>
                                    </div>
                                    <div class="details">
                                    <p class="title"><span><?= $fetch_menu['productName'];?></span></p>
                                    <p class="description"><span><?= $fetch_menu['productDesc'];?></span></p>
                                    <p class="price">$<span><?= $fetch_menu['productPrice']; ?></span></p>
                                    </div>
                                </div>
                                <?php
                                        }
                                    }else{
                                        echo '<p class="empty">No Products Available</p>';
                                    }
                                ?>
                            </div>

                            <div class="item drinks">
                                <?php
                                    $redirect = '';
                                    $categ = "Drinks, Beers, and Wine";
                                    $select_menu = $conn->prepare("SELECT * FROM `product` WHERE productType = ?");
                                    $select_menu->execute([$categ]);
                                    if($select_menu->rowCount() > 0){
                                        while($fetch_menu = $select_menu->fetch(PDO::FETCH_ASSOC)){  
                                            if ($fetch_menu['productName'] == 'Build Your Own'){
                                                $redirect = '../app/byo_order.php?id='.$fetch_menu['productID'];
                                            }else{
                                                $redirect = '../app/fixed_order.php?id='.$fetch_menu['productID'];
                                            }           
                                ?>
                                
                                <div class="menu-products" onclick="window.location.href = '<?= $redirect?>'">
                                    <div class="img">
                                        <?php
                                            echo'<img src="data:image/png;base64,' .base64_encode($fetch_menu['productImage']).'"/>';
                                        ?>
                                    </div>
                                    <div class="details">
                                    <p class="title"><span><?= $fetch_menu['productName'];?></span></p>
                                    <p class="description"><span><?= $fetch_menu['productDesc'];?></span></p>
                                    <p class="price">$<span><?= $fetch_menu['productPrice']; ?></span></p>
                                    </div>
                                </div>
                                <?php
                                        }
                                    }else{
                                        echo '<p class="empty">No Products Available</p>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php';?>
        <script type="text/javascript" src="../js/menu.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
    </body>
</html>