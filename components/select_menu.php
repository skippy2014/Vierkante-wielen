<?php 

include 'include/db_conn.php' ;


$query = "SELECT id_lespakket, naampakket FROM lespakket";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo '<select name="lespakket">';
foreach ($data as $row) {
    echo '<option value="' . $row['id_lespakket'] . '">' . $row['naampakket'] . '</option>';
}
echo '</select>';

$result->free_result();
$conn->close();
?>