<?php
require_once 'db_conn.php';

$voornaam = $_POST['voornaam'];
$achternaam = $_POST['achternaam'];
$telefoon = $_POST ['telefoon'];
$email = $_POST['email'];
$password = $_POST['password'];
$rol = $_POST['rol'];

$select = "SELECT * FROM gebruiker WHERE email = '$email'";

$result = mysqli_query($conn, $select);

if (mysqli_num_rows($result) > 0) {
    $error[] = 'Email already exists';
}

else {
    
    $sql = "INSERT INTO gebruiker (voornaam, achternaam, email, telefoon, wachtwoord, rol) VALUES ('$voornaam', '$achternaam', '$email', '$telefoon', '$password', '$rol')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

mysqli_close($conn);