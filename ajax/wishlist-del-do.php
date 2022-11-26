<?php include "../inc/session.php"; ?>
<?php include "../inc/db-conn.php"; ?>
<?php include "../bin/function.php"; ?>
<?php include "../bin/url-rewrite.php"; ?>
<?php include "../bin/core.php"; ?>
<?php include "../inc/config.php"; ?>

<?php
$ws_id = isset($_GET['ws_id']) ? (int)$_GET['ws_id'] : 0;

$querySql = "DELETE FROM ws_wishlist WHERE ws_id = '$ws_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

echo "<meta http-equiv='refresh' content='0;url=$rootBasePath_http/wishlist' />";

?>

<?php include('../inc/db-close.php'); ?>