<?php
print "<h1> HELLO WORLD</h1>";
  if (!isset($_SESSION["user"])) {
    
  }
  print "<h2>Welcome, ".$_SESSION["user"]."!<h2>";