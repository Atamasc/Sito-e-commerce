<?php include 'inc/autoloader.php'; ?>

<?php
$get_np_id = (int)$_GET['np_id'];

$querySql = "DELETE FROM np_notifiche_prodotti WHERE np_id = $get_np_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$delete = $rows > 0 ? 'true' : 'false';
header("Location: notifiche-gst.php?np_id=$get_np_id&delete=$delete");
?>