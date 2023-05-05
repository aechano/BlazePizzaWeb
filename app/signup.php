
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Title Page-->
        <title>Signup - Blaze Pizza</title>
        <?php include 'header.php';?>
        <!-- Icons font CSS-->
        <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
        <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <!-- Font special for pages-->
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Vendor CSS-->
        <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
        <link href="../vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

        <!-- Main CSS-->
        <link href="../css/signup.css" rel="stylesheet">
    </head>

    <body class="content">

        <!-- <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '
                    <div class="message">
                        <span>'.$message.'</span>
                        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                    </div>
                    ';
                }
            }
        ?>  -->

        <?php include 'navigation.php';?>
        <div class="signup-body-content">
            <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
                <div class="wrapper wrapper--w680">
                    <div class="card card-4">
                        <div class="card-body">
                            <h2 class="title">Registration Form</h2>
                            <form method="POST" action="login.php">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group">
                                            <label class="label">first name</label>
                                            <input class="input--style-4" type="text" id="first_name" name="first_name" placeholder="Enter your First Name">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group">
                                            <label class="label">last name</label>
                                            <input class="input--style-4" type="text" id="last_name" name="last_name" placeholder="Enter your Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group">
                                            <label class="label">Birthday</label>
                                            <div class="input-group-icon">
                                                <input class="input--style-4 js-datepicker" type="date" data-date-format="YYYY MM DD" id="birthday" name="birthday" placeholder="Enter your Birthday">
                                                <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group">
                                            <label class="label">Gender</label>
                                            <div class="p-t-10">
                                                <label class="radio-container m-r-45">Male
                                                    <input type="radio" name="gender", value="M">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="radio-container">Female
                                                    <input type="radio" name="gender" value="F">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group">
                                            <label class="label">Email</label>
                                            <input class="input--style-4" type="email" id="email" name="email" placeholder="Enter your Email">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group">
                                            <label class="label">Phone Number</label>
                                            <input class="input--style-4" type="text" id="phone" name="phone" placeholder="Enter your Number">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <label class="label">Address</label>
                                    <input type="text" class="input--style-4" id="address" name="address" placeholder="Enter your Address" required>
                                    <i class="uil uil-lock icon"></i>
                                </div>
                                <div class="input-group">
                                    <label class="label">Create a password</label>
                                    <input type="password" class="input--style-4" id="pass" name="pass" placeholder="Confirm a password" required>
                                    <i class="uil uil-lock icon"></i>
                                    <i class="uil uil-eye-slash showHidePw"></i>
                                </div>
                                <div class="input-group">
                                    <label class="label">Confirm a password</label>
                                    <input type="password" class="input--style-4" id="cpass" name="cpass" placeholder="Create a password" required>
                                    <i class="uil uil-lock icon"></i>
                                </div>
                                <div class="p-t-15">
                                <!--KONEK MO ITO DOON SA LOGIN.PHP, I RENAME MO AS login.php eong sa login, tapos signup.php dito sa signup-->
                                    <input value="register" name="register" type="submit"  class="btn btn--radius-2 btn--blue">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jquery JS-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <!-- Vendor JS-->
        <script src="vendor/select2/select2.min.js"></script>
        <script src="vendor/datepicker/moment.min.js"></script>
        <script src="vendor/datepicker/daterangepicker.js"></script>

        <!-- Main JS-->
        <script src="js/global.js"></script>

    </body>

</html>