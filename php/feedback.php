<?php
include("connect.php");

// katsotaan onko lähetetty tietoa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // katsotaan onko tyhjää tietoa
    $required_data = ['firstname', 'lastname', 'email', 'comment'];
    $errors = array();
    foreach ($required_data as $required){
        if (empty($_POST[$required])){
            $errors[] = "Puutteellista tietoa";
        }
    }
    //jos on tyhjää
    if (!empty($errors)){
        foreach ($errors as $error){
            print  $error . '<br>';
        }
        exit;
    }
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
    header("Location:../pages/customerservice.php");
    exit();
}

// suljetaan yhteys tietokantaan
$yhteys->close();
?>