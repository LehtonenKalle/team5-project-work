<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Trip Buddies Register page">
    <meta name="author" content="Miika Konttila">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login-register.css">
    <title>Trip Buddies - Register here</title>
</head>
<body>
<header>
    <nav class="nav-bar">
        <ul class="nav-list">
            <li><a class="nav-link" href="../index.php">Home</a></li>
            <li><a class="nav-link" href="travelling.html">Travelling</a></li>
            <li><a class="nav-link" href="ticket.html">Tickets</a></li>
            <li><a class="nav-link" href="customerservice.html">Customer Service</a></li>
            <li id="login">
                <?php 
                if (isset($_SESSION["tunnus"])) {
                    print "<button class='dropdown-btn' href='login.php'>".$_SESSION["tunnus"]."</button>". 
                    "<div class='dropdown-content'>
                        <a href='php/login.php'>Profile</a>
                        <a href='php/logout.php'>Log out</a>
                    </div>";
                } else {
                    print "<a class='nav-link' id='login-link' href='login.php'>Log in</a>";
                }
                ?>
            </li>
        </ul>
    </nav>
</header>
<form class="form" action="" method="POST">
  <div class="col-sm-8 col-sm-offset-3 login">
    <h1>Register Here</h1>
    <p id="result"></p>
    <label for="email">Email:</label>
    <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" required>

    <label for="tunnus">Username:</label>
    <input type="text" class="form-control" placeholder="Enter Username" name="tunnus" id="tunnus" required>

    <label for="salasana">Password:</label>
    <input type="password" class="form-control" placeholder="Enter Password" name="salasana" id="salasana" required>

    <label for="salasana-uudelleen">Repeat Password:</label>
    <input type="password" class="form-control" placeholder="Repeat Password" name="salasana-uudelleen" id="salasana-uudelleen" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
  </div>
  <button type="submit" class="btn">Register</button>
  <div class="container signin">
    <p>Already have an account? <a class="here" href="login.php">Sign in</a>.</p>
  </div>
</form>
<footer>
    <p>&#169; Copyright Trip Buddies</p>
    <p><a href="../pages/termsofuse.html">Terms of Use</a></p>
    <p><a href="../pages/privacy.html">Privacy</a></p>
</footer>
    
</body>
</html>