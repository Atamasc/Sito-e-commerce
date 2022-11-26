<?php include "../inc/session.php"; ?>
<?php include "../inc/db-conn.php"; ?>
<?php include "../bin/function.php"; ?>
<?php include "../bin/url-rewrite.php"; ?>
<?php include "../bin/core.php"; ?>
<?php include "../inc/config.php"; ?>

<?php
$cr_id = isset($_GET['cr_id']) ? (int)$_GET['cr_id'] : 0;
$cr_pr_quantita = isset($_GET['cr_pr_quantita']) ? (int)$_GET['cr_pr_quantita'] : 1;

$querySql =
    "UPDATE cr_carrello SET cr_pr_quantita = '$cr_pr_quantita' WHERE cr_id = '$cr_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$querySql =
    "SELECT pr_prezzo, pr_prezzo_scontato FROM cr_carrello INNER JOIN pr_prodotti ON pr_codice = cr_pr_codice WHERE cr_id = '$cr_id' ";
$result = $dbConn->query($querySql);
$row_data = $result->fetch_assoc();
$pr_prezzo = $row_data['pr_prezzo_scontato'] > 0 ? $row_data['pr_prezzo_scontato'] : $row_data['pr_prezzo'];

$result->close();

echo formatPrice($pr_prezzo * $cr_pr_quantita);
?>
<?php include('../inc/db-close.php'); ?>