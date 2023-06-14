<?php

$id_gebruiker = $_SESSION['gebruiker']['id_gebruiker'];

// Create a new mysqli connection
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check if the connection to the database is still open
if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

// Fetch the dates associated with the user from the les table
$dateQuery = "SELECT DISTINCT datum_tijd FROM les WHERE id_gebruiker = '$id_gebruiker' AND ziek = ''";
$resultDates = mysqli_query($connection, $dateQuery);
if (!$resultDates) {
  die("Query failed: " . mysqli_error($connection));
}

$dates = array();
while ($row = mysqli_fetch_assoc($resultDates)) {
  $dates[] = $row['datum_tijd'];
}

if (isset($_POST['submit'])) {
  $reden_afmelding = $_POST['reden_afmelding'];
  $selected_date = $_POST['selected_date'];

  if ($reden_afmelding === "anders") {
    $anders_reden = $_POST['anders_reden'];

    $updateOpmerkingQuery = "UPDATE les SET opmerking = '$anders_reden' WHERE id_gebruiker = '$id_gebruiker' AND datum_tijd = '$selected_date'";
    $updateOpmerkingResult = mysqli_query($connection, $updateOpmerkingQuery);
    if (!$updateOpmerkingResult) {
      die("Query failed: " . mysqli_error($connection));
    }
  }

  $updateQuery = "UPDATE les SET ziek = 1 WHERE id_gebruiker = '$id_gebruiker' AND datum_tijd = '$selected_date'";
  $updateResult = mysqli_query($connection, $updateQuery);
  if (!$updateResult) {
    die("Query failed: " . mysqli_error($connection));
  }

  $updateAantalLessenQuery = "UPDATE gebruiker_has_lespakket SET aantallessen = aantallessen + 1 WHERE id_gebruiker = '$id_gebruiker'";
  $updateAantalLessenResult = mysqli_query($connection, $updateAantalLessenQuery);
  if (!$updateAantalLessenResult) {
    die("Query failed: " . mysqli_error($connection));
  }

  // Close the mysqli connection
  $connection->close();

  header('location: account_settings.php');
  exit();
}

// Free the result set
mysqli_free_result($resultDates);

// Close the mysqli connection
$connection->close();
?>

<!-- HTML code for the form -->










<body>

  <h2>Afmelden</h2>
  <form method="POST" action="">
    <label for="reden_afmelding">Reden voor afmelding *:</label>
    <select name="reden_afmelding" id="reden_afmelding" onchange="toggleReasonField()">
      <option value="ziek">Ziek</option>
      <option value="anders">Anders</option>
    </select><br>

    <div id="anders_reason" style="display: none;">
      <label for="anders_reden">Specificeer de reden:</label>
      <input type="text" id="anders_reden" name="anders_reden"><br><br>
    </div>

    <label for="selected_date">Selecteer een datum:</label>
    <select name="selected_date" id="selected_date">
      <?php foreach ($dates as $date): ?>
        <option value="<?php echo $date; ?>"><?php echo $date; ?></option>
      <?php endforeach; ?>
    </select><br><br>

    <button type="submit" name="submit">Verstuur</button>
  </form>

  <script>
    function toggleReasonField() {
      var selectElement = document.getElementById("reden_afmelding");
      var reasonField = document.getElementById("anders_reason");
      if (selectElement.value === "anders") {
        reasonField.style.display = "block";
      } else {
        reasonField.style.display = "none";
      }
    }
  </script>
</body>