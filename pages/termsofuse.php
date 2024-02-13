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
    <meta name="description" content="Trip buddies Terms of use page">
    <meta name="author" content="Lauri Santala">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/ticket.css">
    <title>Terms of Use - Here are terms of use</title>
    <style>

        main {
            text-align: center;
            max-width: 800px;
            width: 100%;
            margin: 50px auto 100px auto;
            }

        section, .div2 {
            text-align: left;
            margin: 2% auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

        .pli {
            list-style: none;
            padding: 0;
            text-align: left;
            }

        .pli li {
            margin-bottom: 10px;
            }


    </style>


</head>
<body>
<?php
include ("../parts/header.php");
?>
    <main>
        <h1>Terms of use</h1>
        <section>
            <div>
            <h2>Here is our Terms of use</h2>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tempora quisquam aut vitae dolore corrupti minima tenetur nihil error et est minus qui accusamus obcaecati sapiente laborum, harum, ipsa quibusdam sit.</p>
            </div>
            <div>
            <h2>Responsibilities</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda ducimus minus tenetur omnis, aliquid, vero numquam libero nobis voluptatibus est corporis sit consectetur atque asperiores consequuntur repudiandae aspernatur tempore facere.</p>
            </div>
        </section>
        <div class="div2">
        <h2>Disclaimers</h2>
        <ul class="pli">
            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum deleniti minus iusto eaque ea aliquam sed pariatur odit beatae impedit minima sunt incidunt dolor cum ab voluptates, qui unde atque.</li>
            <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut dolor dicta quaerat maiores accusantium numquam qui, voluptatem temporibus, eos expedita velit officia unde? Suscipit voluptatem fugiat, aperiam blanditiis inventore nemo.</li>
            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora minus autem, illo perferendis doloribus cum asperiores alias placeat nulla. Suscipit iure, et consequatur similique nihil iste sit velit cumque. Reprehenderit?</li>
            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda quas dolore quae explicabo ipsa illo numquam eius distinctio sint, eum repudiandae pariatur possimus harum dolorem accusantium libero laborum alias aspernatur.</li>
            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, delectus possimus esse ut error, voluptatibus, nostrum quas at illum veritatis illo ullam ipsum praesentium ab recusandae tempora velit alias odio.</li>
        </ul>
        </div>
    </main>
    <?php
include ("../parts/footer.html");
?>

</body>
</html>