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
            <div class="container">
                <img class="profile_pic" src="../assets/developers/Echano.png" alt="Profile Picture">
                <br>
                <p class="profile_name">Angelo Echano</p>
                <p class="changepic_btn">Change Profile</p>
            </div>
            <div class="container">
                <p class="title">Account Settings:</p>
            </div>
            <div class="account-info">
                <div class="indiv-info">
                    <p class="acc-info-title">First Name:</p>
                    <textarea type="text" class="acc-info-content" readonly>Angelo</textarea>
                </div>
                <div class="indiv-info">
                    <p class="acc-info-title">Last Name:</p>
                    <textarea type="text" class="acc-info-content" readonly>Echano</textarea>
                </div>
                <div class="indiv-info">
                    <p class="acc-info-title">Email Address:</p>
                    <textarea type="text" class="acc-info-content" readonly>angelo.echano@example.ca</textarea>

                </div>
                <div class="indiv-info">
                    <p class="acc-info-title">Phone Number:</p>
                    <textarea type="text" class="acc-info-content" readonly>(403) 555-1234</textarea>
                </div>
                <div class="indiv-info">
                    <p class="acc-info-title">Address:</p>
                    <textarea type="text" class="acc-info-content2" readonly>123 Main Street, Red Deer, AB T4N 2R2, Canada</textarea>
                </div>
                <div class="indiv-info">
                    <p class="acc-info-title">E-Wallet:</p>
                    <textarea type="text" class="acc-info-content" readonly>$999</textarea>
                </div>
                <!-- To add, just copy the code below
                <div class="indiv-info">
                    <p class="acc-info-title">Title goes here</p>
                    <textarea type="text" class="acc-info-content" readonly>Content goes here</textarea>
                </div>
                -->
            </div>
        </div>
        <script type="text/javascript" src="../js/script.js"></script>
    </body>
</html>