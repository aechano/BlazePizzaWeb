<!DOCTYPE html>
<html>
    <head>
        <?php include 'header.php';?>
        <title>About us</title>
        <link rel="stylesheet" href="../css/contact_us.css">
    </head>
    <body>
        <?php include 'navigation.php';?>
        <br><br><br>

        <div class="container content">


            <div class="map">

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2444.726269762176!2d-113.81515189999999!3d52.2120217!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5374575b9ea44865%3A0xdaf669dd1a7d6aa9!2sBlaze%20Pizza!5e0!3m2!1sen!2sph!4v1682327635061!5m2!1sen!2sph" 
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            
            </div>

            <div class="contact1">
                <div class="container-contact1">
                    <div class="contact1-pic">
                        <img src="../assets/logos/round_logo1.png" alt="IMG">
                    </div>

                    <form class="contact1-form validate-form">
                        <span class="contact1-form-title">
                            Get in touch with us!
                        </span>

                        <div class="wrap-input1 validate-input" data-validate = "Name is required">
                            <input class="input1" type="text" name="name" placeholder="Name">
                            <span class="shadow-input1"></span>
                        </div>

                        <div class="wrap-input1 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                            <input class="input1" type="text" name="email" placeholder="Email">
                            <span class="shadow-input1"></span>
                        </div>

                        <div class="wrap-input1 validate-input" data-validate = "Subject is required">
                            <input class="input1" type="text" name="subject" placeholder="Subject">
                            <span class="shadow-input1"></span>
                        </div>

                        <div class="wrap-input1 validate-input" data-validate = "Message is required">
                            <textarea class="input1" name="message" placeholder="Message"></textarea>
                            <span class="shadow-input1"></span>
                        </div>

                        <div class="container-contact1-form-btn">
                            <button class="contact1-form-btn">
                                <span>
                                    Send Email
                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'footer.php';?>
        <script type="text/javascript" src="../js/script.js"></script>
    </body>
</html>