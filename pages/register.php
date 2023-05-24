<!DOCTYPE html>
<html>

    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>

        <div class="register_grid">
            <form method="post" action="post_register_lid.php" class="form_register">
                <h2>Register</h2>
                <input type="text" name="first name" placeholder="Voornaam" required class="input_field">
                <input type="text" name="last name" placeholder="Achternaam" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Wachtwoord" required>
                <button type="submit" class="btn" name="reg_user">Register</button>
                <p>Already a member? Log in
                    <a href="loginpage.php">here</a>
                </p>
            </form>
            <div>
                <p>text</p>
                <!-- LIJST MET TARIEVEN -->
            </div>
        </div>

    </body>

</html>