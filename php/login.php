<?php
# Luetaan lomakkeelta tulleet tiedot ja katsotaan onko syötteet olemassa.
if (!isset($_POST["email"])) {
  $email = "";
}

if (!isset($_POST["password"])) {
  $password = "";
}

# Jos jompikumpi tai kumpikin tieto puuttuu, ohjataan pyyntö takaisin lomakkeelle.
if (empty($email) || empty($password)) {
  header("Location:../pages/login.html");
  exit;
}

# Yritetään muodostaa yhteys tietokantaan.
# Jos yhteys tietokantaan epäonnistuu tulostetaan ruudulle yhteysvirhe.html.
include("connect.php")

//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat muuttujille
$sql = "select * from rekisterointi where email=? and password=?"

//Valmistellaan sql-lause
$stmt = mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'ss', $email, $password);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

$tulos = mysqli_stmt_get_result($stmt);

print $tulos
?>