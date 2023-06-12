<?php
include_once "../components/header.php";

if (isset($_SESSION['gebruiker'])) {
    // User is logged in
    header('location: /Vierkante-wielen/pages/account_settings.php#Upgrade');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize user inputs if needed.
    $voornaam = $_POST['first_name'];
    $achternaam = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email is already in the database.
    $checkEmailQuery = "SELECT * FROM gebruiker WHERE email = ?";
    $statement = $connection->prepare($checkEmailQuery);
    $statement->bind_param('s', $email);
    $statement->execute();
    $checkEmailResult = $statement->get_result();

    if ($checkEmailResult->num_rows > 0) {
        echo "Email word al gebruikt.";
    } else {
        // Insert the new user account into the database.
        $sql = "INSERT INTO gebruiker (voornaam, achternaam, email, wachtwoord) VALUES (?, ?, ?, ?)";
        $statement = $connection->prepare($sql);
        $statement->bind_param('ssss', $voornaam, $achternaam, $email, $password);

        if ($statement->execute() === true) {
            echo "Account aangemaakt!";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }

    // Close the database connection.
    $connection->close();
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div class="general_layout">
            <form method="post" class="form_register">
                <h2>Register</h2>
                <input type="text" name="first_name" placeholder="Voornaam" required>
                <input type="text" name="last_name" placeholder="Acthernaam" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Wachtwoord" required>
                <select name="pakket" class="pakket">
                    <option value="Default" disabled selected>Kies een instappakket</option>
                    <option value="Pakket1">Instap pakket 1</option>
                    <option value="Pakket2">Instap pakket 2</option>
                    <option value="Pakket3">Instap pakket 3</option>
                </select>
                <button type="submit" class="btn" name="reg_user">Register</button>
                <p>Sta je al ingeschreven? Log
                    <a href="loginpage.php">hier</a> in
                </p>
            </form>
            <div class="tarieven_grid">
                <!-- LIJST MET TARIEVEN -->
                <div class="tarieven_card">
                    <div class="left_side_tarieven_card">
                        <h3>lespakket 1</h3>
                        <p>€2004,-</p>
                    </div>
                    <div class="right_side_tarieven_card">
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </div>
                </div>
                <div class="right_side_tarieven_card">
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                </div>
            </div>
            <div class="tarieven_card">
                <div class="left_side_tarieven_card">
                    <h3>lespakket 2</h3>
                    <p>€2424,-</p>
                </div>
                <div class="right_side_tarieven_card">
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                </div>
            </div>
            <div class="tarieven_card">
                <div class="left_side_tarieven_card">
                    <h3>lespakket 3</h3>
                    <p>€2872,-</p>
                </div>
                <div class="right_side_tarieven_card">
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                </div>
            </div>
        </div>
        </div>
    </body>

</html>