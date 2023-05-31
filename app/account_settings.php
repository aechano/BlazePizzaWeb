<!DOCTYPE html>
<html>
    <head>
        <title>Developers</title>
        <?php include 'header.php';?>
        <link rel="stylesheet" href="../css/account_settings.css">
    </head>
    <body>
        <?php include 'navigation.php';?>
        
        <div class="content">

            <?php
                $select_user = $conn->prepare("SELECT * FROM `customer` WHERE customerID = ?");
                $select_user->execute([$customer_id]);
                if($select_user->rowCount() > 0){
                    while($fetch_user = $select_user->fetch(PDO::FETCH_ASSOC)){
                    
            ?>



            <div class="container">
                <img class="profile_pic" src="../assets/developers/Echano.png" alt="Profile Picture">
                <br>
                <p class="profile_name"><?= $fetch_user['custFname'];?><?= $fetch_user['custLname'];?></p>
            </div>
            <div class="container">
                <p class="title">Account Settings:</p>
            </div>
            <div class="account-info">
                <div class="indiv-info">
                    <p class="acc-info-title">First Name:</p>
                    <textarea type="text" class="acc-info-content" readonly><?= $fetch_user['custFname'];?></textarea>
                </div>
                <div class="indiv-info">
                    <p class="acc-info-title">Last Name:</p>
                    <textarea type="text" class="acc-info-content" readonly><?= $fetch_user['custLname'];?></textarea>
                </div>
                <div class="indiv-info">
                    <p class="acc-info-title">Email Address:</p>
                    <textarea type="text" class="acc-info-content" readonly><?= $fetch_user['custEmail'];?></textarea>

                </div>
                <div class="indiv-info">
                    <p class="acc-info-title">Phone Number:</p>
                    <textarea type="text" class="acc-info-content" readonly><?= $fetch_user['custContactNum'];?></textarea>
                </div>
                <div class="indiv-info">
                    <p class="acc-info-title">Address:</p>
                    <textarea type="text" class="acc-info-content2" readonly><?= $fetch_user['custAddress'];?></textarea>
                </div>
                
                <?php
                $select_price = $conn->prepare("SELECT * FROM `ewallet` WHERE customerID = ?");
                $select_price->execute([$customer_id]);
                if($select_price->rowCount() > 0){
                    while($fetch_price = $select_price->fetch(PDO::FETCH_ASSOC)){
                    
                ?>

                <div class="indiv-info">
                    <p class="acc-info-title">E-Wallet:</p>
                    <textarea type="text" class="acc-info-content" readonly><?= $fetch_price['balance'];?></textarea>
                </div>
                
                <?php
                        }
                    }
                ?>
            
                <!-- To add, just copy the code below
                <div class="indiv-info">
                    <p class="acc-info-title">Title goes here</p>
                    <textarea type="text" class="acc-info-content" readonly>Content goes here</textarea>
                </div>
                -->
            </div>
            <?php
                    }
                }
            ?>
        </div>
        <script type="text/javascript" src="../js/script.js"></script>
    </body>
</html>