<?php include('inc/autoloader.php'); ?>
<?php
$or_id = (int)$_GET["or_id"];
$or_pr_quantita = (int)$_GET['or_pr_quantita'];
$or_pr_codice = $_GET['or_pr_codice'];

$querySql = "DELETE FROM or_ordini WHERE or_id = '$or_id' ";
$result = $dbConn->query($querySql);
$rows = $dbConn->affected_rows;

$querySql_up = "UPDATE pr_prodotti SET pr_giacenza = pr_giacenza + '$or_pr_quantita' WHERE pr_codice = '$or_pr_codice' ";
$result_up = $dbConn->query($querySql_up);

$dbConn->close();

echo "<script>window.history.back();</script>";
?>
