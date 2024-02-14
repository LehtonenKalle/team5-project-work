<?php
session_start();

// Tarkistetaan onko käyttäjä kirjautunut sisään.
if(isset($_SESSION["tunnus"])) {
    include("../php/connect.php");
    // Käyttäjä on kirjautunut sisään, tallennetaan lippu
    // Haetaan käyttäjän ID tietokannasta
    $id = $_SESSION["id"];

    if (empty($id)) {
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
        $stmt->bind_param("iss", $id, $customer_group, $zone);
        $stmt->execute();

        // Ohjataan käyttäjä takaisin lippusivulle
        header("Location:../pages/ticket.php");

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

