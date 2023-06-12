<?php

if (isset($_SESSION["gebruiker"])) {
    echo '<ul style="list-style-type: none; font-size: 24px; font-family: Arial; color: #333;"><li><h3>Persoonlijke informatie</h3></li>';

    foreach ($_SESSION["gebruiker"] as $gebruiker => $rol) {
        echo "<li style='color: #777;'><strong>{$gebruiker}: </strong>{$rol}</li>";
    }

    echo "</ul>";
}