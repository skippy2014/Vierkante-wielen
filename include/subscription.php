<?php
session_start();
    include_once "db_conn.php";
    $lespakket_id = $_POST['lespakket_id'];

    $aantallessenArray = $connection->query("SELECT `aantallessen` FROM gebruiker_has_lespakket")->fetch(); 
    print_r($aantallessenArray);
    $aantallessenString = $aantallessenArray[0];
    echo $aantallessenString;
    $aantallessen = intval($aantallessenString);
    // Echo en print waren voor de test, jullie mogen ze weghalen als jullie dat willen.
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <form action="subscription.php" class="lessen-form" method="POST">
    <input style="width: 4vw !important;" type="number" value="0" name="lessenAantal" required>
    <input type="submit" value="Save" name="submit">
  </form>
  <div class="tarieven_grid">
                <div class="tarieven_card">
                    <div class="left_side_tarieven_card">
                        <h3>lespakket 1</h3>
                        <p>€2004,-</p>
                    </div>
                    <div class="right_side_tarieven_card">
                        <ul>
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                        </ul>
                    </div>
                </div>
                <div class="tarieven_card">
                    <div class="left_side_tarieven_card">
                        <h3>lespakket 2</h3>
                        <p>€2424,-</p>
                    </div>
                    <div class="right_side_tarieven_card">
                        <ul>
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                        </ul>
                    </div>
                </div>
                <div class="tarieven_card">
                    <div class="left_side_tarieven_card">
                        <h3>lespakket 3</h3>
                        <p>€2872,-</p>
                    </div>
                    <div class="right_side_tarieven_card">
                        <ul>
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                        </ul>
                    </div>
                </div>
            </div>
</body>
</html>
<?php
// Hierzo moet nog iets worden gedaan
// Foreach loop moet array maken met gebruikers ID's om de lessen van de gebruiker aan te passen.
$i = 0;
$gebruikers = $connection->query("SELECT `gebruiker_idgebruiker` FROM gebruiker_has_lespakket")->fetch();

  foreach($gebruikers as $gebruiker){
    $gebruikerIdArray[$i] = $gebruiker;
    echo gettype($gebruiker);
    $i++;
  }
 

    // $updateAantalLessen = $connection->query("UPDATE gebruiker_has_lespakket SET aantallessen
    // = aantallessen $_POST['lessenAantal'] WHERE id_gebruiker = '$gebruikerId'")->fetch();   

    ?>