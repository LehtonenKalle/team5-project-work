<header>
  <nav class="nav-bar">
      <ul class="nav-list">
          <li><a class="nav-link" href="../index.php">Home</a></li>
          <li><a class="nav-link" href="travelling.php">Travelling</a></li>
          <li><a class="nav-link" href="ticket.php">Tickets</a></li>
          <li><a class="nav-link" href="customerservice.php">Customer Service</a></li>
          <li id="login">
              <?php 
              if (isset($_SESSION["tunnus"])) {
                  print "<button class='dropdown-btn' href='loginpage.php'>".$_SESSION["tunnus"]."</button>".
                  "<div class='dropdown-content'>
                      <a href='#'>Profile</a>
                      <a href='../php/logout.php'>Log out</a>
                  </div>";
              } else {
                  print "<a class='nav-link' id='login-link' href='loginpage.php'>Log in</a>";
              }
              ?>
          </li>
      </ul>
  </nav>
</header>