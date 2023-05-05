<!DOCTYPE html>
<html>
    <head>
        <title>My Orders</title>
        <?php include 'header.php';?>
        <link rel="stylesheet" href="../css/track_order.css">
    </head>

    <body>
        <div class="content">
            <?php include 'navigation.php';?>
            
            <div class="container">
                <div class="track-order-container">
                        <p class="my-orders">My Orders</p>
                    <div>
                        <img class="empty-order" src="../assets/symbols/empty_order.png" alt="Empty Order">
                    </div>
                        <div class="text-container">  
                            <p class="no-orders">You currently have no ongoing orders</p>
                            <p class="craving">Craving for something delicious? Order from us below!</p>
                        </div>

                        <div class="redirect-to-menu">
                            <a href="../app/menu.php">
                                <button type="button" class="add-new-order">ADD A NEW ORDER</button>
                            </a>
                        </div>
                </div>
            </div>





            <?php include 'footer.php';?>
        </div>

        <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <script type="text/javascript" src="../js/script.js"></script>
    </body>
</html>