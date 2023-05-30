<head>
        <link rel="stylesheet" href="../css/instore_hours.css">
</head>
<footer class="footer">
    <div class="container">
        <nav class="footer_navbar">
            <a onclick="window.instore.showModal();">In-Store Hours</a>
            <a onclick="window.delivery.showModal();">Delivery Hours</a>
<!-- MODIFIED CODE BEGINS HERE -->    
            <a href="https://www.google.com/maps/place/Blaze+Pizza/@52.212022,-113.815152,16z/data=!4m6!3m5!1s0x5374575b9ea44865:0xdaf669dd1a7d6aa9!8m2!3d52.2120217!4d-113.8151519!16s%2Fg%2F11g3yw1nk9?hl=en&entry=ttu" target="_blank">Location</a>
            <a href="#">Rewards</a>
            <a href="../app/developers.php">Developers</a>
            <br>
        </nav>
        <div class="footer_image">
            <a class="link" href="../app/index.php">
            <img src="../assets/logos/blazepizza.png" alt="Blaze Pizza" class="footer_logo">
            </a>
<!-- MODIFIED CODE ENDS HERE -->    
        </div>
    </div>
    <dialog id="instore">
        <h2>In-Store Hours</h2>
        <table>
            <tr>
                <td>Sunday:</td>
                <td>11:00 AM to 7:00 PM</td>
            </tr>
            <tr>
                <td>Monday:</td>
                <td>11:00 AM to 7:00 PM</td>
            </tr>
            <tr>
                <td>Tuesday:</td>
                <td>11:00 AM to 7:00 PM</td>
            </tr>

            <tr>
                <td>Wednesday:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>11:00 AM to 7:00 PM</td>
            </tr>
            <tr>
                <td>Thursday:</td>
                <td>11:00 AM to 7:00 PM</td>
            </tr>
            <tr>
                <td>Friday:</td>
                <td>11:00 AM to 7:00 PM</td>
            </tr>
            <tr>
                <td>Saturday:</td>
                <td>11:00 AM to 7:00 PM</td>
            </tr>
        </table>
        <a onclick="window.instore.close();" aria-label="close" class="x">❌</a>
    </dialog>
    <dialog id="delivery">
        <h2>Delivery Hours</h2>
        <table>
            <tr>
                <td>Sunday:</td>
                <td>11:00 AM to 7:00 PM</td>
            </tr>
            <tr>
                <td>Monday:</td>
                <td>11:30 AM to 10:00 PM</td>
            </tr>
            <tr>
                <td>Tuesday:</td>
                <td>11:30 AM to 10:00 PM</td>
            </tr>

            <tr>
                <td>Wednesday:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>11:30 AM to 10:00 PM</td>
            </tr>
            <tr>
                <td>Thursday:</td>
                <td>11:30 AM to 10:00 PM</td>
            </tr>
            <tr>
                <td>Friday:</td>
                <td>11:30 AM to 10:00 PM</td>
            </tr>
            <tr>
                <td>Saturday:</td>
                <td>11:30 AM to 10:00 PM</td>
            </tr>
        </table>
        <a onclick="window.delivery.close();" aria-label="close" class="x">❌</a>
    </dialog>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../js/nav.js"></script>