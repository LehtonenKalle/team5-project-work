<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="With Trip Buddies buying tickets for bus rides has never been easier. Where would you like to go first?">
    <meta name="author" content="Kalle Lehtonen">
    <title>Trip Buddies - Home Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/login.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
</head> 
<body>
<header>
    <nav class="nav-bar">
        <ul class="nav-list">
            <li><a class="nav-link" href="index.php">Home</a></li>
            <li><a class="nav-link" href="pages/travelling.php">Travelling</a></li>
            <li><a class="nav-link" href="pages/ticket.php">Tickets</a></li>
            <li><a class="nav-link" href="pages/customerservice.php">Customer Service</a></li>
            <li id="login">
                <?php 
                if (isset($_SESSION["tunnus"])) {
                    print "<button class='dropdown-btn' href='pages/login.html'>".$_SESSION["tunnus"]."</button>". 
                    "<div class='dropdown-content'>
                        <a href='pages/profile.php'>Profile</a>
                        <a href='php/logout.php'>Log out</a>
                    </div>";
                } else {
                    print "<a class='nav-link' id='login-link' href='pages/login.php'>Log in</a>";
                }
                ?>
            </li>
        </ul>
    </nav>
</header>
<main>
    <?php
    if (isset($_SESSION["tunnus"])) {
        print "<h1>Welcome ".$_SESSION["tunnus"]."!</h1>\n";
    } 
    ?>
    <h1>Where would you like to go? &#128652;</h1>
    <section id="route-box">
        <form class="header-and-input">
            <label for="from">From</label>
            <input type="text" id="from" class="form-control" placeholder="Starting location" data-np-intersection-state="observed">
        </form>
        <form class="header-and-input">
            <label for="date">Date</label>
            <input type="datetime-local" id="date" class="form-control" data-np-intersection-state="observed">
        </form>
        <form class="header-and-input">
            <label for="to">To</label>
            <input type="text" id="to" class="form-control" placeholder="Destination" data-np-intersection-state="observed">
        </form>
    </section>
    <section id="news-section">
        <form action="php/uploadnews.php" method="post" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Title" required><br>
            <textarea name="content" placeholder="Content" required></textarea><br>
            <input type="file" name="image"><br>
            <button type="submit">Submit</button>
        </form>
        <h2 id="news-heading">News</h2>
        <div class="article-box">
            <div class="img-container">
                <img src="images/redbus.jpg" class="img-thumbnail" alt="red bus in wilderness">
            </div>
            <article class="article-preview">
                <h3>Article One</h3>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur ab in porro et eveniet sit non explicabo eos 
                    sunt nulla sed quidem fugit ducimus molestias at itaque suscipit, saepe beatae! 
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe, officia, non mollitia vero ipsa deleniti quaerat 
                    sint dolorum rem expedita consectetur cupiditate ab possimus nisi a nulla, omnis voluptates inventore!
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam ad eaque fuga officiis nostrum ipsa vel ipsam harum 
                    aspernatur, hic totam dicta exercitationem maiores esse nihil, rem atque fugit commodi!
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur repudiandae facilis debitis ea ut. Dignissimos 
                    omnis quas eum harum, doloribus, iusto qui perferendis quos obcaecati unde laborum dolor expedita quaerat.
                </p>
                <button type="button" class="btn btn-secondary">Read More</button>
            </article>
        </div>
        <div class="article-box">
            <div class="img-container">
                <img src="images/bus.jpg" class="img-thumbnail" alt="school bus">
            </div>
            <article class="article-preview">
                <h3>Article Two</h3>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur ab in porro et eveniet sit non explicabo eos 
                    sunt nulla sed quidem fugit ducimus molestias at itaque suscipit, saepe beatae! 
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe, officia, non mollitia vero ipsa deleniti quaerat 
                    sint dolorum rem expedita consectetur cupiditate ab possimus nisi a nulla, omnis voluptates inventore!
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam ad eaque fuga officiis nostrum ipsa vel ipsam harum 
                    aspernatur, hic totam dicta exercitationem maiores esse nihil, rem atque fugit commodi!
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur repudiandae facilis debitis ea ut. Dignissimos 
                    omnis quas eum harum, doloribus, iusto qui perferendis quos obcaecati unde laborum dolor expedita quaerat.
                </p>
                <button type="button" class="btn btn-secondary">Read More</button>
            </article>
        </div>
        <div class="article-box">
            <div class="img-container">
                <img src="images/buswinter.jpg" class="img-thumbnail" alt="bus in winter">
            </div>
            <article class="article-preview">
                <h3>Article Three</h3>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur ab in porro et eveniet sit non explicabo eos 
                    sunt nulla sed quidem fugit ducimus molestias at itaque suscipit, saepe beatae! 
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Saepe, officia, non mollitia vero ipsa deleniti quaerat 
                    sint dolorum rem expedita consectetur cupiditate ab possimus nisi a nulla, omnis voluptates inventore!
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam ad eaque fuga officiis nostrum ipsa vel ipsam harum 
                    aspernatur, hic totam dicta exercitationem maiores esse nihil, rem atque fugit commodi!
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur repudiandae facilis debitis ea ut. Dignissimos 
                    omnis quas eum harum, doloribus, iusto qui perferendis quos obcaecati unde laborum dolor expedita quaerat.
                </p>
                <button type="button" class="btn btn-secondary">Read More</button>
            </article>
        </div>
        <?php
        include ("../php/shownews.php");
        ?>
    </section>
</main>
<?php
include ("parts/footer.html");
?>