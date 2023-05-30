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
                            $total_orders = $select_orders->rowCount();
                            if($total_orders >= 6){                           
                                for($i=0;$i<6;$i++){   
                                    $fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC);

                                    if ($fetch_orders['productName'] == 'Build Your Own'){
                                        $redirect = '../app/byo_order.php?id='.$fetch_orders['productID'];
                                    }else{
                                        $redirect = '../app/fixed_order.php?id='.$fetch_orders['productID'];
                                    }
                        
                        ?>
                        
                        <div class="featured-products"  onclick="window.location.href = '<?= $redirect?>'">
                            <div class="img">
                                <img src="../admin/uploaded_images/<?= $fetch_orders['image'] ?>" alt="">
                            </div>
                            <div class="details">
                                <p class="title"><span><?= $fetch_orders['productName'];?></span></p>
                                <p class="description"><span><?= $fetch_orders['productDesc'];?></span></p>
                                <p class="price">$<span><?= $fetch_orders['productPrice']; ?></span></p>
                            </div>
                        </div>

                        <?php
                                }
                            }
                            elseif ($total_orders < 6 ) {
                                for($i=0;$i<$total_orders;$i++){   
                                    $fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC);

                                    if ($fetch_orders['productName'] == 'Build Your Own'){
                                        $redirect = '../app/byo_order.php?id='.$fetch_orders['productID'];
                                    }else{
                                        $redirect = '../app/fixed_order.php?id='.$fetch_orders['productID'];
                                    }
                        ?>

                        <div class="featured-products"  onclick="window.location.href = '<?= $redirect?>'">
                            <div class="img">
                                <img src="../admin/uploaded_images/<?= $fetch_orders['image'] ?>" alt="">
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
                                echo '<p class="empty">no products available!</p>';
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

                <section>
                    <br><br>
                    <div id="reviews-box">
                        <h3>Customer Reviews</h3>
                        <h5>See the latest reviews of Blaze Pizza Red Deer:</h5>
                        <div class="reviews">
                            <div class="review">
                            <div class="review-header">
                                <h4>John Doe</h4>
                                <div class="rating">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                </div>
                            </div>
                            <p>"Blaze Pizza is amazing! I love the selection of toppings and the crust is perfect."</p>
                            </div>
                            
                            <div class="review">
                            <div class="review-header">
                                <h4>Jane Smith</h4>
                                <div class="rating">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star empty">&#9733;</span>
                                </div>
                            </div>
                            <p>"Great pizza, but the service was a bit slow. Would come back for the food though."</p>
                            </div>
                            
                            <div class="review">
                            <div class="review-header">
                                <h4>Bob Johnson</h4>
                                <div class="rating">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star empty">&#9733;</span>
                                <span class="star empty">&#9733;</span>
                                </div>
                            </div>
                            <p>"Decent pizza, but nothing special. Could use more seasoning in the sauce."</p>
                            </div>

                            <div class="review">
                            <div class="review-header">
                                <h4>Mary Smith</h4>
                                <div class="rating">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star empty">&#9733;</span>
                                </div>
                            </div>
                            <p>"Blaze Pizza is great! The pizzas are delicious and the staff is always friendly. I deducted one star because the restaurant can get a bit crowded at peak times."</p>
                            </div>

                            <div class="review">
                            <div class="review-header">
                                <h4>Alex Rodriguez</h4>
                                <div class="rating">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                </div>
                            </div>
                            <p>"I'm a big fan of Blaze Pizza. The crust is crispy and the toppings are fresh and flavorful. The staff is always attentive and the service is quick. Highly recommend!"</p>
                            </div>

                            <div class="review">
                            <div class="review-header">
                                <h4>Emily Johnson</h4>
                                <div class="rating">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star empty">&#9733;</span>
                                <span class="star empty">&#9733;</span>
                                </div>
                            </div>
                            <p>"I had high hopes for Blaze Pizza, but was a bit disappointed. The pizza was decent, but nothing special. The restaurant was also quite loud and crowded. Not sure if I would return."</p>
                            </div>

                            <div class="review">
                            <div class="review-header">
                                <h4>Tom Lee</h4>
                                <div class="rating">
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                <span class="star">&#9733;</span>
                                </div>
                            </div>
                            <p>"Blaze Pizza is one of my favorite pizza places. I love the option to create my own pizza and choose from a variety of toppings. The staff is always friendly and the service is fast. Highly recommend!"</p>
                            </div>
                        </div>
                        </div>

                </section>
            </div>
            
            <!-- products ends here -->

            <?php include 'footer.php';?>
        </div>

        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
    </body>
</html>