<?php
    session_start();
    
    // Verbinding maken met de database (vervang de databasegegevens indien nodig)
    $host = 'localhost';
    $username = 'jouw_gebruikersnaam';
    $password = 'jouw_wachtwoord';
    $database = 'vierkantewielendemo';
    $conn = mysqli_connect($host, $username, $password, $database);

    // Controleren op fouten bij het maken van de verbinding
    if (mysqli_connect_errno()) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Controleren of het formulier is ingediend
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verzamel de waarden van de formuliervelden
        $leerling = $_POST["leerling-select"];
        $instructeur = $_POST["instructeur-select"];
        $lesauto = $_POST["auto-select"];
        $datum = $_POST["datum"];
        $tijd = $_POST["tijd"];
        $adres = $_POST["adres"];
        $lesdoel = $_POST["lesdoel"];
        $opmerking = $_POST["opmerking"];

        // Query om de gegevens in de database in te voegen
        $insertQuery = "INSERT INTO les (id_lesauto, id_gebruiker, id_instructeur, datum_tijd, adres, lesdoel, opmerking)
                        VALUES ('$lesauto', '$leerling', '$instructeur', '$datum $tijd', '$adres', '$lesdoel', '$opmerking')";

        // Uitvoeren van de query
        if (mysqli_query($conn, $insertQuery)) {
            echo "Gegevens zijn succesvol opgeslagen.";
        } else {
            echo "Er is een fout opgetreden bij het opslaan van de gegevens: " . mysqli_error($conn);
        }
    }

    // Query om leerlingen op te halen
    $leerlingQuery = "SELECT id_gebruiker, CONCAT(voornaam, ' ', achternaam) AS naam FROM gebruiker WHERE rol = 'leerling'";
    $leerlingResult = mysqli_query($conn, $leerlingQuery);

    // Query om instructeurs op te halen
    $instructeurQuery = "SELECT id_gebruiker, CONCAT(voornaam, ' ', achternaam) AS naam FROM gebruiker WHERE rol = 'instructeur'";
    $instructeurResult = mysqli_query($conn, $instructeurQuery);

    // Query om lesauto's op te halen
    $lesautoQuery = "SELECT id_lesauto, CONCAT(type, ' (', kenteken, ')') AS auto FROM lesauto";
    $lesautoResult = mysqli_query($conn, $lesautoQuery);
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
        <label for="leerling-select">Selecteer Leerling:</label>
        <select id="leerling-select" name="leerling-select" required>
            <?php
                while ($row = mysqli_fetch_assoc($leerlingResult)) {
                    echo '<option value="' . $row['id_gebruiker'] . '">' . $row['naam'] . '</option>';
                }
            ?>
        </select><br><br>

        <label for="instructeur-select">Selecteer Instructeur:</label>
        <select id="instructeur-select" name="instructeur-select" required>
            <?php
                while ($row = mysqli_fetch_assoc($instructeurResult)) {
                    echo '<option value="' . $row['id_gebruiker'] . '">' . $row['naam'] . '</option>';
                }
            ?>
        </select><br><br>

        <label for="auto-select">Selecteer Lesauto:</label>
        <select id="auto-select" name="auto-select" required>
            <?php
                while ($row = mysqli_fetch_assoc($lesautoResult)) {
                    echo '<option value="' . $row['id_lesauto'] . '">' . $row['auto'] . '</option>';
                }
            ?>
        </select><br><br>

        <label for="datum">Datum</label>
        <input type="date" id="datum" name="datum" required><br><br>

        <label for="tijd">Tijd</label>
        <input type="time" id="tijd" name="tijd" required><br><br>

        <label for="adres">Ophaal adres</label>
        <input type="text" id="adres" name="adres" required><br><br>

        <label for="tijd">Les doel</label>
        <input type="text" id="lesdoel" name="lesdoel" required><br><br>

        <label for="opmerking">Extra opmerkingen</label>
        <input type="text" id="opmerking" name="opmerking"><br><br>

        <input type="submit" value="Verstuur">
    </form>
</body>
</html>

<?php
    // Databaseverbinding sluiten
    mysqli_close($conn);
?>
