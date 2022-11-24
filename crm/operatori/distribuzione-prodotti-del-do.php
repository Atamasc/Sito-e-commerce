<?php include('inc/autoloader.php'); ?>
<?php
$di_id = (int)$_GET["di_id"];
$dp_id = (int)$_GET["dp_id"];

$querySql = "DELETE FROM dp_distribuzione_prodotti WHERE dp_id = $dp_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if ($rows > 0) echo "<meta http-equiv='refresh' content='0;url=distribuzione-prodotti-add.php?di_id=$dp_di_id&delete=true' />";
else echo "<meta http-equiv='refresh' content='0;url=distribuzione-prodotti-add.php?di_id=$dp_di_id&delete=false' />";
?>
