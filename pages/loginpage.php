<?php
session_start();

$gebruikers = array(
    "Pjotrdevos@gmail.com" => array("pwd" => "admin", "rol" => "Admin"),
    "Peter@gmail.com" => array("pwd" => "Peter1234", "rol" => "Admin"),
    "John@gmail.com" => array("pwd" => "John1234", "rol" => "Gebruiker"),
);

if (isset($_GET["loguit"])) {
    $_SESSION = array();
    session_destroy();
}

if (
    isset($_POST['knop'])
    && isset($gebruikers[$_POST["login"]])
    && $gebruikers[$_POST["login"]]["pwd"] == $_POST['pwd']
) {
    $_SESSION["gebruiker"] = array(
        "naam" => $_POST["login"],
        "pwd" => $gebruikers[$_POST["login"]]['pwd'],
        "rol" => $gebruikers[$_POST["login"]]['rol']
    );
    $message = "Welkom met de rol " . $_SESSION["gebruiker"]["rol"];
} elseif (isset($_POST['knop'])) {
    $message = "Foutieve login gegevens";
} else {
    $message = "Log in";
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Vierkante wielen</title>
        <link rel="STYLESHEET" type="text/css" href="../css/style.css">
    </head>


    <html>

        <body>
            <div class="general_layout">

                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form_login">
                    <h2 class="TOPh1_login_page">
                        <?php echo $message; ?>
                    </h2>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" class="btn" name="login_button">Log in</button>

                    <p>Nog geen account?
                        <a href="register.php">hier</a> een aan
                    </p>
                    <br><br>

                    <p><a href="/index.php">Website</a></p>
                    <p><a href="loginpage.php?loguit">Uitloggen</a></p>
                    <p><a href="/pages/homepage_instructeurs.php">Instructeur</p>
                    <p><a href="/pages/homepage_admin.php">Eigennaar</a></p>
                </form>
            </div>

        </body>

    </html>