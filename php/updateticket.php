<?php
session_start();

// Tarkistetaan onko käyttäjä kirjautunut sisään.
if(isset($_SESSION["tunnus"])) {
    include("../php/connect.php");
    // Käyttäjä on kirjautunut sisään, tallennetaan lippu
    // Haetaan käyttäjän ID tietokannasta
    $tunnus = $_SESSION["tunnus"];
    $user_query = mysqli_query($yhteys, "SELECT id FROM kayttaja WHERE tunnus = '$tunnus'");
    if(mysqli_num_rows($user_query) > 0) {
        // Käyttäjän tunnus löytyi tietokannasta, haetaan ID ja asetetaan se muuttujaan
        $user_data = mysqli_fetch_assoc($user_query);
        $user_id = $user_data['id'];
    } else {
        // Käyttäjän tunnusta ei löytynyt tietokannasta, käsittele virhe asianmukaisesti
        echo "Virhe: Käyttäjän ID:tä ei löydy.";
        exit(); // Lopetetaan suoritus virheen kohdalla
    }

    if (!isset($user_id) || empty($user_id)) {
        echo "Virheellinen käyttäjä-ID: Tarkista, että käyttäjä on kirjautunut sisään ja että käyttäjä-ID on määritelty oikein.";
        exit(); // Lopeta suoritus, jos käyttäjä-ID puuttuu tai on virheellinen
    }

    // Tarkista, että tietokantayhteys ($yhteys) on määritelty oikein ja toimii odotetusti
    if (!$yhteys) {
        die("Yhteysongelma: Tietokantayhteys ei ole käytettävissä. Varmista, että tietokantapalvelin on käynnissä ja saavutettavissa.");
    }

    // Tarkistetaan lomakkeelta saadut tiedot
    if(!empty($_POST["customer_group"]) && !empty($_POST["zone"])){
        // Otetaan lomakkeen tiedot vastaan
        $customer_group = $_POST["customer_group"]; // Asiakasryhmä merkkijonona
        $zone = $_POST["zone"];
        $tunnus = $_SESSION["tunnus"]; // Käyttäjän tunnus

        // Tallennetaan lippu tietokantaan käyttäjän id:n kanssa
        $sql = "INSERT INTO tickets (user_id, customer_group, zone) VALUES (?, ?, ?)";
        $stmt = $yhteys->prepare($sql);
        $stmt->bind_param("iss", $user_id, $customer_group, $zone);
        $stmt->execute();

        // Ohjataan käyttäjä takaisin lippusivulle
        header("Location:../pages/ticket.php");

        // Tarkistetaan ja päivitetään vanhentuneet liput
        $ticket_query = mysqli_query($yhteys, "SELECT * FROM tickets WHERE user_id = '$user_id' AND expired_tickets = 0");
        while ($ticket_data = mysqli_fetch_assoc($ticket_query)) {
            $ticket_id = $ticket_data['ticket_id'];
            $purchase_date = strtotime($ticket_data['purchase_date']);
            $expiration_date = strtotime('+24 hours', $purchase_date); // Lisätään 24 tuntia ostopäivämäärään
            if (time() > $expiration_date) {
                mysqli_query($yhteys, "UPDATE tickets SET expired_tickets = 1 WHERE ticket_id = '$ticket_id'");
            }
        }
        
        // Ohjataan käyttäjä takaisin kotisivulle
        header("Location:../index.php");
        exit();
    } else {
        // Jos lomakkeelta puuttuu tietoja, ohjaa takaisin lippusivulle
        header("Location:../pages/ticket.php");
        exit();
    }

} else {
    // Jos käyttäjä ei ole kirjautunut sisään, ohjaa takaisin kirjautumissivulle
    header("Location:../pages/login.php");
    exit();
}
?>

