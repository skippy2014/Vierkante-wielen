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

        <label for = "tijd">Tijd *:</label>
        <input type = "time" id ='tijd' name = 'tijd' required> <br><br> 
        
        
        <input type="submit" value="Verstuur">
    </form>
    <?php
$naam = $_POST['naam'];
$email = $_POST['email'];
$telefoon = $_POST['telefoon'];
$dag = $_POST['dag'];
$tijd = $_POST['tijd'];

$sql = "INSERT INTO afspraken (naam, email, telefoon, dag, tijd) VALUES ('$naam', '$email', '$telefoon', '$dag', '$tijd')";

if (mysqli_query($conn, $sql)) {
  echo "Afspraak is gemaakt!";
} else {
  echo "Er is een fout opgetreden: " . mysqli_error($conn);
}


?>

    </body>
    </html>