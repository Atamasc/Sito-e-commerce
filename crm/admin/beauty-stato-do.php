<?php include 'inc/autoloader.php'; ?>

<?php
$get_ba_id = (int)$_GET['ba_id'];

$querySql = "UPDATE ba_beauty_assistant SET ba_stato = 1 - ba_stato WHERE ba_id = $get_ba_id";
$result = $dbConn->query($querySql);
?>