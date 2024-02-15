<?php 
// Avataan tämänhetkiset sessionit.
session_start();
// Tallennetaan id-session $id muuttujaan
$id = $_SESSION["id"];
?>
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
    <link rel="stylesheet" href="../css/ticketvalikko.css">
    <title>Ticket page - Buy your tickets</title>
</head>
<body>
<?php 
// Sisällytetään header
include("../parts/header.php");
?>
<main class="content-wrapper">
    <h1 class="title1">Tickets</h1>

    <section>
        <h2 class="title2">Buy your ticket</h2>
    </section>
    <section id="sticket">
            <h2 class="tickethead">Buy ticket</h2>
        <form action="../php/updateticket.php" method="POST">
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
        <button type="submit" class="btn btn-primary" style="background-color: auto;">Buy Ticket</button>
        </form>
    </section>
    <section class="lsection">
    <h2 onclick="toggleDropdown('yourTicketsDropdown')">Your tickets</h2>
    <select class="tickets-dropdown" id="yourTicketsDropdown">

    <?php
include ("../php/connect.php");

    // Haetaan käyttäjän ostamat liput tietokannasta
    $ticket_query = mysqli_query($yhteys, "SELECT * FROM tickets WHERE user_id = '$id' AND expired_tickets = 0");

    if (mysqli_num_rows($ticket_query) > 0) {
    echo '<option value="" disabled selected>Select a ticket</option>'; // Tyhjä valinta oletuksena
    // Käydään läpi jokainen voimassa oleva lippu
    while ($ticket_data = mysqli_fetch_assoc($ticket_query)) {
        echo '<option value="' . $ticket_data['ticket_id'] . '">';
        // Tulostetaan lipun tiedot
        echo 'Customer Group: ' . $ticket_data['customer_group'] . ', ';
        echo 'Zone: ' . $ticket_data['zone'] . ', ';
        echo 'Purchase Date: ' . $ticket_data['purchase_date'];
        echo '</option>';
    }
} else {
    echo '<option value="" disabled selected>No tickets found</option>'; // Ilmoitus, jos käyttäjällä ei ole lippuja
}
?>
 </select>
</section>

<section class="rsection">
    <h2 onclick="toggleDropdown('expiredTicketsDropdown')">Expired tickets</h2>
    <select class="tickets-dropdown" id="expiredTicketsDropdown">
    <?php
    // Haetaan käyttäjän vanhentuneet liput tietokannasta
    $expired_ticket_query = mysqli_query($yhteys, "SELECT * FROM tickets WHERE user_id = '$id' AND expired_tickets = 1");

    if (mysqli_num_rows($expired_ticket_query) > 0) {
    echo '<option value="" disabled selected>Select an expired ticket</option>'; // Tyhjä valinta oletuksena
    // Käydään läpi jokainen vanhentunut lippu
    while ($expired_ticket_data = mysqli_fetch_assoc($expired_ticket_query)) {
        echo '<option value="' . $expired_ticket_data['ticket_id'] . '">';
        // Tulostetaan lipun tiedot
        echo 'Customer Group: ' . $expired_ticket_data['customer_group'] . ', ';
        echo 'Zone: ' . $expired_ticket_data['zone'] . ', ';
        echo 'Purchase Date: ' . $expired_ticket_data['purchase_date'];
        echo '</option>';
    }
} else {
    echo '<option value="" disabled selected>No expired tickets found</option>'; // Ilmoitus, jos käyttäjällä ei ole vanhentuneita lippuja
}
?>
     </select>
    </section>
     <script src="../js/ticket.js"></script>
<?php
    // Tarkistetaan ja päivitetään vanhentuneet liput
    $ticket_query = mysqli_query($yhteys, "SELECT * FROM tickets WHERE user_id = '$id' AND expired_tickets = 0");
    // Käydään läpi jokainen voimassa oleva lippu tarkistaaksemme niiden vanhenemisen
    while ($ticket_data = mysqli_fetch_assoc($ticket_query)) {
        $ticket_id = $ticket_data['ticket_id'];
        $purchase_date = strtotime($ticket_data['purchase_date']);
        $expiration_date = strtotime('+20 seconds', $purchase_date); // Lisätään 20 sekuntia ostopäivämäärään
        // Jos nykyinen aika on suurempi kuin vanhentumisaika, merkitään lippu vanhentuneeksi
        if (time() > $expiration_date) {
            mysqli_query($yhteys, "UPDATE tickets SET expired_tickets = 1 WHERE ticket_id = '$ticket_id'");
        }
    }
?>
</section>
</div>
</main>

<?php
// Lisätään footer
include ("../parts/footer.html");
?>