<?php include 'inc/autoloader.php'; ?>

<?php
$get_co_id = (int)$_GET['co_id'];

$querySql = "DELETE FROM co_coupon WHERE co_id = $get_co_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$delete = $rows > 0 ? 'true' : 'false';
header("Location: coupon-gst.php?co_id=$get_co_id&delete=$delete");
?>