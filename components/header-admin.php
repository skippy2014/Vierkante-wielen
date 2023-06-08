<?php
include_once('../include/db_conn.php');
?>

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

            if ($resultOfAllUsersOfAllUsers) {
                $userRoles = array(); // create an array to store all user roles
            
                if ($resultOfAllUsersOfAllUsers->num_rows > 0) {
                    while ($gebruiker = $resultOfAllUsersOfAllUsers->fetch_assoc()) {
                        if (array_key_exists("rol", $gebruiker)) {
                            echo $gebruiker["rol"] . "<br>";
                            $userRoles[] = $gebruiker["rol"]; // add role to array
                        }
                    }
                } else {
                    // no rows returned
                }
            } else {
                // query failed to execute
                echo "Error: " . $connection->error;
            }


            foreach ($_SESSION as $key => $value) {
                echo $key . " = ";
                if (is_array($value)) {
                    print_r($value);
                } else {
                    echo strval($value);
                }
                echo "<br>";
            }



            if (isset($_SESSION['gebruiker']) && isset($_SESSION['rol']) && $_SESSION['rol'] != 'Admin'): ?>
                <li><a href="#">Upgraden</a></li>
            <?php endif; ?>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Overzicht</a></li>

            <?php if (!isset($_SESSION['gebruiker'])): ?>
                <li><a href="/vierkante-wielen/pages/loginpage.php">Log in</a></li>
            <?php else: ?>
                <li><a href="/vierkante-wielen/pages/loginpage.php?loguit">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<script src="/vierkante-wielen/js/header-main.js"></script>