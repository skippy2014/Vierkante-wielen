<!DOCTYPE html>
<html>

    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>


    <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vierkantewielen";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $voornaam = $_POST['first_name'];
    $achternaam = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password using Argon2
    $hashedPassword = password_hash($password, PASSWORD_ARGON2I);

    
    $sql = "INSERT INTO gebruiker (voornaam, achternaam, email, wachtwoord) VALUES ('$voornaam', '$achternaam', '$email', '$hashedPassword')";

    if ($conn->query($sql) === true) {
        echo "Account aangemaakt!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


    <body>
        <h2>Register</h2>
        <form method="post" class="form">
            <input type="text" name="first_name" placeholder="Voornaam" required class="input_field">
            <br>
            <input type="text" name="last_name" placeholder="Achternaam" required>
            <br>
            <input type="email" name="email" placeholder="Email" required>
            <br>
            <input type="password" name="password" placeholder="Wachtwoord" required>
            <br>
            <button type="submit" class="btn" name="reg_user">Register</button>
            <p>Already a member? Log in <a href="loginpage.php">here</a>
            </p>
        </form>
    </body>

</html>