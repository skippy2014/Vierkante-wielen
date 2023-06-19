<!DOCTYPE html>
<html>

<head>
<script>
    var activePopup = null;

    function showPopup(bericht, datum_tijd) {
        if (activePopup !== null) {
            var parentBox = document.querySelector(".parent-box");
            parentBox.removeChild(activePopup);
        }

        var popup = document.createElement("div");
        popup.className = "popup-melding";

        var popupContent = document.createElement("div");
        popupContent.className = "popup-melding-content";

        var berichtElement = document.createElement("p");
        berichtElement.textContent = bericht;

        var datumTijdElement = document.createElement("p");
        datumTijdElement.textContent = datum_tijd;

        var closeButton = document.createElement("button");
        closeButton.className = "popup-melding-close";
        closeButton.innerHTML = "Sluiten";
        closeButton.onclick = function () {
            var parentBox = document.querySelector(".parent-box");
            parentBox.removeChild(popup);
            activePopup = null;
        };

        popupContent.appendChild(berichtElement);
        popupContent.appendChild(datumTijdElement);
        popupContent.appendChild(closeButton);

        popup.appendChild(popupContent);

        var parentBox = document.querySelector(".parent-box");
        parentBox.appendChild(popup);

        activePopup = popup;
    }
</script>
</head>

<body>
    <?php
    $gebruikerId = $_SESSION["gebruiker"]["id_gebruiker"];

    $sql = "SELECT * FROM melding WHERE id_gebruiker = $gebruikerId";
    $result = $connection->query($sql);
    ?>

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
