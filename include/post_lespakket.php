<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ontvang de geselecteerde waarde
    $lespakketId = $_POST['lespakket_id'];

    // Update de lespakket_id in de gebruikerstabel
    $userId = $_SESSION['user_id']; // Veronderstel dat de gebruikers-ID is opgeslagen in de sessie
    $updateQuery = "UPDATE gebruikers SET lespakket_id = $lespakketId WHERE id = $userId";
    mysqli_query($connection, $updateQuery);

    // Voer andere gewenste acties uit na het bijwerken van de database
    // ...

    echo "Lespakket succesvol gekoppeld!";
}

$conn->close();