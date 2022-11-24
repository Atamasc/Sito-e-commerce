<?php include 'inc/autoloader.php'; ?>

<?php
$get_ci_id = (int)$_GET['ci_id'];

$querySql = "DELETE FROM ci_corrieri WHERE ci_id = $get_ci_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$delete = $rows > 0 ? 'true' : 'false';
header("Location: spedizionieri-gst.php?ci_id=$get_ci_id&delete=$delete");
?>