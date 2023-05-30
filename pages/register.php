<!DOCTYPE html>
<html>

    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>

        <div class="general_layout">
            <form method="post" action="post_register_lid.php" class="form_register">
                <h2>Register</h2>
                <input type="text" name="first name" placeholder="Voornaam" required>
                <input type="text" name="last name" placeholder="Acthernaam" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Wachtwoord" required>
                <select name="pakket" class="pakket">
                    <option value="Default" disabled selected>Kies een instappakket</option>
                    <option value="Pakket1">Instap pakket 1</option>
                    <option value="Pakket2">Instap pakket 2</option>
                    <option value="Pakket3">Instap pakket 3</option>
                </select>
                <button type="submit" class="btn" name="reg_user">Register</button>
                <p>Sta je al ingeschreven? Log
                    <a href="loginpage.php">hier</a> in
                </p>
            </form>
            <div class="tarieven_grid">
                <!-- LIJST MET TARIEVEN -->
                <div class="tarieven_card">
                    <div class="left_side_tarieven_card">
                        <h3>lespakket 1</h3>
                        <p>€2004,-</p>
                    </div>
                    <div class="right_side_tarieven_card">
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </div>
                </div>
                <div class="tarieven_card">
                    <div class="left_side_tarieven_card">
                        <h3>lespakket 2</h3>
                        <p>€2424,-</p>
                    </div>
                    <div class="right_side_tarieven_card">
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </div>
                </div>
                <div class="tarieven_card">
                    <div class="left_side_tarieven_card">
                        <h3>lespakket 3</h3>
                        <p>€2872,-</p>
                    </div>
                    <div class="right_side_tarieven_card">
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                    </div>
                </div>
            </div>
        </div>

    </body>

</html>