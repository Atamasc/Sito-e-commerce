<?php include('inc/autoloader.php'); ?>
<?php
$or_codice = (int)$_GET["or_codice"];

$querySql = "DELETE FROM or_ordini WHERE or_codice = $or_codice ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<meta http-equiv='refresh' content='0;url=ordini-gst.php?delete=true' />";
?>
