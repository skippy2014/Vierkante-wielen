<!DOCTYPE html>
<html>

    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <h2>Register</h2>
        <form method="post" action="post_register_lid.php" class="form">
            <input type="text" name="first name" placeholder="Voornaam" required class="input_field">
            <br>
            <input type="text" name="last name" placeholder="Achternaam" required>
            <br>
            <input type="email" name="email" placeholder="Email" required>
            <br>
            <input type="password" name="password" placeholder="Wachtwoord" required>
            <br>
            <label for="pakket">Kies een pakket</label>
           <select name="pakket" id="pakket">
    	    <option value="Pakket1">Instap pakket 1</option>
            <option value="Pakket2">Instap pakket 2</option>
            <option value="Pakket3">Instap pakket 3</option>
        </select>
            <br>
            <button type="submit" class="btn" name="reg_user">Register</button>
            <p>Already a member? Log in
                <a href="loginpage.php">here</a>
            </p>
        </form>
    </body>

</html>