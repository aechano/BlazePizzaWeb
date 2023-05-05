<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Blaze Pizza - Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom admin style link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
    <?php include 'admin_header.php' ?>

        <section class="dashboard">

        <h1 class="heading">dashboard</h1>

        <div class="box-container">

            <div class="box">
                <h3>$/-</h3>
                <p>total pendings</p>
                <a href="admin_orders.php" class="btn">see orders</a>
            </div>

            <div class="box">
                <h3>$/-</h3>
                <p>completed orders</p>
                <a href="admin_orders.php" class="btn">see orders</a>
            </div>

            <div class="box">
                <h3>0</h3>
                <p>products added</p>
                <a href="admin_products.php" class="btn">see products</a>
            </div>

            <div class="box">

                <h3>0</h3>
                <p>ingredients added</p>
                <a href="admin_ingredients.php" class="btn">see ingredients</a>
            </div>

            <div class="box">
                <h3>0</h3>
                <p>orders placed</p>
                <a href="admin_orders.php" class="btn">see orders</a>
            </div>

            <div class="box">
                <h3>0</h3>
                <p>promos added</p>
                <a href="admin_promos.php" class="btn">see promos</a>
            </div>
            <div class="box">

                <h3>0</h3>
                <p>reports</p>
                <a href="#" class="btn">see reports</a>
            </div>

            <div class="box">
                <h3>0</h3>
                <p>emails</p>
                <a href="#" class="btn">see emails</a>
            </div>

            <div class="box">
                <h3>0</h3>
                <p>ewallet users? or ewallet added sdjfsdujf pabago nalang pi</p>
                <a href="#" class="btn">see ewallet</a>
            </div>

            <div class="box">
                <h3>0</h3>
                <p>total users</p>
                <a href="user_accounts.php" class="btn">see users</a>
            </div>

            <div class="box">
                <h3>0</h3>
                <p>total admin</p>
                <a href="admin_accounts.php" class="btn">see admins</a>
            </div>
            

        </div>

        </section>



<script type="text/javascript" src="../js/admin_script.js"></script>

</body>
</html>