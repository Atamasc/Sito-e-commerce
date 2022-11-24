<?php include('../../inc/db-conn.php'); ?>
<option value="">Seleziona una provincia</option>
<option value=""></option>
<?php
$cm_regioni_param = isset($_GET['regione']) ? stripslashes($_GET['regione']) : '';
$cm_province_param = isset($_GET['provincia']) ? stripslashes($_GET['provincia']) : '';

$querySql = "SELECT DISTINCT(cm_provincia) FROM cm_comuni WHERE cm_regione = '$cm_regioni_param' ORDER BY cm_provincia";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

while (($rows = $result->fetch_assoc()) !== NULL) {

    $cm_provincia = $rows['cm_provincia'];
    $status = ($cm_province_param == $cm_provincia) ? "selected" : "";
    echo "<option value='$cm_provincia' $status>$cm_provincia</option>";

};
?>
<?php include('../../inc/db-close.php'); ?>
