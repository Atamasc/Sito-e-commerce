<?php include('inc/autoloader.php'); ?>

<?php
$or_codice = (int)$_GET["or_codice"];

$querySql = "UPDATE or_ordini SET or_stato_conferma = 1 - or_stato_conferma WHERE or_codice = $or_codice ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<script>window.location=document.referrer;</script>";
?>
