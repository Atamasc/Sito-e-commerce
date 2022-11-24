<?php include 'inc/autoloader.php'; ?>

<?php
$get_ba_id = (int)$_GET['ba_id'];

$querySql = "DELETE FROM ba_beauty_assistant WHERE ba_id = $get_ba_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$delete = $rows > 0 ? 'true' : 'false';
header("Location: beauty-gst.php?ba_id=$get_ba_id&delete=$delete");
?>