<?php include('inc/autoloader.php'); ?>
<?php
$cr_timestamp = (int)$_GET["cr_timestamp"];

$querySql = "DELETE FROM cr_carrello WHERE cr_timestamp = $cr_timestamp ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

echo "<meta http-equiv='refresh' content='0;url=carrelli-gst.php?delete=true' />";
?>
