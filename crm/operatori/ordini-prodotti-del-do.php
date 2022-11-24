<?php include('inc/autoloader.php'); ?>
<?php
$or_id = (int)$_GET["or_id"];

$querySql = "DELETE FROM or_ordini WHERE or_id = $or_id ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<script>window.history.back();</script>";
?>
