<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vierkantewielendemo";

$connection = mysqli_connect($servername, $username, $password, $dbname);

if (!$connection) {
    die("Fout bij verbinden met de database: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $leerling = $_POST["leerling-select"];
    $instructeur = $_POST["instructeur-select"];
    $lesauto = $_POST["auto-select"];
    $datum = $_POST["datum"];
    $tijd = $_POST["tijd"];
    $adres = $_POST["adres"];
    $lesdoel = $_POST["lesdoel"];
    $opmerking = $_POST["opmerking"];

    if ($leerling != "" && $lesauto != "") {
        $insertQuery = "INSERT INTO les (id_lesauto, id_gebruiker, id_instructeur, datum_tijd, adres, lesdoel, opmerking)
                        VALUES ('$lesauto', '$leerling', '$instructeur', '$datum $tijd', '$adres', '$lesdoel', '$opmerking')";

        if (mysqli_query($connection, $insertQuery)) {
            $insertedId = mysqli_insert_id($connection);

            $meldingQuery = "INSERT INTO melding (id_les, id_gebruiker, bericht, datum_tijd)
                             VALUES ('$insertedId', '$leerling', 'Een nieuwe les is ingepland.', NOW())";

            if (mysqli_query($connection, $meldingQuery)) {
                $instructeurQuery = "SELECT CONCAT(voornaam, ' ', achternaam) AS instructeur_naam FROM gebruiker WHERE id_gebruiker = '$instructeur'";
                $instructeurResult = mysqli_query($connection, $instructeurQuery);

                if ($instructeurResult) {
                    $instructeurRow = mysqli_fetch_assoc($instructeurResult);
                    $instructeurNaam = $instructeurRow['instructeur_naam'];
                    echo "Les succesvol aangemaakt voor de leerling: " . $instructeurNaam;
                } else {
                    echo "Er is een fout opgetreden bij het ophalen van de instructeurgegevens: " . mysqli_error($connection);
                }
            } else {
                echo "Er is een fout opgetreden bij het opslaan van de gegevens en verzenden van de melding: " . mysqli_error($connection);
            }
        } else {
            echo "Er is een fout opgetreden bij het opslaan van de gegevens: " . mysqli_error($connection);
        }
    } else {
        echo "Selecteer a.u.b. een leerling en een auto.";
    }
}

$leerlingQuery = "SELECT id_gebruiker, CONCAT(voornaam, ' ', achternaam) AS naam FROM gebruiker WHERE rol = 'leerling'";
$leerlingResult = mysqli_query($connection, $leerlingQuery);

$instructeurQuery = "SELECT id_gebruiker, CONCAT(voornaam, ' ', achternaam) AS naam FROM gebruiker WHERE rol = 'instructeur'";
$instructeurResult = mysqli_query($connection, $instructeurQuery);

$lesautoQuery = "SELECT id_lesauto, CONCAT(type, ' (', kenteken, ')') AS auto FROM lesauto";
$lesautoResult = mysqli_query($connection, $lesautoQuery);

$ingelogdeInstructeurId = $_SESSION["gebruiker"]["id_gebruiker"];
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <style>
            .form-container {
                display: flex;
                flex-direction: column;
                max-width: 400px;
                margin: 0 auto;
                padding: 20px;
            }

            .form-row {
                display: flex;
                flex-direction: column;
                margin-bottom: 10px;
            }

            .form-row label {
                margin-bottom: 5px;
            }

            .form-row input,
            .form-row select {
                padding: 5px;
            }

            .form-row input[type="submit"] {
                padding: 10px 20px;
            }

            #form-heading {
                text-align: center;
            }
        </style>
        <title>Vierkanten Wielen</title>
    </head>

    <body>
        <div class="form-container">
            <form method="POST" action="">
                <div class="form-row">
                    <label for="leerling-select">Selecteer Leerling:</label>
                    <select id="leerling-select" name="leerling-select" required>
                        <option value="" disabled selected>-- Selecteer leerling --</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($leerlingResult)) {
                            echo '<option value="' . $row['id_gebruiker'] . '">' . $row['naam'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-row">
                    <label for="instructeur-select">Selecteer Instructeur:</label>
                    <select id="instructeur-select" name="instructeur-select" required>
                        <?php
                        while ($row = mysqli_fetch_assoc($instructeurResult)) {
                            $selected = $row['id_gebruiker'] == $ingelogdeInstructeurId ? 'selected' : '';
                            echo '<option value="' . $row['id_gebruiker'] . '" ' . $selected . '>' . $row['naam'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-row">
                    <label for="auto-select">Selecteer Lesauto:</label>
                    <select id="auto-select" name="auto-select" required>
                        <option value="" disabled selected>-- Selecteer auto --</option>
                        <?php
                        while ($row = mysqli_fetch_assoc($lesautoResult)) {
                            echo '<option value="' . $row['id_lesauto'] . '">' . $row['auto'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <input type="date" id="datum" name="datum" placeholder="Datum" required>
                <input type="time" id="tijd" name="tijd" placeholder="Tijd" required>
                <input type="text" id="adres" name="adres" placeholder="Ophaal adres" required>
                <input type="text" id="lesdoel" name="lesdoel" placeholder="Lesdoel" required>
                <input type="text" id="opmerking" name="opmerking" placeholder="Extra opmerking">
                <button type="submit" value="Verstuur" id="submit-btn">Verstuur</button>
            </form>
        </div>

        <script>
            const leerlingSelect = document.getElementById('leerling-select');
            const autoSelect = document.getElementById('auto-select');
            const submitBtn = document.getElementById('submit-btn');

            leerlingSelect.addEventListener('change', validateForm);
            autoSelect.addEventListener('change', validateForm);

            function validateForm() {
                const leerlingValue = leerlingSelect.value;
                const autoValue = autoSelect.value;

                if (leerlingValue !== '' && autoValue !== '') {
                    submitBtn.disabled = false;
                } else {
                    submitBtn.disabled = true;
                }
            }
        </script>
    </body>

</html>

<?php
mysqli_close($connection);
?>