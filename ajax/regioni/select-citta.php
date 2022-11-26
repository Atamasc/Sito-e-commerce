<?php include('../../inc/db-conn.php'); ?>
<option value="">Seleziona una citta'</option>
<option value=""></option>
<?php
$cm_comuni_param = isset($_GET['citta']) ? stripslashes($_GET['citta']) : '';
$cm_province_param = isset($_GET['provincia']) ? stripslashes($_GET['provincia']) : '';

$querySql = "SELECT * FROM cm_comuni WHERE cm_provincia = '$cm_province_param' ORDER BY cm_comune";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

while (($rows = $result->fetch_assoc()) !== NULL) {

    $cm_comune = $rows['cm_comune'];
    $status = ($cm_comuni_param == $cm_comune) ? "selected" : "";
    echo "<option value=\"$cm_comune\" $status>$cm_comune</option>";

};
?>
<?php include('../../inc/db-close.php'); ?>
