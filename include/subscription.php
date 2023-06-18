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

                // Check if the form has been submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
                    $sessionGebruikersID = $_SESSION["gebruiker"]["id_gebruiker"];

                    $nieuwAantalLessen = (int) $_POST['lessenAantal'];

                    $updateAantalLessen = $connection->query("UPDATE gebruiker_has_lespakket SET aantallessen = $nieuwAantalLessen WHERE id_gebruiker = $sessionGebruikersID");

                    // Set the extra variable to store the updated value of "lessenAantal"
                    if ($updateAantalLessen === TRUE) {
                        $lessenAantal = $nieuwAantalLessen;
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
                    <!-- Update the value of the input field only if the form has been submitted -->
                    <input type="number" name="lessenAantal" required value="<?php echo $lessenAantal; ?>">
                    <button name="submit">Submit</button>
                </form>


            </div>
        </div>
    </body>

</html>