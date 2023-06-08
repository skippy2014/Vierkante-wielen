<h3>Persoonlijke informatie</h3>
<?php

$query = "SELECT * FROM gebruiker";
$resultOfAllUsersOfAllUsers = $connection->query($query);

if ($resultOfAllUsersOfAllUsers) {
    $userRoles = array(); // create an array to store all user roles

    if ($resultOfAllUsersOfAllUsers->num_rows > 0) {
        while ($gebruiker = $resultOfAllUsersOfAllUsers->fetch_assoc()) {
            if (array_key_exists("rol", $gebruiker)) {
                echo $gebruiker["rol"] . "<br>";
                $userRoles[] = $gebruiker["rol"]; // add role to array
            }
        }
    } else {
        // no rows returned
    }
} else {
    // query failed to execute
    echo "Error: " . $connection->error;
}

// check the role of the user
if (isset($_SESSION["gebruiker"])) {
    foreach ($_SESSION["gebruiker"] as $gebruiker => $rol) {
        if ($gebruiker === "rol") {
            echo "Rol: " . $rol . "";
        }
    }
}