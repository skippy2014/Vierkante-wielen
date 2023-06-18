<?php
// if ($resultOfAllUsers) {
//     $userRoles = array(); // create an array to store all user roles

//     if ($resultOfAllUsers->num_rows > 0) {
//         while ($gebruiker = $resultOfAllUsers->fetch_assoc()) {
//             if (array_key_exists("rol", $gebruiker)) {
//                 echo $gebruiker["rol"] . "<br>";
//                 $userRoles[] = $gebruiker["rol"]; // add role to array
//             }
//         }
//     } else {
//         // no rows returned
//     }
// } else {
//     // query failed to execute
//     echo "Error: " . $connection->error;
// }

if (isset($_SESSION["gebruiker"])) {
    echo '<ul style="list-style-type: none; font-size: 24px; font-family: Arial; color: #333;" class="informatie"><li><h3>Persoonlijke informatie</h3></li>';

    foreach ($_SESSION["gebruiker"] as $gebruiker => $rol) {
        echo "<li style='color: #777; display: flex; justify-content: space-between;'><span><strong>{$gebruiker}:</strong></span><span><p>{$rol}</p></span></li>";
    }

    echo "</ul>";
}

$sql = "SELECT aantallessen FROM gebruiker_has_lespakket WHERE id_gebruiker = $id_gebruiker";

// Execute the query
$result = $connection->query($sql);

// Check if the query executed successfully
if ($result) {
    // Fetch each row from the result set and print the aantallessen value
    while ($row = $result->fetch_assoc()) {
        echo "aantallessen: " . $row["aantallessen"] . "<br>";
    }
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

// Close the database connection
?>