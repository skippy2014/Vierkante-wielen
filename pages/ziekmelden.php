<?php
require_once "../include/db_conn.php";

if (isset($_SESSION['gebruiker'])) {
  // User is logged in
  $id_gebruiker = $_SESSION['gebruiker']['id_gebruiker'];
  echo '<script>console.log("' . $id_gebruiker . '");</script>';

  // Fetch the dates associated with the user from the les table
  $dateQuery = "SELECT DISTINCT datum_tijd FROM les WHERE id_gebruiker = '$id_gebruiker' AND ziek = ''";
  $result = mysqli_query($connection, $dateQuery);
  if (!$result) {
    die("Query failed: " . mysqli_error($connection));
  }

  
  $dates = array();
  while ($row = mysqli_fetch_assoc($result)) {
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

    
    header('location: account_settings.php');
    exit();
  }
} else {
  header('location: loginpage.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Vierkanten Wielen</title>
</head>

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
      <?php foreach ($dates as $date) : ?>
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

</html>