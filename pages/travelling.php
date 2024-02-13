<?php 
// Avataan tämänhetkinen session.
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Trip Buddies offers the best travelling experience out there. Where would you like to go first?">
    <meta name="author" content="Kalle Lehtonen">
    <title>Trip Buddies - Travelling</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/travelling.css">
</head>
<body>
<?php
include ("../parts/header.php");
?>
    <main>
        <h1>Travelling</h1>
        <section id="groups-section">
            <h2>Information for different groups.</h2>
            <div id="groups-container">
                <a href="#" id="students-box" class="group">
                    <h3>Students</h3>
                    <span style='font-size:100px;'>&#128366;</span>
                </a>
                <a href="#" id="elderly-box" class="group">
                    <h3>Elderly</h3>
                    <span style='font-size:100px;'>&#128712;</span>
                </a>
                <a href="#" id="companies-box" class="group">
                    <h3>Companies</h3>
                    <span style='font-size:100px;'>&#128712;</span>
                </a>
                <a href="#" id="others-box" class="group">
                    <h3>Others</h3>
                    <span style='font-size:100px;'>&#128712;</span>
                </a>
            </div>
        </section>
        <section id="map-section">
            <h2>See the exact bus routes below</h2>
            <div id="map-container">
                <form class="label-and-input">
                    <label for="from">From</label>
                    <input type="text" id="from" class="form-control" placeholder="From" data-np-intersection-state="observed">
                </form>
                <form class="label-and-input">
                    <label for="to">To</label>
                    <input type="text" id="to" class="form-control" placeholder="To" data-np-intersection-state="observed">
                </form>
                <iframe title="travel map" class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d494590.54701496894!2d23.85337875857592!3d61.03788809982694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x468e5c42a583f8cb%3A0x400b551554bad30!2sH%C3%A4meenlinna%2C%20Suomi!5e0!3m2!1sfi!2sse!4v1705930324870!5m2!1sfi!2sse" 
                 allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
    </main>
<?php
include ("../parts/footer.html");
?>
</body>
</html>