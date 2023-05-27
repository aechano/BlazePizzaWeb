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
                    echo'<img  src="data:image/png;base64,' .base64_encode($a['promoImage']).'" alt="Promo Image" class="image"/>';
                ?>

                <div class="text">
                    <h2><?= $a['promoName'] ?></h2>
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