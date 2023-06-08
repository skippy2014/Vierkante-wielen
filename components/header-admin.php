<style>
    .links a {
        text-decoration: none;
        color: var(--font-color) !important;
        transition: color 0.3s ease;
    }
</style>

<header class="navbar">
    <div class="logo">
        <a href="index.php"><img src="../img/logo_dark.png" alt="Logo"></a>
    </div>
    <nav>
        <ul class="links">
            <?php

            $query = "SELECT * FROM gebruiker";
            $resultOfAllUsersOfAllUsers = $connection->query($query);
            ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Overzicht</a></li>
            <?php if (isset($_SESSION["gebruiker"])) {
                foreach ($_SESSION["gebruiker"] as $gebruiker => $rol) {
                    if ($gebruiker === "rol") {
                        echo '<li><a href="/vierkante-wielen/pages/upgradepage.php">Upgraden</a></li>';
                    }
                }
            } ?>
            <?php if (!isset($_SESSION['gebruiker'])): ?>
                <li><a href="/vierkante-wielen/pages/loginpage.php">Log in</a></li>
            <?php else: ?>
                <li><a href="/vierkante-wielen/pages/loginpage.php?loguit">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<script src="/vierkante-wielen/js/header-main.js"></script>