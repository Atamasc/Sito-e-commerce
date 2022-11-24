<?php include "inc/autoloader.php"; ?>
<?php
$ct_id = (int)$_POST['ct_id'];

$ct_titolo = $dbConn->real_escape_string(stripslashes(trim($_POST['ct_titolo'])));

$querySql =
    "UPDATE ct_categoria SET ct_titolo = '$ct_titolo' WHERE ct_id = '$ct_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

if($rows > 0) header("Location: clienti-categorie-mod.php?ct_id=$ct_id&update=true");
else header("Location: clienti-categorie-mod.php?ct_id=$ct_id&update=false");

?>