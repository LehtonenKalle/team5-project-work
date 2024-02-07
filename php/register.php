<?php
// Otetaan vastaan JSON-data ja asetetaan se $json-muuttujaan, jos sitä on lähetetty
$json = isset($_POST["user"]) ? $_POST["user"] : "";

// Tarkistetaan, että JSON-datasta on saatu tarvittavat käyttäjätiedot
if (!($user = tarkistaJson($json))) {
    print "Täytä kaikki kentät";
    exit;
}

// Estetään mysqli:n raportointi indeksivirheistä
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try {
    // Yritetään muodostaa yhteys tietokantaan
    $yhteys = mysqli_connect("", "", "", "");
} catch (Exception $e) {
    // Jos yhteyden muodostaminen epäonnistuu, tulostetaan virheilmoitus ja poistutaan
    print "Yhteysvirhe";
    exit;
}

// Valmistellaan SQL-lauseke, jossa kysymysmerkit osoittavat paikat, joihin laitetaan muuttujien arvoja
$sql = "INSERT INTO rekisterointi (tunnus, salasana) VALUES (?, SHA2(?, 256))";

try {
    // Valmistellaan SQL-lauseke tietokantaan
    $stmt = mysqli_prepare($yhteys, $sql);
    // Sitoudutaan muuttujien arvot SQL-lausekkeeseen
    mysqli_stmt_bind_param($stmt, 'ss', $user->tunnus, $user->salasana);
    // Suoritetaan SQL-lauseke
    mysqli_stmt_execute($stmt);
    // Suljetaan tietokantayhteys
    mysqli_close($yhteys);
    // Tulostetaan lisätty JSON-data
    print $json;
} catch (Exception $e) {
    // Jos käyttäjätunnus on jo olemassa, tulostetaan virheilmoitus
    print "Tunnus jo olemassa";
}
?>

<?php
// Funktio, joka tarkistaa JSON-muotoisen käyttäjädatan
function tarkistaJson($json) {
    // Jos JSON-data on tyhjä, palautetaan false
    if (empty($json)) {
        return false;
    }
    // Muunnetaan JSON-data PHP-objektiksi
    $user = json_decode($json, false);
    // Tarkistetaan, että tunnus ja salasana eivät ole tyhjiä
    if (empty($user->tunnus) || empty($user->salasana)) {
        return false;
    }
    // Palautetaan käyttäjäobjekti
    return $user;
}
?>
