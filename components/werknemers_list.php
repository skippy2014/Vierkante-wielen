<?php
require_once "../include/db_conn.php";


$sql = "SELECT gebruiker.id_gebruiker, gebruiker.voornaam, gebruiker.achternaam, gebruiker.email, intructeur.id_intructeur, intructeur.admin, intructeur.telefoon
        FROM gebruiker
        JOIN intructeur ON gebruiker.id_gebruiker = intructeur.id_intructeur";

$result = $conn->query($sql);


if ($result) {
    
    if ($result->num_rows > 0) {
        
        echo "<table>";
        echo "<tr><th>ID intructeur</th><th>Voornaam</th><th>Achternaam</th><th>E-mail</th><th>Telefoon</th><th>Admin</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_intructeur"] . "</td>";
            echo "<td>" . $row["voornaam"] . "</td>";
            echo "<td>" . $row["achternaam"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["telefoon"] . "</td>";

            if ($row["admin"] == 1) {
        
            echo "<td>ja</td>";
            } else {
                echo "<td>nee</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>