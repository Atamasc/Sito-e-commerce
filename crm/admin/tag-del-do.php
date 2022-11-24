<?php include "inc/autoloader.php"; ?>
<?php
$tg_id = $_GET["tg_id"];

$tg_id = $dbConn->real_escape_string($tg_id);

$querySql = "DELETE FROM tg_tag WHERE tg_id = '".$tg_id."' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$dbConn->close();

if($rows > 0) header("Location: tag-gst.php?delete=true");
else header("Location: tag-gst.php?delete=false");
?>