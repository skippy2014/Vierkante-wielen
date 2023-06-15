<?php

// Check if the logged-in user has the role 'instructeur'
if ($_SESSION["gebruiker"]["rol"] == "instructeur") {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $leerling = $_POST["leerling-select"];
        $instructeur = $_POST["instructeur-select"];
        $lesauto = $_POST["auto-select"];
        $datum = $_POST["datum"];
        $tijd = $_POST["tijd"];
        $adres = $_POST["adres"];
        $lesdoel = $_POST["lesdoel"];

        if ($leerling != "" && $lesauto != "") {
            $insertQuery = "INSERT INTO les (id_lesauto, id_gebruiker, id_instructeur, datum_tijd, adres, lesdoel)
                            VALUES ('$lesauto', '$leerling', '$instructeur', '$datum $tijd', '$adres', '$lesdoel')";

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

                        $updateAantalLessenQuery = "UPDATE gebruiker_has_lespakket SET aantallessen = aantallessen - 1 WHERE id_gebruiker = '$leerling'";
                        $updateAantalLessenResult = mysqli_query($connection, $updateAantalLessenQuery);
                        if (!$updateAantalLessenResult) {
                            echo "Er is een fout opgetreden bij het bijwerken van het aantal lessen: " . mysqli_error($connection);
                        }
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

        <title>Vierkanten Wielen</title>
    </head>

    <body>
        <div class="form-container">
            <form method="POST" action="">
                <div class="flex">
                    <div>
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
                    </div>
                    <div>
                        <label for="datum">Selecteer Datum:</label>
                        <input type="date" id="datum" name="datum" placeholder="Datum" required>
                        <label for="tijd">Selecteer Tijd:</label>
                        <input type="time" id="tijd" name="tijd" placeholder="Tijd" required>
                        <input type="text" id="adres" name="adres" placeholder="Ophaal adres" required>
                        <input type="text" id="lesdoel" name="lesdoel" placeholder="Lesdoel" required>
                    </div>
                </div>
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