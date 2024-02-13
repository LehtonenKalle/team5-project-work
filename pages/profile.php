<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/profile.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Trip Buddies Register page">
    <meta name="author" content="Miika Konttila">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login-register.css">
    <title>Trip Buddies - Change Account Details</title>
</head>
<body>


<?php
// Sisällytetään header 
include("../parts/header.php");
?>

<?php 
// Otetaan yhteys tietokantaan
include("../php/connect.php");

// Tallennetaan tämänhetkiset sessionit erillisiin muuttujiin.
$username = $_SESSION["tunnus"];
$email = $_SESSION["email"];
$id = $_SESSION["id"];
?>

<!-- Tulostetaan lomake tietojen sähköpostin ja käyttäjätunnuksen päivittämiseen -->
<!-- Lomakkeen lähettämisen yhteydessä kutsutaan sendChanges -nimistä funktiota kahdella argumentilla -->
<!-- "this" on tämä lomake ja "$id" on muuttujaan aikasemmin tallennettu session. --> 
<form class='form' method='POST' <?php echo "onsubmit='sendChanges(this, $id); return false;'"?>>
  <div class='col-sm-8 col-sm-offset-3 login'>
    <h1>Change Account Details</h1>
    <p id='result'></p>

    <label for='email'>Email:</label>
    <!-- Annetaan input elementille valmiiksi sessioniin tallennettu sähköposti -->
    <input type='email' class='form-control' placeholder='Enter Email' <?php echo "value='$email'";?> name='email' id='email' required>
    
    <label for='tunnus'>Username:</label>
    <!-- Annetaan input elementille valmiiksi sessioniin tallennettu käyttäjätunnus -->
    <input type='text' class='form-control' placeholder='Enter Username' <?php echo "value='$username'";?> name='username' id='username' required>

    <label for='salasana'>Type your password to confirm:</label>
    <input type='password' class='form-control' placeholder='Enter Password' name='pswd' id='pswd' title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
  </div>
  <button type='submit' class='btn'>Save Changes</button>
</form>

<?php
// Suljetaan yhteys tietokantaan
mysqli_close($yhteys);
?>

<?php 
// Sisällytetään footer
include ("../parts/footer.html");
?>