<?php

include 'config.php';


if(isset($_POST['register'])){

    $first_name = $_POST['first_name'];
    $first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
    $last_name = $_POST['last_name'];
    $last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
    $birthday = $_POST['birthday'];
    $birthday = filter_var($birthday, FILTER_SANITIZE_STRING);
    $gender = $_POST['gender'];
    $gender = filter_var($gender, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $phone = $_POST['phone'];
    $phone = filter_var($phone, FILTER_SANITIZE_STRING);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = sha1($_POST['cpass'] );
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
 
    $select_user = $conn->prepare("SELECT * FROM `customer` WHERE custFname = ? AND custEmail = ?");
    $select_user->execute([$first_name, $email]);
 
    if($select_user->rowCount() > 0){
       //$message[] = 'username or email already exists!';
       header('location:signup.php');
    }else{
       if($pass != $cpass){
          //$message[] = 'confirm password not matched!';
          header('location:signup.php');
       }else{
          $insert_user = $conn->prepare("INSERT INTO `customer`(custLname, custFname, custBdate, custGender, custEmail, custContactNum, custAddress, custPassword) VALUES(?,?,?,?,?,?,?,?)");
          $insert_user->execute([$last_name, $first_name, $birthday, $gender, $email, $phone, $address, $pass]);
          $message[] = 'registered successfully';
       }
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login - Blaze Pizza</title>
        <?php include 'header.php';?>
        <!-- ===== Iconscout CSS ===== -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="../css/login.css">
        <!--<title>Login & Registration Form</title>-->
    </head>
    <body class=" content">
        <?php include 'navigation.php';?>
        <div class="body-content container">
            <div class="container_log_in_sign_up">
                <div class="forms">
                    <div class="form login">
                        <span class="title">Login</span>

                        <form action="user_login.php" method="POST">
                            <div class="input-field">
                                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                                <i class="uil uil-envelope icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="password" id="pass" name="pass" class="password" placeholder="Enter your password" required>
                                <i class="uil uil-lock icon"></i>
                                <i class="uil uil-eye-slash showHidePw"></i>
                            </div>

                            <div class="checkbox-text">
                                <div class="checkbox-content">
                                    <input type="checkbox" id="logCheck">
                                    <label for="logCheck" class="text">Remember me</label>
                                </div>
                                
                                <a href="#" class="text">Forgot password?</a>
                            </div>

                            <div class="input-field button">
                                <input type="submit" value="Login" name="login">
                            </div>
                        </form>

                        <div class="login-signup">
                            <span class="text">Not a member?
                                <a href="signup.php" class="text signup-link">Signup Now</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../js/script.js"></script>
    </body>
</html>
