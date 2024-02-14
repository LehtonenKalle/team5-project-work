<?php
include ("connect.php");
// Hakee databasesta tiedon
$sql = "SELECT * FROM news ORDER BY id DESC";
$result = $yhteys->query($sql);


// näyttää postauksen
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        print "<div class='article-box'><article class='article-preview'><h3>" . $row["title"] . "</h3><p>" . $row["content"] . "</p><button type='button' class='btn btn-secondary'>Read More</button></article></div>";
        if ($row["image_data"]) {
            $src = $row["image_data"];
            print "<img src='" . $src . "' alt='Post Image'>";
        }
        print "<hr>";
    }
} else {
    print "Ei uutisia.";
}

//$yhteys->close();
?>