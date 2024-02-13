<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="description" content="Trip Buddies Tickets. Buy your tickets online for a seamless travel experience. Choose from various customer groups and zones. Check your purchased tickets and track expired ones.">
    <meta name="author" content="Lauri Santala">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/ticket.css">
    <title>Ticket page - Buy your tickets</title>
    
</head>
<body>
    <header>
        <nav class="nav-bar">
            <ul class="nav-list">
                <li><a class="nav-link" href="../index.php">Home</a></li>
                <li><a class="nav-link" href="travelling.html">Travelling</a></li>
                <li><a class="nav-link" href="ticket.html">Tickets</a></li>
                <li><a class="nav-link" href="customerservice.html">Customer Service</a></li>
                <li id="login"><a class="nav-link" id="login-link" href="login.php">Log in</a></li>
            </ul>
        </nav>
    </header>
    <main class="content-wrapper">
        <h1 class="title1">Tickets</h1>

        <section>
            <h2 class="title2">Buy your ticket</h2>
        </section>
        <section id="sticket">
                <h2 class="tickethead">Buy ticket</h2>
            <form action="../php/ticket.php" method="POST">
            <div class="input-group">
                <label class="l1" for="o1">Customer Group</label>
                <select id="o1" name="customer_group" class="form-select">
                    <option selected="">Customer group</option>
                    <option value="1">Adult</option>
                    <option value="2">Student</option>
                    <option value="3">Elderly</option>
                    <option value="4">People with reduced mobility</option>
                    <option value="5">Visually impaired people</option>
                </select>
            </div>
            <div class="input-group">
                <label class="l2" for="o2">Zone</label>
                <select id="o2" name="zone" class="form-select">
                    <option selected="">Zone</option>
                    <option value="1">A-A</option>
                    <option value="2">A-B</option>
                    <option value="3">A-C</option>
                    <option value="4">A-D</option>
                    <option value="5">A-E</option>
                </select>
            </div>
            <button type="submit" class="btn">Buy Ticket</button>
            </form>
        </section>
        <div class="yt">
    <section class="lsection">
    <h2>Your tickets</h2>
    <?php
    include ("../php/connect.php");
    // Haetaan käyttäjän ostamat liput tietokannasta
    $ticket_query = mysqli_query($yhteys, "SELECT * FROM tickets WHERE user_id = '$user_id' AND expired_tickets = 0");
    if (mysqli_num_rows($ticket_query) > 0) {
        while ($ticket_data = mysqli_fetch_assoc($ticket_query)) {
            echo '<p>Ticket ID: ' . $ticket_data['ticket_id'] . '</p>';
            echo '<p>Customer Group: ' . $ticket_data['customer_group'] . '</p>';
            echo '<p>Zone: ' . $ticket_data['zone'] . '</p>';
            echo '<p>Purchase Date: ' . $ticket_data['purchase_date'] . '</p>';
            echo '<hr>';
        }
    } else {
        echo '<p class="para">You have not bought any tickets</p>';
    }
    ?>
</section>
<section class="rsection">
    <h2>Expired tickets</h2>
    <?php
    // Haetaan käyttäjän vanhentuneet liput tietokannasta
    $expired_ticket_query = mysqli_query($yhteys, "SELECT * FROM tickets WHERE user_id = '$user_id' AND expired_tickets = 1");
    if (mysqli_num_rows($expired_ticket_query) > 0) {
        while ($expired_ticket_data = mysqli_fetch_assoc($expired_ticket_query)) {
            echo '<p>Ticket ID: ' . $expired_ticket_data['ticket_id'] . '</p>';
            echo '<p>Customer Group: ' . $expired_ticket_data['customer_group'] . '</p>';
            echo '<p>Zone: ' . $expired_ticket_data['zone'] . '</p>';
            echo '<p>Purchase Date: ' . $expired_ticket_data['purchase_date'] . '</p>';
            echo '<hr>';
        }
    } else {
        echo '<p class="para">You have 0 expired tickets</p>';
    }
    ?>
</section>
</div>
    </main>

    <footer>
        <p>&#169; Copyright Trip Buddies</p>
        <p><a href="../pages/termsofuse.html">Terms of Use</a></p>
        <p><a href="../pages/privacy.html">Privacy</a></p>
    </footer>

</body>
</html>