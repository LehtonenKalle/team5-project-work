<?php
include("../connect.php");

$id = isset($_GET["id"]) ? $_GET["id"] : "";

//Jos tieto on annettu, poistetaan henkilo tietokannasta
if (!empty($id)){
    $sql="delete from henkilo where id=?";
    $stmt=mysqli_prepare($yhteys, $sql);
    //Sijoitetaan muuttuja sql-lauseeseen
    mysqli_stmt_bind_param($stmt, 'i', $id);
    //Suoritetaan sql-lause
    mysqli_stmt_execute($stmt);
}
//Suljetaan tietokantayhteys
mysqli_close($yhteys);


?>