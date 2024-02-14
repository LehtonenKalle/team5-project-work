<?php
include ("connect.php");
// Hakee databasesta tiedon
$sql = "SELECT * FROM news ORDER BY id DESC";
$result = $yhteys->query($sql);

// näyttää postauksen
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        print "<div class='article-box'>            
        <div class='img-container'>"
        .testImage($row).
        "</div>
        <article class='article-preview'>
        <h3>" . $row["title"] . "</h3>
        <p>" . $row["content"] . "</p>
        <button type='button' class='btn btn-secondary'>Read More</button>
        </article>
        </div>";
    }
} 

$yhteys->close();
?>
<?php
// Jos jos ladattua kuvaa ei ole olemassa, käytetään vaihtoehtoista kuvaa.
function testImage($row) {
    if ($row["image_data"]) {
        $src = $row["image_data"];
        return "<img class='img-thumbnail' src='" . $src . "' alt='Post Image'>";
    } else {
        return "<img class='img-thumbnail' src='images/redbus.jpg' alt='Red bus'>";
    }
}
?>