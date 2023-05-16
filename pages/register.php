<!DOCTYPE html>
<html>

    <head>

        <title>Registration</title>

        <title>Registratie leerlingen</title>

    </head>

    <body>
        <h2>Register</h2>
        <form method="post" action="register.php">
            <input type="text" name="first name" placeholder="Voornaam" required>
            <br>
            <input type="text" name="last name" placeholder="Achternaam" required>
            <br>
            <input type="email" name="email" placeholder="Email" required>
            <br>
            <input type="password" name="password" placeholder="Wachtwoord" required>
            <br>
            <button type="submit" class="btn" name="reg_user">Register</button>

            <p>Already a member? Log in 
                <a href="loginpage.php">here</a></p>

            <p>Ben je al lid? Log in <a href="loginpage.php">hier</a>.</p>

        </form>
    </body>

</html>