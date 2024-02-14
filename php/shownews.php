<?php
// Hakee databasesta tiedon
$sql = "SELECT * FROM news ORDER BY id DESC";
$result = $yhteys->query($sql);

print "<p>"."moro"."</p>";

// näyttää postauksen
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        print "<h2>" . $row["title"] . "</h2>";
        print "<p>" . $row["content"] . "</p>";
        if ($row["image_url"]) {
            $imageData = base64_encode($row["image_data"]);
            $src = 'data:image/' . $row["image_type"] . 'base64,' . $image_data;
            print "<img src='" . $src . "' alt='Post Image'>";
        }
        print "<hr>";
    }
} else {
    print "Ei uutisia.";
}

$yhteys->close();
?>