<?php
include('../../inc/db-conn.php');
header('Content-Type: text/html; charset=ISO-8859-1');
?>
<option value="">Seleziona un modello</option>
<option value=""></option>
<?php
$get_mr_id = isset($_GET['mr_id'])? $_GET['mr_id'] : '';
$get_md_tipo = isset($_GET['md_tipo'])? $_GET['md_tipo'] : '';
$get_md_id = isset($_GET['md_id'])? $_GET['md_id'] : '';

$querySql =
    "SELECT md_id, md_modello, md_inizio_produzione, md_fine_produzione FROM md_modello ".
    "WHERE md_mr_id = '$get_mr_id' AND md_tipo = '$get_md_tipo' ORDER BY md_modello, md_inizio_produzione ASC";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

while (($rows = $result->fetch_assoc()) !== NULL) {

    $md_id = $rows['md_id'];
    $md_modello = $rows['md_modello'];
    $md_anno = $rows['md_inizio_produzione']." - ".$rows['md_fine_produzione'];
    $status = ($get_md_id == $md_id) ? "selected" : "";

    echo "<option value='$md_id' $status>$md_modello ($md_anno)</option>";

}
?>
<?php include('../../inc/db-close.php'); ?>
