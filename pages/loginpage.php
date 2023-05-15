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

if (isset($_POST['knop'])
    && isset($gebruikers[$_POST["login"]])
    && $gebruikers[$_POST["login"]]["pwd"] == $_POST['pwd']) {
    $_SESSION["gebruiker"] = array(
        "naam" => $_POST["login"],
        "pwd" => $gebruikers[$_POST["login"]]['pwd'],
        "rol" => $gebruikers[$_POST["login"]]['rol']
    );
    $message = "Welkom met de rol ".$_SESSION["gebruiker"]["rol"];
} elseif (isset($_POST['knop'])) {
    $message = "Foutieve login gegevens";
} else {
    $message = "Login";
}
?>

<html>
<body>
<h1><?php echo $message; ?></h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
        <label for="login">Email: </label>
        <input type="text" name="login" value="">
    </div>
    <div class="form-group">
        <label for="pwd">Password: </label>
        <input type="password" name="pwd" value="">
    </div>
    <br>
    <input type="submit" name="knop">
</form>
<p><a href="website.php">Website</a></p>
<p><a href="index.php?loguit">Uitloggen</a></p>
<p><a href="admin.php">Admin</a></p>
<p>Nog geen lid? Log in 
    <a href="register.php">here</a></p>
</body>
</html>
