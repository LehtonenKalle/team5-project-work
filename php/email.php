<?php
// yheteyden otto parametrit
$servername = "";
$username = "";
$password = "";
$database = "";

// luodaan yhteys
$yhteys = new mysqli($servername, $username, $password, $database);

// tarkastetaan yhteys
if ($yhteys->connect_error) {
    die("Connection failed: " . $yhteys->connect_error);
}

// katsotaan onko lähetetty tietoa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // otetaan data vastaan
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];

    // Syötetään tiedot tietokantaan
    $sql = "INSERT INTO contact_entries (first_name, last_name, email, comment) VALUES (?, ?, ?, ?)";
    
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