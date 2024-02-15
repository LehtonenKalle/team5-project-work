<?php 
// Avataan tämänhetkinen session.
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Trip Buddies Customer service page">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/customerservice.css">
    <title>Trip Buddies - Customer Service</title>

</head>
<body>
<?php
include ("../parts/header.php");
?>
<main>
    <div class="container">
        <div style="text-align:center">
        <h1>Contact Us</h1>
        </div>
    <div class="column">
        <form action="../php/feedback.php" method="POST">
            <label for="firstname">First Name:</label>
            <input type="text" id="firstname" name="firstname" placeholder="Your first name">
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" placeholder="Your last name">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Your Email">
            <label for="comment">Ask or tell us what's wrong</label>
            <textarea id="comment" name="comment" placeholder="Write here" style="height: 200px"></textarea>
            <input type="submit" value="Submit">
        </form>
        <h2>Contact Address</h2>
        <address>
        example@gmail.com<br>
        Hämeenlinna<br>
        Suomi<br>
        </address>
    </div>
    </div>

    

</main>
<?php
include ("../parts/footer.html");
?>