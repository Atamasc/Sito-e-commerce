<?php include 'inc/autoloader.php'; ?>

<?php
$get_co_id = (int)$_GET['co_id'];

$querySql = "UPDATE co_coupon SET co_stato = 1 - co_stato WHERE co_id = $get_co_id";
$result = $dbConn->query($querySql);
?>