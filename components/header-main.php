<!-- Gebruik "include 'header-main.php';" -->
<header class="navbar">
    <div class="logo">
        <img src="img/logo_light.png" alt="Logo">
    </div>
    <nav>
        <ul class="links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Overzicht</a></li>
            <?php if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true) {
                echo '<li><a href="#">Upgraden</a></li>';
            } else {
                echo '';
            } ?>
            <li><a href="#">Upgraden</a></li>
            <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                // User is logged in
                echo '<li><a href="pages/logout.php">Logout</a></li>';
            } else {
                // User is not logged in
                echo '<li><a href="pages/loginpage.php">Log in</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>
<script src="js/header-main.js"></script>