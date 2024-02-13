<?php

include("connect.php");

// Hakee databasesta tiedon
$sql = "SELECT * FROM news ORDER BY created_at DESC";
$result = $yhteys->query($sql);

// näyttää postauksen
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        print "<h2>" . $row["title"] . "</h2>";
        print "<p>" . $row["content"] . "</p>";
        if ($row["image_url"]) {
            print "<img src='" . $row["image_url"] . "' alt='Post Image'>";
        }
        print "<hr>";
    }
} else {
    print "Ei uutisia.";
}

$yhteys->close();
?>