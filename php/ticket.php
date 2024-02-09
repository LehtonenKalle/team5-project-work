<?php
session_start();

// Tarkistetaan onko käyttäjä kirjautunut sisään
if(isset($_SESSION["user"])) {
    // Käyttäjä on kirjautunut sisään, tallennetaan lippu
    include("connect.php");

    // Tarkistetaan lomakkeelta saadut tiedot
    if(!empty($_POST["customer_group"]) && !empty($_POST["zone"])){
        // Otetaan lomakkeen tiedot vastaan
        $customer_group = $_POST["customer_group"]; // Asiakasryhmä merkkijonona
        $zone = $_POST["zone"];
        $user_email = $_SESSION["user"];

        // Haetaan käyttäjän id tietokannasta
        $user_query = mysqli_query($yhteys, "SELECT id FROM kayttaja WHERE email = '$user_email'");
        $user_data = mysqli_fetch_assoc($user_query);
        $user_id = $user_data['id'];

        // Tallennetaan lippu tietokantaan käyttäjän id:n kanssa

        $sql = "INSERT INTO tickets (user_id, customer_group, zone) VALUES (?, ?, ?)";
        $stmt = $yhteys->prepare($sql);
        $stmt->bind_param("iss", $user_id, $customer_group, $zone);
        $stmt->execute();

        // Ohjataan käyttäjä takaisin kotisivulle
        header("Location:../index.html");
        exit();
} else {
    // Jos lomakkeelta puuttuu tietoja, ohjaa takaisin lippusivulle
    header("Location:../pages/ticket.html");
    exit();
}
}else{
    // Jos käyttäjä ei ole kirjautunut sisään, ohjaa takaisin kirjautumissivulle
    header("Location:../pages/login.html");
    exit();
}
?>