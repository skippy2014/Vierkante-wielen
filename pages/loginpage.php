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
   <link rel="STYLESHEET" type="text/css"  href="/css/style.css">
</head>


<html>
<body>
<h1 class="TOPh1_login_page"><?php echo $message; ?></h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="login_input">
        <label for="login"></label>
        <input type="text" name="login" value="" placeholder="Email">
    </div>
    <div class="login_input">
        <label for="pwd"></label>
        <input type="password" name="pwd" value="" placeholder="Password">
    </div>
    <br>
    <div class="submit_login">
    <input type="submit" name="knop" value="Log in">
    </div>
</form>

<div class="Register_Account">
    <p>Nog geen account?
    <a href="register.php">hier</a> een aan</p>
    <br><br>
</div>

<p><a href="/index.php">Website</a></p>
<p><a href="loginpage.php?loguit">Uitloggen</a></p>
<p><a href="/pages/homepage_instructeurs.php">Instructeur</p>
<p><a href="/pages/homepage_admin.php">Eigennaar</a></p>
</body>
</html>
