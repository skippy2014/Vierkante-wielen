<?php
require '../include/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["role"]) && isset($_POST["userID"])) {
        $selectedRole = $_POST["role"];
        $userID = $_POST["userID"];

        $updateQuery = "UPDATE gebruiker SET rol = '$selectedRole' WHERE id_gebruiker = $userID";
        $connection->query($updateQuery);
    }
}

// Check if a search query is submitted
if (isset($_POST["search"])) {
    $searchQuery = $_POST["search"];
    $sql = "SELECT * FROM gebruiker WHERE voornaam LIKE '%$searchQuery%'";
} else {
    $sql = "SELECT * FROM gebruiker WHERE rol = 'leerling'";
}

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    echo "<form method='post'>";
    echo "<input type='text' name='search' placeholder='Voer Voornaam in' class='searchbar'/>";
    echo "<button type='submit'>Zoeken</button>";
    echo "</form>";

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
    echo "<form method='post'>";
    echo "<input type='text' name='search' placeholder='Voer Voornaam in' />";
    echo "<button type='submit'>Zoeken</button>";
    echo "</form>";

    echo "No results found.";
}

mysqli_close($connection);
?>