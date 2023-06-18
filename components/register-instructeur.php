<form method="post" action="../include/post_register-instructeur.php">
  <input type="text" name="voornaam" placeholder="Voornaam" required><br>
  <input type="text" name="achternaam" placeholder="Achternaam" required><br>
  <input type="email" name="email" placeholder="Email" required><br>
  <input type="tel" id="phoneInput" name="telefoon" placeholder="Telefoonnummer" maxlength="11" required><br>
  <input type="password" name="password" placeholder="Wachtwoord" required><br>

  <select name="rol" required>
    <option value="">Selecteer rol</option>
    <option value="instructeur">Instructeur</option>
    <option value="eigenaar">Eigenaar</option>
  </select><br>

  <button class="btn">Register</button>
</form>

<script>
  const phoneInput = document.getElementById('phoneInput');

  phoneInput.addEventListener('input', function () {
    formatPhoneNumber();
  });

  function formatPhoneNumber() {
    let phoneNumber = phoneInput.value.replace(/\D/g, ''); // Remove non-digit characters

    // Apply the Dutch phone number format
    if (phoneNumber.length > 2 && phoneNumber.length <= 5) {
      phoneNumber = phoneNumber.replace(/(\d{2})(\d+)/, '$1-$2');
    } else if (phoneNumber.length > 5 && phoneNumber.length <= 10) {
      phoneNumber = phoneNumber.replace(/(\d{2})(\d{3})(\d+)/, '$1-$2$3');
    } else if (phoneNumber.length > 10) {
      phoneNumber = phoneNumber.replace(/(\d{2})(\d{3})(\d{2})(\d+)/, '$1-$2$3-$4');
    }

    phoneInput.value = phoneNumber;
  }


</script>