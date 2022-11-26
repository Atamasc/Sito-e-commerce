<?php include "../inc/session.php"; ?>
<?php include "../inc/db-conn.php"; ?>
<?php include "../bin/function.php"; ?>
<?php include "../bin/url-rewrite.php"; ?>
<?php include "../bin/core.php"; ?>
<?php include "../inc/config.php"; ?>

<?php
$cr_id = isset($_GET['cr_id']) ? (int)$_GET['cr_id'] : 0;

$querySql =
    "DELETE FROM cr_carrello WHERE cr_id = '$cr_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

echo "<meta http-equiv='refresh' content='0;url=../carrello' />";

?>

<?php include('../inc/db-close.php'); ?>
