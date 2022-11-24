<?php include('inc/autoloader.php'); ?>
<?php
$st_id = (int)$_GET["st_id"];

$querySql = "UPDATE st_sottocategorie SET st_stato = 1 - st_stato WHERE st_id = '$st_id'";
$result = $dbConn->query($querySql);

$dbConn->close();
?>
