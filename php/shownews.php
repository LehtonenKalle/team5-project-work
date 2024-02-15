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
        <button type='button' class='btn btn-secondary'>Read More</button>".
        isAdmin($row)
        .        
        "</article>
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

function isAdmin($row) {
    if ($_SESSION["tunnus"] == "Admin") {
        $_SESSION["news_id"] = $row["id"];
        return "<button type='link' class='btn btn-secondary' style='margin-left: 5px; background-color: #8B0000;'><a style='text-decoration: none; color: #FFFFFF;' href='php/deletenews.php'>Delete</a></button>";
    }
}
?>