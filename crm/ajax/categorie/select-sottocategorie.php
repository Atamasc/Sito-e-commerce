<?php include('../../inc/db-conn.php'); ?>
<option value="">Seleziona una sottocategoria</option>
<option value=""></option>
<?php
$st_categorie_param = isset($_GET['categorie']) ? stripslashes($_GET['categorie']) : '';
$st_sottocategoria_param = isset($_GET['sottocategoria']) ? stripslashes($_GET['sottocategoria']) : '';

$querySql = "SELECT DISTINCT(st_sottocategoria) FROM st_sottocategorie WHERE st_ct_id = '$st_categorie_param' ORDER BY st_sottocategoria";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

while (($rows = $result->fetch_assoc()) !== NULL) {

    $st_sottocategoria = $rows['st_sottocategoria'];
    $status = ($st_sottocategoria_param == $st_sottocategoria) ? "selected" : "";

    echo "<option value='$st_sottocategoria' $status>$st_sottocategoria</option>";

}

$result->close();
?>
<?php include('../../inc/db-close.php'); ?>
