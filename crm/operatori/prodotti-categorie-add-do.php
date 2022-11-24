<?php include 'inc/autoloader.php'; ?>

<?php
$ct_categoria = $dbConn->real_escape_string(stripslashes(trim($_POST['ct_categoria'])));

$ct_timestamp = time();

$querySql = "INSERT INTO ct_categorie SET 
             ct_categoria = '$ct_categoria', 
             ct_timestamp = '$ct_timestamp',
             ct_stato = 1";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: prodotti-categorie-gst.php?insert=true");
else header("Location: prodotti-categorie-gst.php?insert=false");
?>