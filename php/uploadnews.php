<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_FILES["image"])) {
        // Yhteys Tietokantaan
        include("connect.php");

        // Tiedon tallennus
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Tarkistetaan onko kyseessä kuva vai ei
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check === false) {
            print "Tiedosto ei ole kuva.";
            $uploadOk = 0;
        }

        // tarkistetaan tiedoston koko
        if ($_FILES["image"]["size"] > 500000) {
            print "Tiedosto on liian suuri.";
            $uploadOk = 0;
        }

        // Sallitaan vain tietyn tyyppiset tiedostot
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            print "Vain JPG, JPEG, PNG & GIF tiedostot sallittu.";
            $uploadOk = 0;
        }

        // Katsotaan onko virhettä
        if ($uploadOk == 0) {
            print "Virhe tiedostoa ei ladattu.";
        } else {
            // Yritetään ladata tiedosto
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // lataus onnistui joten laitetaan se tietokantaan
                $title = $_POST["title"];
                $content = $_POST["content"];
                $image_data = file_get_contents($_FILES["image"]["tmp_name"]);

                $sql = "INSERT INTO news (title, content, image_data) VALUES (?, ?, ?)";
                $stmt = $yhteys->prepare($sql);
                $stmt->bind_param("sss", $title, $content, $image_data);

                if ($stmt->execute()) {
                    print "Onnistunut tiedon lataus.";
                    header("Location: shownews.php");
                } else {
                    print "Error: " . $sql . "<br>" . $stmt->error;
                }

                $stmt->close();
            } else {
                print "Virhe tietoa ladatessa.";
            }
        }

        // Suljetaan yhteys
        $yhteys->close();
    } else {
        print "Täytä kaikki kentät.";
    }
}
?>