<?php
    session_start();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Vierkanten Wielen</title>
    </head>
    <body>
    <?php include '../components/header.php'; ?>


    <h2>Nieuwe les inplannen</h2>
    <form method="POST" action="">
        <label for="naam">Naam *:</label>
        <input type="text" id="naam" name="naam" required><br><br>

        <label for="email">Email *:</label>
        <input type="text" id="email" name="email" required><br><br>

        <label for="Telefoon">Telefoon *:</label>
        <input type="text" id="Telefoon" name="Telefoon" required><br><br>

        <label for="Contact_Opnemen">Telefonisch contact gewenst? :</label>
        <input type="radio" id="Ja" name="Contact_Opnemen" value="Ja">
        <label for="Ja">Ja</label>
        
        <input type="radio" id="Nee" name="Contact_Opnemen" value="Nee">
        <label for="Nee">Nee</label><br><br>

        <label for="Welke_Dag">Welke dag? *:</label>
        <input type="date" id="Welke_Dag" name="Welke_Dag" required><br><br>
        
        
        <input type="submit" value="Verstuur">
    



    </form>

    </body>
    </html>