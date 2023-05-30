<!DOCTYPE html>
<html>
    <head>
        <?php include 'header.php';?>
        <title>About us</title>
        <link rel="stylesheet" href="../css/promos.css">
    </head>
    <body>
        <?php include 'navigation.php';?>
        <br><br><br>
        <div class="layout">

            <?php

                $promo = $conn->prepare("SELECT * FROM `promos`");
                $promo->execute();

                if($promo->rowCount() > 0){                           
                    for($i=0;$i<$promo->rowCount();$i++){   
                        $a = $promo->fetch(PDO::FETCH_ASSOC);

            ?>

             <div class="container">
                <?php
                    $imagePath = '../admin/uploaded_images/' . $a['promoImage'] ;
                    echo '<img src="' . $imagePath . '" alt="" class=image>';
                ?>

                <div class="text">
                    <a href="../app/menu.php"><h2><?= $a['promoName'] ?></h2></a>
                    <p>Promo code: <?= $a['promoCode'] ?></p>
                    <br/>
                    <p><?= $a['description'] ?></p>
                </div>
            </div>
            <br>

            <?php
                    }
                }
                    
            ?>
            
        </div>
        <?php include 'footer.php';?>
        <script src="../js/script.js"></script>
        
    </body>
</html>