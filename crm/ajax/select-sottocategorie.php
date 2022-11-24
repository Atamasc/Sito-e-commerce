<?php
header('Content-type: text/plain; charset=ISO-8859-1');
include('../inc/db-conn.php');
?>
    <option value="">Seleziona una sottocategoria</option>
    <option value=""></option>
<?php
$get_ct_id = isset($_GET['ct_id']) ? (int)$_GET['ct_id'] : 0;

$querySql = "SELECT st_id, st_sottocategoria FROM st_sottocategorie WHERE st_ct_id = '$get_ct_id' ORDER BY st_sottocategoria";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

echo $querySql;

while (($row_data = $result->fetch_assoc()) !== NULL) echo "<option value='".$row_data['st_id']."'>".$row_data['st_sottocategoria']."</option>";

$result->close();
?>
<?php include('../inc/db-close.php'); ?>