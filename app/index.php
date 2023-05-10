<!DOCTYPE html>
<html>
    <head>
        <title>Blaze Pizza</title>
        <?php include 'header.php';?>
        <link rel="stylesheet" href="../css/homepage.css">
    </head>
    <body>
        <div class="content">
            <?php include 'navigation.php';?>

            <!-- carousel starts here -->

            <div class="carousel" data-flickity='{"autoPlay": true, "cellAlign": "center", "wrapAround": true,"freeScroll": true}' >
                        <div class="carousel-cell" style="background-image: url('../assets/promos/Welcome.png')"></div>
                        <div class="carousel-cell" style="background-image: url('../assets/promos/Stamps_Promo.png')"></div>
                        <div class="carousel-cell" style="background-image: url('../assets/promos/Coupon_Discounted_Bread.png')"></div>
                        <div class="carousel-cell" style="background-image: url('../assets/promos/Coupon_Discounted_Pizza.png')"></div>
                        <div class="carousel-cell" style="background-image: url('../assets/promos/Coupon_Free_Drink.png')"></div>
                        <div class="carousel-cell" style="background-image: url('../assets/promos/Poster_Redirect_to_Salad_Entree.png')"></div>
            </div>

            <!-- carousel ends here -->

            <!-- products starts here -->

            <div class="container">

                <section class="section">  
                    <div>    
                        <p class="featured">FEATURED PRODUCTS</p>
                    </div> 
                    <div class="featured-wrapper">

                        <?php
                            $redirect = '';
                            $select_orders = $conn->prepare("SELECT * FROM `product`");
                            $select_orders->execute();
                            if($select_orders->rowCount() > 0){                           
                                for($i=0;$i<6;$i++){   
                                    $fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC);

                                    if ($fetch_orders['productName'] == 'Build Your Own'){
                                        $redirect = '../app/byo_order.php';
                                    }else{
                                        $redirect = '../app/fixed_order.php?id='.$fetch_orders['productID'];
                                    }


                        ?>
                        
                        <div class="featured-products"  onclick="window.location.href = '<?= $redirect?>'">
                            <div class="img">
                                <?php
                                    echo'<img src="data:image/png;base64,' .base64_encode($fetch_orders['productImage']).'"/>';
                                ?>
                            </div>
                            <div class="details">
                            <p class="title"><span><?= $fetch_orders['productName'];?></span></p>
                            <p class="description"><span><?= $fetch_orders['productDesc'];?></span></p>
                            <p class="price">$<span><?= $fetch_orders['productPrice']; ?></span></p>
                            </div>
                        </div>

                        <?php
                                }
                            }else{
                                echo '<p class="empty">nothing ordered yet!</p>';
                            }
                        ?>
                    </div>
                </section>

                <section>
                    <br><br>
                    <a href="https://www.instagram.com/blazepizza/" target="_blank">
                        <img src="../assets/promos/Instagram_Ad.png" alt="Instagram Ad" class="ad-image" />
                    </a>
                </section>
            </div>
            
            <!-- products ends here -->

            <?php include 'footer.php';?>
        </div>

        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
    </body>
</html>