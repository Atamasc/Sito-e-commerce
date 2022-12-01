<?php include 'inc/autoloader.php'; ?>

<?php
$get_mr_id = (int)$_GET['mr_id'];

$querySql = "UPDATE mr_marche SET mr_riservato = 1 - mr_riservato WHERE mr_id = $get_mr_id";
$result = $dbConn->query($querySql);
?>