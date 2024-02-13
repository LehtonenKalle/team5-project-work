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
include("../parts/header.php");
?>

<?php 
include("../php/connect.php");

$username = $_SESSION["tunnus"];
$email = $_SESSION["email"];
$id = $_SESSION["id"];
?>

<form class='form' method='POST' <?php echo "onsubmit='sendChanges(this, $id);"?> return false;'>
  <div class='col-sm-8 col-sm-offset-3 login'>
    <h1>Change Account Details</h1>
    <p id='result'></p>
    <label for='email'>Email:</label>
    <input type='email' class='form-control' placeholder='Enter Email' <?php echo "value=$email";?> name='email' id='email' required>
    
    <label for='tunnus'>Username:</label>
    <input type='text' class='form-control' placeholder='Enter Username' <?php echo "value=$username";?> name='tunnus' id='tunnus' required>

    <label for='salasana'>Type your password to confirm:</label>
    <input type='password' class='form-control' placeholder='Enter Password' name='salasana' id='salasana' title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
  </div>
  <button type='submit' class='btn'>Save Changes</button>
</form>

<?php
mysqli_close($yhteys);
?>

<?php 
include ("../parts/footer.html");
?>