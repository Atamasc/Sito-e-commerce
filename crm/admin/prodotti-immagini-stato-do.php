<?php include 'inc/autoloader.php'; ?>
<?php
$get_pi_id = (int)$_GET['pi_id'];

$querySql = "UPDATE pi_prodotti_immagini SET pi_stato = 1 - pi_stato WHERE pi_id = $get_pi_id";
$result = $dbConn->query($querySql);

$dbConn->close();
?>