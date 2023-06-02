<?php
session_start();


$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'vierkantewielen';

$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_GET["loguit"])) {
    $_SESSION = array();
    session_destroy();
}

if (isset($_POST['knop'])) {
    $login = $_POST["login"];
    $password = $_POST["pwd"];

    $stmt = $connection->prepare("SELECT * FROM gebruiker WHERE email = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['wachtwoord'])) {
            $_SESSION["gebruiker"] = array(
                "naam" => $row["email"],
                "pwd" => $row['wachtwoord'],
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
<p><a href="index.php">Website</a></p>
<p><a href="loginpage.php?loguit">Uitloggen</a></p>
<p><a href="admin.php">Admin</a></p>
<p>Nog geen lid? Log in 
    <a href="register.php">here</a></p> <br><br>

    <a href="../pages/homepage_admin.php"> Login als admin</a> <br> <br>
    <a href="../pages/homepage_instructeurs.php"> Login als instructeurs</a> <br> <br>
    <a href="../pages/homepage_leden.php"> Login als lid</a> <br> <br>
</body>
</html>
