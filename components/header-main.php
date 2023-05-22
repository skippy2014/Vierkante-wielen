<!-- Gebruik "include 'header-main.php';" -->

<!DOCTYPE html>
<html>
<head>
    <script src="../js/header-main.js"></script>
    <title>Header</title>
</head>
<body>
    <header class="transparent-header">
        <div class="logo">
            <img src="../img/logo.png" alt="Logo">
        </div>
        <nav>
            <ul class="links">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../pages/loginpage.php">Login</a></li>
                <li><a href="../pages/register.php">Register</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>
<style>
/* Reset default styles */
body {
    margin: 0;
    padding: 0;
}

/* Header styles */
header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 200px;
    position: sticky;
    top: 0;
    background-color: transparent;
    transition: background-color 0.3s ease;
    z-index: 1000;
}

/* Background color change */
body.scrolled header {
    background-color: black;
}

/* Logo styles */
.logo img {
    width: 100px; /* Verander de grootte van de logo op de header */
}

/* Navigation styles */
.links {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    font-family: Segoe UI, Regular;
    font-size: 20px;
}

.links li {
    margin-left: 20px; /* Bewerk de ruimte tussen de links */
}

.links li:first-child {
    margin-left: 0;
}

.links a {
    text-decoration: none;
    color: black;
    transition: color 0.3s ease;
}

/* Link color change */
body.scrolled header .links a {
    color: white;
}

</style>
