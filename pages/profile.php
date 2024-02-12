<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Trip Buddies Register page">
    <meta name="author" content="Miika Konttila">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login-register.css">
    <title>Trip Buddies - Change Account Details</title>
    <script>
    // Funktio, joka lähettää käyttäjätiedot palvelimelle lomakkeen avulla
    function sendChanges(form, id) {

    event.preventDefault;

    
    // Luodaan uusi käyttäjäobjekti
    var user = {
        email: form.email.value,
        tunnus: form.tunnus.value,
        id: id
    };
    // Muunnetaan käyttäjäobjekti JSON-muotoon
    var jsonUser = JSON.stringify(user);

    // Luodaan uusi XMLHttpRequest-objekti, jolla tehdään HTTP-pyyntö
    xmlhttp = new XMLHttpRequest();
    // Määritetään funktio, joka suoritetaan aina, kun XMLHttpRequest-objektin tila muuttuu
    xmlhttp.onreadystatechange = function() {
    // Tarkistetaan, onko pyyntö valmis (readyState 4) ja onko vastauksen statuskoodi 200 (OK)
    if (this.readyState == 4 && this.status == 200) {
        window.location.assign("profile.php");
    } 
    };
    // Avataan uusi POST-tyyppinen HTTP-pyyntö määritetylle palvelimelle ja resurssille
    xmlhttp.open("POST", "../php/edit.php", true);
    // Asetetaan pyynnön otsikkoon sisällön tyyppi
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Lähetetään käyttäjätiedot HTTP-pyynnön mukana palvelimelle
    xmlhttp.send("user=" + jsonUser);
    }

</script>
</head>
<body>
<header>
    <nav class="nav-bar">
        <ul class="nav-list">
            <li><a class="nav-link" href="../index.php">Home</a></li>
            <li><a class="nav-link" href="travelling.html">Travelling</a></li>
            <li><a class="nav-link" href="ticket.html">Tickets</a></li>
            <li><a class="nav-link" href="customerservice.html">Customer Service</a></li>
            <li id="login">
                <?php 
                if (isset($_SESSION["tunnus"])) {
                    print "<button class='dropdown-btn' href='login.php'>".$_SESSION["tunnus"]."</button>". 
                    "<div class='dropdown-content'>
                        <a href='php/login.php'>Profile</a>
                        <a href='php/logout.php'>Log out</a>
                    </div>";
                } else {
                    print "<a class='nav-link' id='login-link' href='login.php'>Log in</a>";
                }
                ?>
            </li>
        </ul>
    </nav>
</header>
<?php 
include("../php/connect.php");

$username = $_SESSION["tunnus"];
$email = $_SESSION["email"];
$id = $_SESSION["id"];

print "
<form class='form' method='POST' onsubmit='sendChanges(this, $id); return false;'>
  <div class='col-sm-8 col-sm-offset-3 login'>
    <h1>Change Account Details</h1>
    <p id='result'></p>
    <label for='email'>Email:</label>
    <input type='email' class='form-control' placeholder='Enter Email' value='$email' name='email' id='email' required>
    
    <label for='tunnus'>Username:</label>
    <input type='text' class='form-control' placeholder='Enter Username' value='$username' name='tunnus' id='tunnus' required>

    <label for='salasana'>Password:</label>
    <input type='password' class='form-control' placeholder='Enter Password' value'$password' name='salasana' id='salasana' required>

    <label for='salasana-uudelleen'>Repeat Password:</label>
    <input type='password' class='form-control' placeholder='Repeat Password' value'$password' name='salasana-uudelleen' id='salasana-uudelleen' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}' title='Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters' required>
  </div>
  <button type='submit' class='btn'>Save Changes</button>
</form>";

mysqli_close($yhteys);
?>

<!-- <footer>
    <p>&#169; Copyright Trip Buddies</p>
    <p><a href="../pages/termsofuse.html">Terms of Use</a></p>
    <p><a href="../pages/privacy.html">Privacy</a></p>
</footer> -->
    
</body>
</html>

<?php 

?>