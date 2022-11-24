<?php include 'inc/autoloader.php'; ?>

<?php
$ct_id = (int)$_POST['ct_id'];
$ct_categoria = $dbConn->real_escape_string(stripslashes(trim($_POST['ct_categoria'])));

$querySql = "UPDATE ct_categorie SET 
             ct_categoria = '$ct_categoria' 
             WHERE ct_id = $ct_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: prodotti-categorie-gst.php?ct_id=$ct_id&update=true");
else header("Location: prodotti-categorie-gst.php?ct_id=$ct_id&update=false");
?>