<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/Vierkante-wielen/" . "components/header.php");

if (isset($_SESSION['gebruiker'])) {
    // User is logged in
    header('location: /Vierkante-wielen/pages/account_settings.php');
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
                "id_gebruiker" => $row["id_gebruiker"],
                "voornaam" => $row["voornaam"],
                "email" => $row["email"],
                "wachtwoord" => $row["wachtwoord"],
                "achternaam" => $row["achternaam"],
                "telefoonnummer" => $row["telefoon"],
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

<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<html>

    <body>
        <div class="general_layout">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form_login">
                <h2 class="TOPh1_login_page">
                    <?php echo $message; ?>
                </h2>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <br>
                <button type="submit" class="btn" name="login_button">Log in</button>

                <p>Nog geen account? Maak er <a href="register.php">hier</a> een aan</p>
                <br><br>

                <p><a href="../index.php">Website</a></p>
                <p><a href="loginpage.php?loguit">Uitloggen</a></p>

                <?php
                if (isset($_SESSION['gebruiker']) && ($_SESSION['gebruiker']['rol'] === 'instructeur' || $_SESSION['gebruiker']['rol'] === 'eigenaar')) {
                    echo '<p><a href="homepage_instructeurs.php">Instructeur</a></p>';
                }
                ?>
                <?php
                if (isset($_SESSION['gebruiker']) && $_SESSION['gebruiker']['rol'] === 'eigenaar') {
                    echo '<p><a href="homepage_admin.php">Eigenaar</a></p>';
                }
                ?>


            </form>

        </div>
    </body>

</html>