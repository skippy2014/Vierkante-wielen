<h2>Register instructeur</h2>
<form method="post" action="../include/post_register-instructeur.php">
  <input type="text" name="voornaam" placeholder="Voornaam" required><br>
  <input type="text" name="achternaam" placeholder="Achternaam" required><br>  
  <input type="email" name="email" placeholder="Email" required><br> 
  <label for="telefoon">(06-12345678)</label><br>
  <input type="tel" id="phone" name="telefoon" placeholder="06-12345678" pattern="[06]{2}-[0-9]{8}" required><br>
  <input type="password" name="password" placeholder="Wachtwoord" required><br>

  <select name="rol" required>
    <option value="">Selecteer rol</option>
    <option value="instructeur">Instructeur</option>
    <option value="eigenaar">Eigenaar</option>
  </select><br>

 <button type="submit" class="btn">Register</button>
</form>