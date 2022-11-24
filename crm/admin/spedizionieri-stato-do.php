<?php include 'inc/autoloader.php'; ?>

<?php
$get_ci_id = (int)$_GET['ci_id'];

$querySql = "UPDATE ci_corrieri SET ci_stato = 1 - ci_stato WHERE ci_id = $get_ci_id";
$result = $dbConn->query($querySql);
?>