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


    <h2>Afmelden</h2>
    <form method="POST" action="">
        <label for="naam">Naam *:</label>
        <input type="text" id="naam" name="naam" required><br><br>

        <label for="Welke_Dag"> E-mail *:</label>
        <input type="email" id="Welke_Dag" name="Welke_Dag" required><br><br>

        <label for="reden_afwezig">Reden voor afmelding *:</label>
        <select name="Reden voor afmelding" id="ziek">
  <option value="ziek">Ziek</option>
  <option value="anders">Anders</option>
</select><br><br>

        <label for="Welke_Dag">Welke dag? *:</label>
        <input type="date" id="Welke_Dag" name="Welke_Dag" required><br><br>

        <input type="submit" value="Verstuur">
    



    </form>



    </body>
    </html>