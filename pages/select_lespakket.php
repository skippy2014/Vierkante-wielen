<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Lespakket kiezen</title>
</head>
<body>

<?php 
include '../include/db_conn.php' ;


$query = "SELECT * FROM lespakket";
$result = $connection->query($query);


echo '<form method="POST" action="../include/post_lespakket.php">';
echo '<select name="lespakket_id">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value="' . $row['id_lespakket'] . '">' . $row['naampakket'] . '</option>';
}
echo '</select>';
echo '<input type="submit" value="Kies lespakket">';
echo '</form>';
?>

</body>
</html>