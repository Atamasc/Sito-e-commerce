<?php include 'inc/autoloader.php'; ?>

<?php
$get_si_id = (int)$_GET['si_id'];

$querySql = "UPDATE si_sistemi SET si_stato = 1 - si_stato WHERE si_id = $get_si_id";
$result = $dbConn->query($querySql);
?>