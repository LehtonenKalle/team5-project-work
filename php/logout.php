<?php
// Lopetetaan session ja mennään takaisin login-sivulle.
session_start();
unset($_SESSION["tunnus"]);
header("Location:../pages/loginpage.php");
?>