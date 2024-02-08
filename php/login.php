<?php
# Yritetään muodostaa yhteys tietokantaan.
# Jos yhteys tietokantaan epäonnistuu tulostetaan ruudulle yhteysvirhe.html.
include("connect.php")

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

?>