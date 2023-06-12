<?php
include '../include/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected lespakket_id from the form
    $lespakket_id = $_POST['lespakket_id'];

    $gebruikerId = $_SESSION['gebruiker']['id_gebruiker'];

    $selectQuery = "SELECT aantallessen FROM lespakket WHERE id_lespakket = '$lespakket_id'";
    $selectResult = $connection->query($selectQuery);

    if ($selectResult && $selectResult->num_rows > 0) {
        $row = $selectResult->fetch_assoc();
        $aantalLessen = $row['aantallessen'];
    } else {
        // Handle the case when the aantalLessen is not found
        $aantalLessen = 0; // Set a default value or handle the error as needed
    }

    // Insert the lespakket_id into another table in the database
    $insertQuery = "INSERT INTO gebruiker_has_lespakket (id_gebruiker, id_lespakket, aantallessen) VALUES ('$gebruikerId', '$lespakket_id', '$aantalLessen')";
    $insertResult = $connection->query($insertQuery);

    if ($insertResult) {
        header ('Location:../pages/account_settings.php');
    } else {
        echo "Error posting lespakket ID: " . $connection->error;
    }
}
$connection->close();
?>
