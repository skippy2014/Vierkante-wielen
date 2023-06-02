<!-- Gebruik "include 'header-main.php';" -->
<header class="navbar">
    <div class="logo">
        <img src="img/logo_light.png" alt="Logo">
    </div>
    <nav>
        <ul class="links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Instructeurs</a></li>
            <li><a href="#">Lessen</a></li>
            <?php
            session_start(); // Start the session

            if (isset($_SESSION['gebruiker'])) {
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
