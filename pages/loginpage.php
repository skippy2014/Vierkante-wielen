<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<html>
    <?php include_once('../components/header-admin.php') ?>

    <body>
        <div class="general_layout">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form_login">
                <h2 class="TOPh1_login_page">
                    <?php echo $message; ?>
                </h2>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <br>
                <button type="submit" class="btn" name="login_button">Log in</button>

                <p>Nog geen account? Maak er
                    <a href="register.php">hier</a> een aan
                </p>
                <br><br>

                <p><a href="../index.php">Website</a></p>
                <p><a href="loginpage.php?loguit">Uitloggen</a></p>
                <p><a href="homepage_instructeurs.php">Instructeur</p>
                <p><a href="homepage_admin.php">Eigennaar</a></p>
            </form>

        </div>
    </body>

</html>