<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Trip Buddies Login page">
    <meta name="author" content="Miika Konttila">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login-register.css">
    <script src="../js/login.js"></script>
    <title>Trip Buddies - Login here</title>
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
                            <a href='#'>Profile</a>
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
    <form class="form">
        <h1>Login Here</h1>
        <p id="result"></p>
        <div class="col-sm-8 col-sm-offset-3 login">
            <label for="tunnus" class="form-label">Username:</label>
            <input type="text" class="form-control" id="tunnus" placeholder="Enter Username" name="tunnus">
        </div>
        <div class="col-sm-8 col-sm-offset-3 login">
            <label for="pwd" class="form-label">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        </div>
        <div class="col-sm-8 col-sm-offset-3 login">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="remember"> Remember me
        </label>
        </div>
             <button type="submit" class="btn" onclick="sendUser(this.form);">Submit</button>
             <p>Dont have an account? <a class="here" href="register.html">Register</a></p>
    </form>
    <footer>
        <p>&#169; Copyright Trip Buddies</p>
        <p><a href="../pages/termsofuse.html">Terms of Use</a></p>
        <p><a href="../pages/privacy.html">Privacy</a></p>
    </footer>
    
</body>
</html>