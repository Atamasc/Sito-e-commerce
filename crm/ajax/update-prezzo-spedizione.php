<?php include '../../inc/db-conn.php'; ?>
<?php include "../bin/function.php"; ?>
<?php
$get_st_id = (int)$_GET['st_id'];

$get_prezzo = $dbConn->real_escape_string(stripslashes(trim($_GET['prezzo'])));
$get_prezzo = formatPriceForDB($get_prezzo);

$querySql = "UPDATE st_sottocategorie SET st_prezzo_spedizione = '$get_prezzo' WHERE st_id = $get_st_id";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$querySql = "SELECT st_sottocategoria FROM st_sottocategorie WHERE st_id = $get_st_id";
$result = $dbConn->query($querySql);
$titolo = $result->fetch_row()[0];

echo $titolo;
?>
