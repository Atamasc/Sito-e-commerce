<?php include 'inc/autoloader.php'; ?>

<?php
$get_sl_id = (int)$_GET['sl_id'];

$querySql = "UPDATE sl_slide SET sl_stato = 1 - sl_stato WHERE sl_id = $get_sl_id";
$result = $dbConn->query($querySql);
?>