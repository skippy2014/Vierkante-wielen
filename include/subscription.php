<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div class="layout lespakket">
            <div class="tarieven_grid">
                <!-- LIJST MET TARIEVEN -->
                <div class="tarieven_card">
                    <div class="left_side_tarieven_card">
                        <h3>Basispakket</h3>
                        <p>€645,-</p>
                    </div>
                    <div class="right_side_tarieven_card">
                        <ul>
                            <li>Start Nu, Betaal Achteraf!</li>
                            <li>100% vrijblijvende proefrijles</li>
                            <li>15 rijlessen incl. gratis herexamen</li>
                        </ul>
                    </div>
                </div>
                <div class="tarieven_card">
                    <div class="left_side_tarieven_card">
                        <h3>Spoedcursus</h3>
                        <p>€845,-</p>
                    </div>
                    <div class="right_side_tarieven_card">
                        <ul>
                            <li>Gratis Herexamen t.w.v. €285</li>
                            <li>100% vrijblijvende proefrijles</li>
                            <li>Spoedcursus in 8 dagen je rijbewijs!</li>
                        </ul>
                    </div>
                </div>
                <div class="tarieven_card">
                    <div class="left_side_tarieven_card">
                        <h3>Uitgebreid pakket</h3>
                        <p>€1075,-</p>
                    </div>
                    <div class="right_side_tarieven_card">
                        <ul>
                            <li>Start Nu, Betaal Achteraf!</li>
                            <li>100% vrijblijvende proefrijles</li>
                            <li>25 rijlessen incl. gratis herexamen</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div>
                <?php
                include '../include/db_conn.php';
                $id_gebruiker = $_SESSION['gebruiker']['id_gebruiker'];

                $lespakket = "SELECT id_lespakket FROM gebruiker_has_lespakket WHERE id_gebruiker = '$id_gebruiker'";
                $lespakketResult = mysqli_query($connection, $lespakket);
                $lessenAantal = "";


                if (!isset(mysqli_fetch_assoc($lespakketResult)['id_lespakket'])) {
                    $query = "SELECT * FROM lespakket";
                    $result = $connection->query($query);


                    echo '<form method="POST" action="../include/post_lespakket.php">';
                    echo '<select name="lespakket_id">';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['id_lespakket'] . '">' . $row['naampakket'] . '</option>';
                    }
                    echo '</select>';
                    echo '<button>Kies lespakket</button>';
                    echo '</form>';
                } else {
                    // Check if the form has been submitted
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                        $sessionGebruikersID = $_SESSION["gebruiker"]["id_gebruiker"];

                        $nieuwAantalLessen = (int) $_POST['lessenAantal'];

                        $updateAantalLessen = $connection->query("UPDATE gebruiker_has_lespakket SET aantallessen = aantallessen + $nieuwAantalLessen WHERE id_gebruiker = $sessionGebruikersID");

                        // Set the extra variable to store the updated value of "lessenAantal"
                        if ($updateAantalLessen === TRUE) {
                            $aantalLessenResult = $connection->query("SELECT aantallessen FROM gebruiker_has_lespakket WHERE id_gebruiker = $sessionGebruikersID");
                            $aantalLessenRow = $aantalLessenResult->fetch_assoc();
                            $lessenAantal = $aantalLessenRow['aantallessen'];
                        } else {
                            echo "Error updating aantallessen: " . $connection->error;
                        }
                    }

                    // If the form has not been submitted, or if there was an error updating the value, show the current value of "lessenAantal"
                    if (!isset($lessenAantal)) {
                        $sessionGebruikersID = $_SESSION["gebruiker"]["id_gebruiker"];

                        $aantalLessenResult = $connection->query("SELECT aantallessen FROM gebruiker_has_lespakket WHERE id_gebruiker = $sessionGebruikersID");
                        $aantalLessenRow = $aantalLessenResult->fetch_assoc();
                        $lessenAantal = $aantalLessenRow['aantallessen'];
                    }
                    ?>
                    <form method="POST">
                        <label for="lessenAantal">Update je aantal lessen hier en druk op submit</label><br>
                        <input type="number" name="lessenAantal" required onchange="updateValue(this)">
                        <button name="submit">Submit</button>
                    </form>

                    <?php
                    $sessionGebruikersID = $_SESSION["gebruiker"]["id_gebruiker"];

                    // Get the lespakket value from the database for the current user
                    $lespakketResult = $connection->query("SELECT lespakket.naampakket FROM lespakket INNER JOIN gebruiker_has_lespakket ON lespakket.id_lespakket = gebruiker_has_lespakket.id_lespakket WHERE gebruiker_has_lespakket.id_gebruiker = $sessionGebruikersID");

                    if ($lespakketResult !== false && $lespakketResult->num_rows > 0) {
                        $lespakketRow = mysqli_fetch_assoc($lespakketResult);
                        $lespakket = $lespakketRow['naampakket'];
                    } else {
                        $lespakket = "Kan het lespakket niet vinden";
                    }

                    // Get the aantal lessen value from the database for the current user
                    $aantalLessenResult = $connection->query("SELECT aantalLessen FROM gebruiker_has_lespakket WHERE id_gebruiker = $sessionGebruikersID");

                    if ($aantalLessenResult !== false && $aantalLessenResult->num_rows > 0) {
                        $aantalLessenRow = mysqli_fetch_assoc($aantalLessenResult);
                        $lessenAantal = $aantalLessenRow['aantalLessen'];
                    } else {
                        $lessenAantal = "Kan het aantal lessen niet vinden";
                    }

                    // Echo the retrieved lespakket and aantal lessen values
                    echo "<br><p>" . "Lespakket: " . $lespakket . "</p><br>";
                    echo "<p>" . "Mijn aantal lessen: " . $lessenAantal . "</p>";
                    ?>


                    <script>
                        function updateValue(element) {
                            document.getElementById('inputValue').innerHTML = element.value;
                            document.getElementById('finalValue').innerHTML = parseInt(document.getElementById('aantalLessen').innerHTML) + parseInt(element.value);
                        }
                    </script>

                <?php } ?>

            </div>
        </div>
    </body>

</html>