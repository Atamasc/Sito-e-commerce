<?php
include('../../inc/db-conn.php');
include('../../bin/function.php');
header('Content-Type: text/html; charset=ISO-8859-1');

$get_pr_id = isset($_GET['pr_id'])? (int)$_GET['pr_id'] : "";
$get_gi_id = isset($_GET['gi_id'])? (int)$_GET['gi_id'] : "";
?>
<option value="">Seleziona un lotto</option>
<option value=""></option>
<?php
$querySql =
    "SELECT gi_id, lt_codice, lt_timestamp, gi_quantita, pr_um FROM gi_giacenze ".
    "INNER JOIN lt_lotti ON lt_id = gi_lt_id ".
    "INNER JOIN pr_prodotti ON pr_id = gi_pr_id ".
    "WHERE gi_pr_id = '$get_pr_id' ORDER BY gi_timestamp DESC ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

while (($rows = $result->fetch_assoc()) !== NULL) {

    $gi_id = $rows['gi_id'];
    $gi_quantita = getQntGiacenzaDisponibile($gi_id);
    $lt_desc = $rows['lt_codice']." del ".date("d/m/Y", $rows['lt_timestamp'])." (Qnt. disp. $gi_quantita ".$rows['pr_um'].")";
    $status = ($get_gi_id == $gi_id) ? "selected" : "";
    $disabled = $gi_quantita > 0 ? "" : "disabled";

    echo "<option value='$gi_id' $disabled $status>$lt_desc</option>";

}
?>
<?php include('../../inc/db-close.php'); ?>
