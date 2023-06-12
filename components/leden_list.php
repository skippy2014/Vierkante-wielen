<?php
require_once "../include/db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["role"]) && isset($_POST["userID"])) {
        $selectedRole = $_POST["role"];
        $userID = $_POST["userID"];

        $updateQuery = "UPDATE gebruiker SET rol = '$selectedRole' WHERE id_gebruiker = $userID";
        $conn->query($updateQuery);
    }
}

// Check if a search query is submitted
if (isset($_POST["search"])) {
    $searchQuery = $_POST["search"];
    $sql = "SELECT * FROM gebruiker WHERE voornaam LIKE '%$searchQuery%'";
} else {
    $sql = "SELECT * FROM gebruiker";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form method='post'>";
    echo "<input type='text' name='search' placeholder='Voer Voornaam in' />";
    echo "<button type='submit'>Zoeken</button>";
    echo "</form>";

    echo "<table>";
    echo "<tr><th>ID_Gebruiker</th><th>Voornaam</th><th>Achternaam</th><th>E-mail</th><th>Wachtwoord</th><th>Rol</th><th>Rol bewerken</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_gebruiker"] . "</td>";
        echo "<td>" . $row["voornaam"] . "</td>";
        echo "<td>" . $row["achternaam"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["wachtwoord"] . "</td>";
        echo "<td>" . $row["rol"] . "</td>";

        echo "<td>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='userID' value='" . $row["id_gebruiker"] . "' />";
        echo "<select name='role'>";
        echo "<option value='instructeur'>Instructeur</option>";
        echo "<option value='eigenaar'>Eigenaar</option>";
        echo "<option value='leerling'>Leerling</option>";
        echo "</select>";
        echo "<button type='submit'>Update</button>";
        echo "</form>";
        echo "</td>";

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

$conn->close();
?>
