<h2>Register instructeur</h2>
        <form method="post" action="include/post_register-instructeur.php">
            <input type="text" name="first name" placeholder="Voornaam" required>
            <br>
            <input type="text" name="last name" placeholder="Achternaam" required>
            <br>  
            <input type="tel" id="phone" name="phone" placeholder="06-12345678" pattern="[06]{2}-[0-9]{8}" required>
            <br>
            <input type="email" name="email" placeholder="Email" required>
            <br>
          
            <input type="password" name="password" placeholder="Wachtwoord" required>
            <br>
            <button type="submit" class="btn">Register</button>
        </form>