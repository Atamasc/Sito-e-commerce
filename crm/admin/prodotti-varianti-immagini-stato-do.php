<?php include 'inc/autoloader.php'; ?>
<?php
$get_pv_id = (int)$_GET['pv_id'];

$querySql = "UPDATE pv_prodotti_varianti_immagini SET pv_stato = 1 - pv_stato WHERE pv_id = $get_pv_id";
$result = $dbConn->query($querySql);

$dbConn->close();
?>