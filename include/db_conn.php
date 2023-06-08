<?php
session_start();

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'vierkantewielendemo';

$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET["loguit"])) {
    $_SESSION = array();
    session_destroy();
}

if (isset($_POST['login_button'])) {
    $login = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $connection->prepare("SELECT * FROM gebruiker WHERE email = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($password === $row['wachtwoord']) {
            $_SESSION["gebruiker"] = array(
                "voornaam" => $row["voornaam"],
                "achternaam" => $row["achternaam"],
                "telefoonnummer" => $row["telefoon"],
                "id_gebruiker" => $row["id_gebruiker"],
                "email" => $row["email"],
                "wachtwoord" => $row["wachtwoord"],
                "rol" => $row["rol"]
            );

            echo "<script>console.log('id_gebruiker: " . $row["id_gebruiker"] . "');</script>";

            $message = "Welkom!";

            //echo '<script>window.location.href = "/index.php";</script>';
        } else {
            $message = "Foutieve login gegevens";
        }
    } else {
        $message = "Foutieve login gegevens";
    }
} else {
    $message = "Login";
}
?>