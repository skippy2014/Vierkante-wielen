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
    echo '<ul style="list-style-type: none; font-size: 24px; font-family: Arial; color: #333;"><li><h3>Persoonlijke informatie</h3></li>';

    foreach ($_SESSION["gebruiker"] as $gebruiker => $rol) {
        echo "<li style='color: #777;'><strong>{$gebruiker}: </strong>{$rol}</li>";
    }

    echo "</ul>";
}