<?php
require_once "../include/db_conn.php";

$sql = "SELECT * FROM gebruiker";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID_Gebruiker</th><th>Voornaam</th><th>Achternaam</th><th>E-mail</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_gebruiker"] . "</td>";
            echo "<td>" . $row["voornaam"] . "</td>";
            echo "<td>" . $row["achternaam"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No results found.";
    }
    $conn->close();
    ?> 