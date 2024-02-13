<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Käsitellään kuvin lataus
    $image_url = null;
    $uploadOk = 1;

    // tarkistetaan on kyseessä kuva vai ei
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        // tiedosto on kuva
        $uploadOk = 1;
    } else {
        print "File is not an image.";
        $uploadOk = 0;
    }

    // tarkistetaan tiedoston koko
    if ($_FILES["image"]["size"] > 500000) {
        print "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Sallitaan tietyt tiedosto tyypit
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        print "Vain JPG, JPEG, PNG & GIF tiedostos sallittuja.";
        $uploadOk = 0;
    }

    // Jatketaan jos kaikki on ok
    if ($uploadOk == 1) {
        $image_url = 'uploads/' . uniqid() . '_' . $_FILES["image"]["name"];
            // Laitetaan tiedosto tietokantaan
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $image_url)){
            
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
        } else {
            print "Tiedostoa ladattaessa tuli virhe.";
        }
    } else {
        print "Valitettavasti tiedostoasi ei ladattu.";
    }

}
?>