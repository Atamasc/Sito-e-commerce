<?php
include('../../inc/db-conn.php');
header('Content-Type: text/html; charset=ISO-8859-1');
?>
<option value="">Seleziona una sottocategoria</option>
<option value=""></option>
<?php
$get_ct_id = isset($_GET['ct_id'])? $get_ct_id = $_GET['ct_id'] : $get_ct_id = '';
$get_st_id = isset($_GET['st_id'])? $get_st_id = $_GET['st_id'] : $get_st_id = '';

$querySql = "SELECT st_id, st_sottocategoria FROM st_sottocategorie WHERE st_ct_id = '$get_ct_id' ORDER BY st_sottocategoria";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

while (($rows = $result->fetch_assoc()) !== NULL) {

    $st_id = $rows['st_id'];
    $st_sottocategoria = $rows['st_sottocategoria'];
    $status = ($get_st_id == $st_id) ? "selected" : "";
    echo "<option value='$st_id' $status>$st_sottocategoria</option>";

}
?>
<?php include('../../inc/db-close.php'); ?>
