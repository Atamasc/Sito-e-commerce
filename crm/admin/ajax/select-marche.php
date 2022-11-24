<?php
include('../../inc/db-conn.php');
header('Content-Type: text/html; charset=ISO-8859-1');
?>
<option value="">Seleziona una marca</option>
<option value=""></option>
<?php
$get_mr_id = isset($_GET['mr_id'])? $_GET['mr_id'] : '';
$get_md_tipo = isset($_GET['md_tipo'])? $_GET['md_tipo'] : '';

$querySql = "SELECT mr_id, mr_marca FROM mr_marca INNER JOIN md_modello ON md_mr_id = mr_id WHERE md_tipo = '$get_md_tipo' GROUP BY mr_marca ORDER BY mr_marca";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

while (($rows = $result->fetch_assoc()) !== NULL) {

    $mr_id = $rows['mr_id'];
    $mr_marca = $rows['mr_marca'];
    $status = ($get_mr_id == $mr_id) ? "selected" : "";

    echo "<option value='$mr_id' $status>$mr_marca</option>";

}
?>
<?php include('../../inc/db-close.php'); ?>
