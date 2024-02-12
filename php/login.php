<?php
session_start();
$json = isset($_POST["user"]) ? $_POST["user"] : "";

if (!($user = checkJson($json))) {
  print "There are empty fields.";
  exit;
}

include("connect.php");

$sql = "select * from kayttaja where tunnus = ? and salasana = SHA2(?, 256)";
try {
  //Valmistellaan sql-lause
  $stmt = mysqli_prepare($yhteys, $sql);
  //Sijoitetaan muuttujat oikeisiin paikkoihin
  mysqli_stmt_bind_param($stmt, 'ss', $user->tunnus, $user->pswd);
  //Suoritetaan sql-lause
  mysqli_stmt_execute($stmt);
  //Koska luetaan prepared statementilla, result haetaan
  //metodilla mysqli_stmt_get_result($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if ($row = mysqli_fetch_object($result)){
      $_SESSION["id"] = "$row->id";
      $_SESSION["tunnus"] = "$row->tunnus";
      $_SESSION["email"] = "$row->email";

      print "ok";
      exit;
  } else {
    print "Check that everything is filled correctly.";
  }
  //Suljetaan tietokantayhteys
  mysqli_close($yhteys);
} catch (Exception $e) {
  print "Error!";
}
?>

<?php
function checkJson($json) {
  if (empty($json)) {
    return false;
  }

  $user = json_decode($json, false);
  if (empty($user->tunnus) || empty($user->pswd)) {
    return false;
  }

  return $user;
}
?>