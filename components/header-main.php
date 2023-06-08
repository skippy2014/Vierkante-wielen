<?php ?>
<header class="navbar">
    <div class="logo">
        <a href="index.php"><img src="img/logo_light.png" alt="Logo"></a>
    </div>
    <nav>
        <ul class="links">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Overzicht</a></li>
            <?php if (isset($_SESSION['gebruiker']) && $_SESSION['gebruiker'] != true) {
                echo '<li><a href="#">Upgraden</a></li>';
            } else {
                echo '';
            } ?>
            <?php
            if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'leerling') {
                echo '<li><a href="#">Upgraden</a></li>';
            }
            ?>

            <?php

            if (isset($_SESSION['gebruiker'])) {
                // User is logged in
                echo '<li><a href="pages/loginpage.php?loguit">Logout</a></li>';
            } else {
                // User is not logged in
                echo '<li><a href="pages/loginpage.php">Log in</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>
<script src="js/header-main.js"></script>