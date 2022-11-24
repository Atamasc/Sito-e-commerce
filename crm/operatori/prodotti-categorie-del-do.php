<?php include 'inc/autoloader.php'; ?>

<?php
$get_ct_id = (int)$_GET['ct_id'];

$querySql = "DELETE FROM ct_categorie WHERE ct_id = $get_ct_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: prodotti-categorie-gst.php?delete=true");
else header("Location: prodotti-categorie-gst?delete=false");
?>