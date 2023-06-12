<header class="navbar">
    <?php
    include_once($_SERVER["DOCUMENT_ROOT"] . "/Vierkante-wielen/" . "include/db_conn.php");
    if ($_SERVER['REQUEST_URI'] === "/Vierkante-wielen/" . "index.php") {
        // The user is on the homepage
        ?>
        <style>
            /* HEADER NAVIGATION */
            .links {
                list-style: none;
                margin: 0;
                padding: 0;
                display: flex;
                font-size: 20px;
            }

            /* Adjust the spacing between the links */
            .links li {
                margin-left: 40px;
            }

            .links li:first-child {
                margin-left: 0;
            }

            .links a {
                text-decoration: none;
                color: var(--inverted-font-color);
                transition: color 0.3s ease;
            }
        </style>
        <?php
    } else {
        ?>
        <style>
            /* HEADER NAVIGATION */
            .links {
                list-style: none;
                margin: 0;
                padding: 0;
                display: flex;
                font-size: 20px;
            }

            /* Adjust the spacing between the links */
            .links li {
                margin-left: 40px;
            }

            .links li:first-child {
                margin-left: 0;
            }

            .links a {
                text-decoration: none;
                color: var(--font-color);
                transition: color 0.3s ease;
            }
        </style>
        <?php
    }
    ?>

    <div class="logo">
        <a href="index.php"><img src="<?php
        // Check if the current URL location is the homepage
        if ($_SERVER['REQUEST_URI'] === "/Vierkante-wielen/" . "index.php") {
            // The user is on the homepage
            echo "/Vierkante-wielen/" . "img/logo_light.png";
        } else {
            // The user is not on the homepage
            echo "/Vierkante-wielen/" . "img/logo_dark.png";
        }
        ?>" alt="Logo"></a>
    </div>
    <nav>
        <ul class="links">
            <li><a href="/Vierkante-wielen/index.php">Home</a></li>
            <li><a href="/Vierkante-wielen/pages/account_settings.php">Overzicht</a></li>
            <?php if (isset($_SESSION['gebruiker']) && $_SESSION['gebruiker'] != true) {
                echo '<li><a href="#">Upgraden</a></li>';
            } else {
                echo '';
            } ?>
            <?php
            if (isset($_SESSION['gebruiker'])) {
                // User is logged in
                echo '<li><a href="/Vierkante-wielen/pages/loginpage.php?loguit">Logout</a></li>';
            } else {
                // User is not logged in
                echo '<li><a href="/Vierkante-wielen/pages/loginpage.php">Log in</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>