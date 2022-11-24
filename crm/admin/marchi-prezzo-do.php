<?php include 'inc/autoloader.php'; ?>

<?php
$get_mr_id = (int)$_GET['mr_id'];

$querySql = "UPDATE mr_marchi SET mr_prezzo_parziale = 1 - mr_prezzo_parziale WHERE mr_id = $get_mr_id";
$result = $dbConn->query($querySql);
?>