<?php

$gebruikerId = $_SESSION["gebruiker"]["id_gebruiker"];

$sql = "SELECT * FROM melding WHERE id_gebruiker = $gebruikerId";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html>

    <head>
        <style>
            .parent-box {
                background-color: #ccc;
                width: 300px;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
                height: 300px;
            }

            .meldingen-container {
                max-height: 200px;
                overflow-y: auto;
            }

            .melding-box {
                background-color: #f1f1f1;
                width: 200px;
                margin: 0 auto;
                border-radius: 10px;
                padding: 10px;
                margin-bottom: 10px;
                text-align: left;
            }

            .meer-info-link {
                color: blue;
                text-decoration: underline;
                cursor: pointer;
            }

            .popup {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .popup-content {
                background-color: #fff;
                width: 300px;
                padding: 20px;
                border-radius: 10px;
                text-align: center;
            }

            .popup-close {
                margin-top: 10px;
            }
        </style>

    <body>
        <div class="parent-box">
            <h2>Meldingen</h2>
            <div class="meldingen-container">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="melding-box">';
                        echo "<p>" . $row["bericht"] . "</p>";
                        echo '<p class="meer-info-link" onclick="showPopup(\'' . $row["bericht"] . '\', \'' . $row["datum_tijd"] . '\')">Meer info</p>';
                        echo '</div>';
                    }
                } else {
                    echo "Geen meldingen gevonden.";
                }
                ?>
            </div>
        </div>
    </body>

</html>