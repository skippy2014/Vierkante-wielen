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
    if ($stmt === false) {
        die('Error: Unable to prepare statement. ' . $connection->error);
    }
    $stmt->bind_param("s", $login);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($password === $row['wachtwoord']) { // Check for plain text password match
            $_SESSION["gebruiker"] = array(
                "email" => $row["email"],
                "wachtwoord" => $row["wachtwoord"],
            );
            $message = "Welkom!";
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