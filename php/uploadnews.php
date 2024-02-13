<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Käsitellään kuvin lataus
    $image_url = null;
    if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $image_url = 'uploads/' . uniqid() . '_' . $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_url);
    }

// Laitetaan uutinen tietokantaan
$title = $_POST["title"];
$content = $_POST["content"];
    
include("connect.php");

$sql = "INSERT INTO news (title, content, image_url) VALUES ('$title', '$content', '$image_url')";
    if ($yhteys->query($sql) === TRUE) {
        print "Tietojen lähetys onnistui";
    } else {
        print "Virhe: " . $sql . "<br>" . $yhteys->error;
    }

$yhteys->close();
}


?>