<?php include 'inc/autoloader.php'; ?>

<?php
$get_mr_id = (int)$_GET['mr_id'];

$querySql = "UPDATE mr_marchi SET mr_stato = 1 - mr_stato WHERE mr_id = $get_mr_id";
$result = $dbConn->query($querySql);
?>