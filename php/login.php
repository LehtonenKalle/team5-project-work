<?php
session_start();
$json = isset($_POST["user"]) ? $_POST["User"] : "";

if (!($user = checkJson($json))) {
  print "Check that everything is filled";
  exit;
}

include("connect.php");

$sql = "select * from rekisterointi where email = ? and salasana = SHA2(?, 256)";
try {
  //Valmistellaan sql-lause
  $stmt = mysqli_prepare($yhteys, $sql);
  //Sijoitetaan muuttujat oikeisiin paikkoihin
  mysqli_stmt_bind_param($stmt, 'ss', $user->email, $user->pswd);
  //Suoritetaan sql-lause
  mysqli_stmt_execute($stmt);
  //Koska luetaan prepared statementilla, result haetaan
  //metodilla mysqli_stmt_get_result($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if ($line = mysqli_fetch_object($result)){
      $_SESSION["user"] = "$line->email";
      print "ok";
      exit;
  }
  //Suljetaan tietokantayhteys
  mysqli_close($yhteys);
  print $json;
} catch (Exception $e) {
  print "Virhe!";
}
?>

<?php
function checkJson($json) {
  if (empty($json)) {
    return false;
  }

  $user = $json_decode($json, false);
  if (empty($user->email) || empty($user->pswd)) {
    return false;
  }

  return $user;
}