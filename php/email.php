<?php
include("../connect.php");

// katsotaan onko lähetetty tietoa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // otetaan data vastaan
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    // Syötetään tiedot tietokantaan
    $sql = "INSERT INTO palaute (firstname, lastname, email, comment) VALUES (?, ?, ?, ?)";
    
    // Bind parameters and execute the statement
    $stmt = $yhteys->prepare($sql);
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $comment);
    $stmt->execute();
    
    // Close statement
    $stmt->close();

    exit();
}

// suljetaan yhteys tietokantaan
$yhteys->close();
?>