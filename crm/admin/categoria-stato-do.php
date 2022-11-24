<?php include 'inc/autoloader.php'; ?>

<?php
$get_ct_id = (int)$_GET['ct_id'];

$querySql = "UPDATE ct_categorie SET ct_stato = 1 - ct_stato WHERE ct_id = $get_ct_id";
$result = $dbConn->query($querySql);
?>