<?php
include('../../inc/db-conn.php');
include('../../bin/function.php');
header('Content-Type: text/html; charset=ISO-8859-1');

$get_pr_codice_produttore = isset($_GET['pr_codice_produttore'])? $dbConn->real_escape_string(stripslashes(trim($_GET['pr_codice_produttore']))) : '';

$querySql = "SELECT pr_prezzo FROM pr_prodotti WHERE pr_codice_produttore = '$get_pr_codice_produttore' ORDER BY pr_id DESC LIMIT 0, 1";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;
$row_data = $result->fetch_assoc();
$result->close();

if($rows > 0) echo formatPrice($row_data['pr_prezzo']);
else echo 0;
?>
<?php include('../../inc/db-close.php'); ?>
