<?php
include("../connect.php");

// katsotaan onko lähetetty tietoa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // otetaan data vastaan
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    // Syötetään tiedot tietokantaan
    $sql = "INSERT INTO palaute (first_name, last_name, email, comment) VALUES (?, ?, ?, ?)";
    
    // Bind parameters and execute the statement
    $stmt = $yhteys->prepare($sql);
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $comment);
    $stmt->execute();
    
    // Close statement
    $stmt->close();

    exit();
}

// suljetaan yhteys tietokantaan
$yhteys->close();
?>