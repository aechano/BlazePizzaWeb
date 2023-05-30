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
                        <div class="carousel-cell" style="background-image: url('../assets/promos/welcome_display.png')"></div>
                        <div class="carousel-cell" style="background-image: url('../assets/promos/jubilee_craze.png')"></div>
                        <div class="carousel-cell" style="background-image: url('../assets/promos/cheesy_bread_poster.png')"></div>
                        <div class="carousel-cell" style="background-image: url('../assets/promos/lovers_event.png')"></div>
                        <div class="carousel-cell" style="background-image: url('../assets/promos/refreshments_voucher.png')"></div>
                        <div class="carousel-cell" style="background-image: url('../assets/promos/seasonal_salad_info.png')"></div>
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

<!-- MODIFIED CODE BEGINS HERE -->    
                <section id="new-box">
                    <h3>Customer Reviews</h3>
                    <h5>See what our customers are saying</h5>
                    <div class="new-container">
                        <div class="new-card">
                        <div class="new-card-header">
                            <h4>John Doe</h4>
                            <div class="new_rating">
                            <span class="new_star">&#9733;</span>
                            <span class="new_star">&#9733;</span>
                            <span class="new_star">&#9733;</span>
                            <span class="new_star">&#9733;</span>
                            <span class="empty-new_star">&#9734;</span>
                            </div>
                        </div>
                        <p>I absolutely love Blaze Pizza in Red Deer! The pizzas are delicious, and they have a wide variety of toppings to choose from. The crust is thin and crispy, just the way I like it. The staff is friendly and always provides excellent service. I highly recommend trying their BBQ Chicken pizza!</p>
                        </div>
                        <div class="new-card">
                        <div class="new-card-header">
                            <h4>Jane Smith</h4>
                            <div class="new_rating">
                            <span class="new_star">&#9733;</span>
                            <span class="new_star">&#9733;</span>
                            <span class="new_star">&#9733;</span>
                            <span class="empty-new_star">&#9734;</span>
                            <span class="empty-new_star">&#9734;</span>
                            </div>
                        </div>
                        <p>Blaze Pizza in Red Deer is my go-to place for a quick and delicious meal. The build-your-own pizza concept is fantastic, as I can customize my pizza exactly how I want it. The ingredients are always fresh, and the flavors are amazing. The prices are reasonable, making it a great value for the quality you get.</p>
                        </div>
                        <div class="new-card">
                        <div class="new-card-header">
                            <h4>David Johnson</h4>
                            <div class="new_rating">
                            <span class="new_star">&#9733;</span>
                            <span class="new_star">&#9733;</span>
                            <span class="empty-new_star">&#9734;</span>
                            <span class="empty-new_star">&#9734;</span>
                            <span class="empty-new_star">&#9734;</span>
                            </div>
                        </div>
                        <p>I recently visited Blaze Pizza in Red Deer, and it exceeded my expectations. The staff was attentive and helpful, and the pizza was incredibly delicious. The thin crust had the perfect balance of chewiness and crispiness. The restaurant has a cozy and inviting atmosphere, making it a great place to enjoy a meal with friends or family.</p>
                        </div>
                        <div class="new-card">
                        <div class="new-card-header">
                            <h4>Emily Wilson</h4>
                            <div class="new_rating">
                            <span class="new_star">&#9733;</span>
                            <span class="new_star">&#9733;</span>
                            <span class="empty-new_star">&#9734;</span>
                            <span class="empty-new_star">&#9734;</span>
                            <span class="empty-new_star">&#9734;</span>
                            </div>
                        </div>
                        <p>Blaze Pizza in Red Deer is a must-visit for pizza lovers. The quality and taste of their pizzas are outstanding. I appreciate the fact that they use fresh ingredients and offer a variety of options for toppings and sauces. The staff is friendly and helpful, ensuring a pleasant dining experience. I highly recommend trying their Art Lover pizza!</p>
                        </div>
                    </div>
                    </section>
            </div>
<!-- MODIFIED CODE ENDS HERE -->    
            
            <!-- products ends here -->

            <?php include 'footer.php';?>
        </div>

        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
    </body>
</html>