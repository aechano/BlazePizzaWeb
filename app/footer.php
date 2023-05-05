<head>
        <link rel="stylesheet" href="../css/instore_hours.css">
</head>
<footer class="footer">
    <div class="container">
        <nav class="footer_navbar">
            <a onclick="window.instore.showModal();">In-Store Hours</a>
            <a onclick="window.delivery.showModal();">Delivery Hours</a>
            <a href="#">Location</a>
            <a href="#">Rewards</a>
            <a href="../app/developers.php">Developers</a>
        </nav>
        <div class="footer_image">
            <img src="../assets/logos/blazepizza.png" alt="Blaze Pizza" class="footer_logo">
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