<?php
// Otetaan tämänhetkinen session käyttöön.
session_start();
// Otetaan vastaan JSON-data ja asetetaan se $json-muuttujaan, jos sitä on lähetetty.
$json = isset($_POST["user"]) ? $_POST["user"] : "";

// Tarkistetaan, että JSON-datasta on saatu tarvittavat käyttäjätiedot
if (!($user = checkJson($json))) {
    print "Fill all fields";
    exit;
}

// Estetään mysqli:n raportointi indeksivirheistä
// Yritetään muodostaa yhteys tietokantaan
// Jos yhteyden muodostaminen epäonnistuu, tulostetaan virheilmoitus ja poistutaan
include("connect.php");

// Valmistellaan SQL-lauseke, jossa kysymysmerkit osoittavat paikat, joihin laitetaan muuttujien arvoja
$sql = "UPDATE kayttaja SET email = ?, tunnus = ? WHERE id = ? AND salasana = SHA2(?, 256)";

try {
    // Valmistellaan SQL-lauseke tietokantaan
    $stmt = mysqli_prepare($yhteys, $sql);
    // Sitoudutaan muuttujien arvot SQL-lausekkeeseen
    mysqli_stmt_bind_param($stmt, 'ssis', $user->email, $user->username, $user->id, $user->pswd);
    // Suoritetaan SQL-lauseke
    mysqli_stmt_execute($stmt);
    
    // Katsotaan muutettujen rivien määrät, jotta saadaan selville onnistuiko SQL-kysely.
    // Jos löytyy enemmän kuin nolla muokattua riviä, päivitetään session. 
    if (mysqli_affected_rows($yhteys) > 0) {
        $_SESSION["id"] = $user->id;
        $_SESSION["tunnus"] = $user->username;
        $_SESSION["email"] = $user->email;
        print "ok";
        exit();
    } else {
        print "Wrong password."; // Muussa tapauksessa tulostetaan merkkijono virheellisen salasanan vuoksi
    }
} catch (Exception $e) {
    // Jos käyttäjätunnus tai s-posti on jo olemassa, tulostetaan virheilmoitus
    print "Username or email address is already in use.";
}


?>

<?php
// Funktio, joka tarkistaa JSON-muotoisen käyttäjädatan
function checkJson($json) {
    // Jos JSON-data on tyhjä, palautetaan false
    if (empty($json)) {
        print("empty json");
        return false;
    }
    // Muunnetaan JSON-data PHP-objektiksi
    $user = json_decode($json, false);
    // Tarkistetaan, että tunnus, s-posti tai salasana eivät ole tyhjiä
    if (empty($user->email) || empty($user->username) || empty($user->pswd)) {
        return false;
    }
    // Palautetaan käyttäjäobjekti
    return $user;
}
?>
