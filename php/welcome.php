<?php
  if (!isset(($_SESSION)["user"])) {
    header("Location:../index.html");
  }
  print "<h2>Welcome, ".$_SESSION["user"]."!<h2>";
?>
<header>
        <nav class="nav-bar">
            <ul class="nav-list">
                <li><a href="index.html">Home</a></li>
                <li><a href="pages/travelling.html">Travelling</a></li>
                <li><a href="pages/ticket.html">Tickets</a></li>
                <li><a href="pages/customerservice.html">Customer Service</a></li>
                <li id="login"><a class="active" href="pages/login.html">Log in</a></li>
            </ul>
        </nav>
</header>