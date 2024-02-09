<?php
// Otetaan vastaan JSON-data ja asetetaan se $json-muuttujaan, jos sitä on lähetetty
$json = isset($_POST["user"]) ? $_POST["user"] : "";

// Tarkistetaan, että JSON-datasta on saatu tarvittavat käyttäjätiedot
if (!($user = tarkistaJson($json))) {
    print "Fill all fields";
    exit;
}

// Estetään mysqli:n raportointi indeksivirheistä
// Yritetään muodostaa yhteys tietokantaan
// Jos yhteyden muodostaminen epäonnistuu, tulostetaan virheilmoitus ja poistutaan
include("connect.php");

$check = "SELECT tunnus, email FROM kayttaja WHERE tunnus = ? OR email = ?";
$stmt = mysqli_prepare($yhteys, $check);
mysqli_stmt_bind_param($stmt, 'ss', $user->tunnus, $user->email);
mysqli_stmt_execute($stmt);
$mysqli_stmt = mysqli_stmt_store_result($stmt);

// Jos löytyy tuloksia, käyttäjätunnus tai sähköposti on jo käytössä
if ($mysqli_stmt == true) {
    print "Error";
    exit;
} 

// Valmistellaan SQL-lauseke, jossa kysymysmerkit osoittavat paikat, joihin laitetaan muuttujien arvoja
$sql = "INSERT INTO kayttaja (email, salasana, tunnus) VALUES (?, SHA2(?, 256), ?)";

try {
    // Valmistellaan SQL-lauseke tietokantaan
    $stmt = mysqli_prepare($yhteys, $sql);
    // Sitoudutaan muuttujien arvot SQL-lausekkeeseen
    mysqli_stmt_bind_param($stmt, 'sss', $user->email, $user->salasana, $user->tunnus);
    // Suoritetaan SQL-lauseke
    mysqli_stmt_execute($stmt);
    // Suljetaan tietokantayhteys
    mysqli_close($yhteys);
    // Tulostetaan lisätty JSON-data
    print "$json";
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
        print("empty json");
        return false;
    }
    // Muunnetaan JSON-data PHP-objektiksi
    $user = json_decode($json, false);
    // Tarkistetaan, että tunnus, s-posti tai salasana eivät ole tyhjiä
    if (empty($user->email) || empty($user->salasana) || empty($user->tunnus)) {
        return false;
    }
    // Palautetaan käyttäjäobjekti
    return $user;
}
?>
