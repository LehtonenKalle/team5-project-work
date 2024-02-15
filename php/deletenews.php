<?php
include("../connect.php");

session_start();
$id = $_SESSION["news_id"];

//Jos tieto on annettu, poistetaan henkilo tietokannasta
if (!empty($id)){
    $sql="delete from news where id = ?";
    $stmt=mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttuja sql-lauseeseen
    mysqli_stmt_bind_param($stmt, 'i', $id);
    //Suoritetaan sql-lause
    mysqli_stmt_execute($stmt);
}
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

header("Location: ../index.php");

?>